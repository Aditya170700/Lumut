<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $results = User::paginate(10);

        return view('user', compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:account,username',
            'name' => 'required',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:admin,author',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Berhasil tambah data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:account,username,' . $id . ',username',
            'name' => 'required',
            'password' => 'confirmed',
            'role' => 'required|in:admin,author',
        ]);

        $user = User::findOrFail($id);
        $password = $user->password;

        if ($request->password) {
            $password = bcrypt($request->password);
        }

        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'password' => $password,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Berhasil ubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil hapus data');
    }
}
