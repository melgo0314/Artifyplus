<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
Use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $subs = Subscription::with('channel')
        ->where('user_id', Auth::id())
        ->get();

        return view('home.suscripciones', compact('subs'));
    }

    public function cancel($id)
    {
        $sub = Subscription::findOrFail($id);

        // cambiar estado en lugar de borrar
        $sub->status = 'cancelled';
        $sub->save();

        return back()->with('success', 'Suscripción cancelada');
    }

    

    public function renew($id)
    {
        $sub = Subscription::findOrFail($id);

        $sub->status = 'active';
        $sub->start_date = now();
        $sub->end_date = Carbon::now()->addDays(30);

        $sub->save();

        return back()->with('success', 'Suscripción renovada');
    }
}
