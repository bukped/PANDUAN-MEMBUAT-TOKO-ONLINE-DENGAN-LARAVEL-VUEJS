public function getProducts()
{
    $products = Product::all();
    return response()->json($products);
}
