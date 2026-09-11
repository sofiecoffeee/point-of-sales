<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil data produk sekaligus relasi kategorinya
        $products = Product::with('category')->get();
        $title = "Products Management";

        // terus tunjukin deh
        return view('admin.products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Buat ambil daftar kategori buat pilihan kayak dropdown di form produk
        $categories = Category::all();
        $title = "Add Product";
        return view('admin.products.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'name'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric|min:0',
            'stock'=>'required|integer|min:0',
            'photo'=>'nullable|image|max:2048',
        ]);

        // buat handle image supaya ada gambarnya
        $imagePath = null;
        // cek dulu ada yang dikirim gaa?
        if($request->hasFile('photo')){
            // terus kita simpen di folder public/storage/products
            $imagePath = $request->file('photo')->store('products', 'public');
        }

        // oke sekarang kita siapin data yang mau dimasukin ke database
        $storeData = [
            'name' => $validatedData['name'],
            'category_id'=> $validatedData['category_id'],
            'price'=> $validatedData['price'],
            'stock'=> $validatedData['stock'],

            // karena bukan data array, tapi path foto
            'photo'=> $imagePath  

        ];

        Product::create($storeData);
        
        return redirect()->route('admin.products.index')->with('success', 'Product successfully added!');

    }
       

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Products Data";
        $product = Product::findOrFail($id);
        // buat opsi dropdown categories
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    $product = Product::findorFail($id);

    $validatedData = $request->validate([
        'name'=>'required|string|max:255',
        'category_id'=>'required|exists:categories,id',
        'price'=>'required|integer|min:0',
        'stock'=>'required|numeric|min:0',
        'photo'=>'nullable|image|max:2048',
    ]);

    $updateData = [
        'name'=> $validatedData['name'],
        'category_id'=> $validatedData['category_id'],
        'price'=> $validatedData['price'],
        'stock'=> $validatedData['stock'],
        ];

     // untuk gambar, kalo mau keliatan gambarnya dan upload gambar baru
        if($request->hasFile('photo')){
            // buat hapus gamabr lama di storage buat hemat storage
            if($product->photo){
                Storage::disk('public')->delete($product->photo);
            }

            // buat simpen gambar baru
            $updateData['photo'] = $request->file('photo')->store('products', 'public');

            $product->update($updateData);

        return redirect()->route('admin.products.index')->with('success','Products successfully updated!');
        }
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // hapus file fisik dari storage kalo ada gambar
        if($product->photo){
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product has been deleted');
    }
}
