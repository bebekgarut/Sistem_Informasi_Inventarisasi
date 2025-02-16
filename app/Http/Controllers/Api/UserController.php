<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'asc')->paginate(100);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:5|max:24|unique:users',
            'password' => 'required|min:8|max:255',
            'role' => 'required|max:5',
            'KODE_UPB' => 'nullable'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return response()->json("data berhasil ditambahkan");
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'username' => [
                'required',
                'min:5',
                'max:24',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:8|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        DB::table('Users')->where('id', $id)->update($validatedData);

        return response()->json("data berhasil diubah");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json("data berhasil dihapus");
    }
}
