<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required|string|max:50'
        ]);
        $category =  Category::create([
            'name_category' => $request->name_category,
        ]);


        return response()->json([
            'message' => 'Kateggori berhasil disimpan',
            'product'  => $category
        ], 201);
    }


    public function update(Request $request, $id)
    {
        //validasi input
        $request->validate([
            'name_category' => 'required|string|max:50'
        ]);


        //cari Product berdasarkan ID
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'message' => "Category tidak ditemukan",
            ], 404);
        }
        //update data user
        $category->update([
            'name_category' => $request->name_category
        ]);


        return response()->json([
            'message' => "User berhasil diperbarui",
            'product' => $category
        ], 200);
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'category telah dihapus']);
    }
}