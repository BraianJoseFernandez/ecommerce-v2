<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Variant;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);
        $product->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Producto Eliminado!',
            'text' => 'El producto se eliminó correctamente.'
        ]);

        return redirect()->route('admin.products.index');
    }

    public function variants(Product $product, Variant $variant){
        return view('admin.products.variants', compact('product', 'variant'));
    }

    public function variantsUpdate(Request $request, Product $product, Variant $variant){

        $data = $request->validate([
            'sku' => 'required',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024',
        ]);
        

        if($request->image){
            if ($variant->image_path) {
                Storage::disk('public')->delete($variant->image_path);
            }
            $data['image_path'] = $request->image->store('products', 'public');
        }

        $variant->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Variante Actualizada!',
            'text' => 'La variante se actualizó correctamente.'
        ]);

        return redirect()->route('admin.products.variants', [$product, $variant]);
    }
}
