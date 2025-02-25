<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    // tampilkan data api
    public function index()
    {
        return response()->json(User::all());
    }


    // store penyimpanan data user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password


        ]);


        return response()->json([
            'message' => 'User berhasil disimpan',
            'user'  => $user
        ], 201);
    }


    // destroy data user per id
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User telah dihapus']);
    }
    public function update(Request $request, $id)
    {
        //validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required'
        ]);


        //cari user berdasarkan ID
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => "user tidak ditemukan",
            ], 404);
        }
        //update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);


        return response()->json([
            'message' => "User berhasil diperbarui",
            'user' => $user
        ], 200);
    }
}
