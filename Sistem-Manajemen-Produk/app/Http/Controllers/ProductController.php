<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $categories = ['Expresso', 'Arabika', 'Robusta'];
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'))->with('categories', $this->categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('products.create')->with('categories', $this->categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=> 'required|string|max:225',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if($request->hasFile('photo')){
            $path = request()->file('photo')->store('products','public');
            $data['photo'] = $path;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success','Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'))->with('categories', $this->categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view ('products.edit', compact('product'))->with('categories', $this->categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'required|string|max:225',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->all();
        if($request->hasFile('photo')){
            if ($product->photo){
                Storage::disk('public')->delete($product->photo);
            }
            $path = $request->file('photo')->store('products','public');
            $data['photo'] = $path;
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success','Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->photo){
            Storage::disk('public')->delete($product->photo);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success','Produk berhasil dihapus');
    }
}
