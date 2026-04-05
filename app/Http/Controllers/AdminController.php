<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.usuarios', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user'
        ]);

        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario creado correctamente');
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
    public function edit($id)
    {
       $user = User::findOrFail($id);
       return view('admin.editar', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->route('admin.usuarios')
        ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->is_admin == '1'){
            return back()->with('warning', 'No puedes eliminar un administrador');
        }

        $user->delete();

        return redirect()->route('admin.usuarios')
        ->with('success', 'Usuario eliminado correctamente.');
        
    }
}
