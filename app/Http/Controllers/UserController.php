<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UPB;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function data()
    {
        $users = User::orderBy('role', 'asc')->paginate(100);
        return view('user.data_user', compact('users'));
    }

    public function tambah()
    {
        $upbs = UPB::all();
        return view('user.tambah-user', compact('upbs'));
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

        $request = session();
        $request->flash('success', 'User baru berhasil di tambahkan');

        return redirect('/data_user');
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->findOrFail($id);
        return view('user.edit_user', compact('users'));
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

        return redirect()->route('datauser')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('datauser')->with('success', 'Data berhasil dihapus');
    }
}
