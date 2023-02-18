<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    public function all(Request $request){

        $id = $request->input('id');
        $limit = $request->input('Limit', 6);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $category_name = $request->input('category_name');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        if($id){

            $product = Product::with(['galleries', 'categories'])->find($id);

            if($product)
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);

        }

        if($slug){

            $product = Product::with(['galleries', 'categories'])
            ->where('slug', $slug)
            ->first();

            if($product)
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);

        }

        $product = Product::with(['galleries', 'categories']);

        if($name)
            $product->where('name', 'like', '%' . $name . '%');

        if($category_name)
            $product->where('category_name', 'like', '%' . $category_name . '%');

        if($price_from)
            $product->where('price', '>=', $price_from );

        if($price_to)
            $product->where('price', '<=', $price_to );

            return ResponseFormatter::success(
                $product->paginate($limit),
                'Data list berhasil diambil'
            );

    }
}
