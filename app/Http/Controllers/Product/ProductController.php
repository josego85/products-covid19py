<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize('haveaccess', 'product.index');

        // Using query builder
        $products = \DB::table('products')
          ->select('id', 'name', 'type')
          ->orderBy('id')
          ->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Gate::authorize('haveaccess', 'product.create');

        $method = 'create';

        // Load product/createOrEditOrShow.blade.php view
        return view('product.createOrEditOrShow', compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('haveaccess', 'product.create');

        $request->validate([
            'name'          => 'required|max:50|unique:products,name',
            'type'          => 'required|max:50|unique:products,type'
        ]);
        $product = Product::create(
            $request->all()
        );
        return redirect()->route('product.index')->with('status_success', 'Producto guardado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $this->authorize('haveaccess', 'product.show');

        $method = 'show';

        // Load product/createOrEditOrShow.blade.php view
        return view('product.createOrEditOrShow', compact('product', 'method'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // $this->authorize('haveaccess', 'product.edit');

        $method = 'edit';

        // Load product/createOrEditOrShow.blade.php view
        return view('product.createOrEditOrShow', compact('product', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // $this->authorize('haveaccess', 'product.edit');

        $request->validate([
            'name'          => 'required|max:50|unique:products,name,' . $product->id,
            'type'          => 'required|max:50|unique:products,type,' . $product->id,
        ]);
        $product->update(
            $request->all()
        );
        return redirect()->route('product.index')->with('status_success', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // $this->authorize('haveaccess', 'product.destroy');

        $product->delete();
        return redirect()->route('product.index')->with('status_success', 'Producto eliminado con éxito.');
    }
}
