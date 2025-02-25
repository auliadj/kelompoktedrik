<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Menampilkan semua produk dengan kategori
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $product = Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'note' => $request->note,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Product berhasil disimpan',
            'product' => $product->load('category')
        ], 201);
    }

    // Mengupdate produk berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:50',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        // Cek apakah produk ada
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => "Product tidak ditemukan",
            ], 404);
        }

        // Update data produk
        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'note' => $request->note,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => "Product berhasil diperbarui",
            'product' => $product->load('category')
        ], 200);
    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Product telah dihapus']);
    }

}
