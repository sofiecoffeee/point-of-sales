<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $title = "Product Categories";
        return view('admin.categories.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Categories";
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:categories,name',
        ]);

        Category:create([
            'name'=> $request->name,
            'slug'->str()->slug($request->name),//buat ubah teks jadi format url biar rapih aja bisa dipake bisa ngga 
        ]);
    }

    /**
     * Display the specified resource.
     */
    // di Category POS gak ada show, jadi gak usah diisi
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Categories";
         // pertama, kita cari dulu user berdasarkan ID, kalo ga ketemu/fail nanti muncul halaman 404
        $user = User::findorFail($id);

    // terus, kita arahin ke view edit, terus kirim data user yang lama
    return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255|unique:categories,name,' .$id,
        ]);

        $updateData = [
            'name'=>$validatedData['name'],
            'slug'=>str()->slug($validatedData['name']),
        ];

        $category->update($updateData);

        return redirect()->route('admin.categories.index')->with('Success', 'Successfully Update Category');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('Success', 'Category has been deleted');
    }
}
