<?php
namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductGallery;
use App\Models\Catelogue;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use Illuminate\Support\Str; // Thêm dòng này

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catelogue = Catelogue::query()->first();
        $data = Product::with('catelogue', 'tags')->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogue = Catelogue::query()->pluck('name', 'id')->all();
        $color = ProductColor::query()->pluck('name', 'id')->all();
        $size = ProductSize::query()->pluck('name', 'id')->all();
        $tag = Tag::query()->pluck('name', 'id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogue', 'color', 'size', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        

        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];
        if ($dataProduct['img_thumbnail']) {
            $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
        }  
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];
        foreach ($dataProductVariants as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'], // Sửa lỗi chính tả từ 'quatity' thành 'quantity'
                'image' => $item['image'] ?? null,
            ];
        }
       

        $dataProductTags = $request->tag;
        $dataProductGalleries = $request->product_galleries;

        try {
            DB::beginTransaction();
            $product = Product::create($dataProduct);
            foreach ($dataProductVariants as $variant) {
                $variant['product_id'] = $product->id;
                if ($variant['image']) {
                    $variant['image'] = Storage::put('products', $variant['image']);
                }
                ProductVariant::create($variant);
            }
            $product->tags()->sync($dataProductTags);
            foreach ($dataProductGalleries as $image) {
                ProductGallery::create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $image)
                ]);
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi trong quá trình lưu sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   /**
 * Remove the specified resource from storage.
 */
public function destroy(Product $product)
{
    try {
        DB::beginTransaction();

        // Xóa các tag của sản phẩm
        $product->tags()->sync([]);

        // Lấy và xóa ảnh thumbnail
        if ($product->img_thumbnail) {
            Storage::delete($product->img_thumbnail);
        }

        // Xóa các hình ảnh trong bảng ProductGallery
        $product->galleries()->get()->each(function ($gallery) {
            Storage::delete($gallery->image); // Xóa file ảnh từ storage
            $gallery->delete(); // Xóa dữ liệu trong database
        });

        // Xóa các biến thể sản phẩm trong bảng ProductVariant
        $product->variants()->delete();

        // Xóa sản phẩm chính
        $product->delete();

        DB::commit();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    } catch (\Exception $exception) {
        DB::rollBack();
        return back()->with('error', 'Đã xảy ra lỗi trong quá trình xóa sản phẩm. Vui lòng thử lại.');
    }
}

}
