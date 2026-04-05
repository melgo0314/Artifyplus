<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Models\Subscription;
use App\Models\User;



class ChannelController extends Controller
{
    //Mostrar canales
    public function index(){
        $channels =Channel::all();
        return view('home.index', compact('channels'));
    }

     // Suscribirse
    public function subscribirse($id){
        $user = Auth::user();

        // Verificar si ya está suscrito
        $exists = Subscription::where('user_id', $user->id)
                    ->where('channel_id', $id)
                    ->exists();

        if($exists){
            return back()->with('warning', 'Ya estás suscrito a este canal');
        }

        Subscription::create([
            'user_id' => $user->id,
            'channel_id' => $id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth()
        ]);

        return back()->with('success', 'Suscripción exitosa');
    }

    // PANEL ADMIN - listar
    public function adminIndex(){
        $channels = Channel::all();
        return view('admin.dashboard', compact('channels'));
    }

    // FORM crear
    public function create(){
        return view('admin.create');
    }

    // GUARDAR
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Channel::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Canal creado correctamente');
    }

    public function edit($id){
        $channel = Channel::findOrFail($id);
        return view('admin.edit', compact('channel'));
    }

    public function update(Request $request, $id){
        $channel = Channel::findOrFail($id);

        $channel->update($request->all());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Canal actualizado');
    }

    public function destroy($id){
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return back()->with('success', 'Canal eliminado');
    }

   
}
