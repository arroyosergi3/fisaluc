<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function myAppointments(){
        $ma = Auth::user()->appointmentsAsPatient()
                 ->whereDate('date', '>', today()) // Filtra por fecha sin considerar la hora
                 ->orderBy('date', 'asc')
                 ->get();
        return view('clients.my-appointments', compact('ma'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $physios = User::all()->where('role', 'physio');
        $treats = Treatment::all();
        return view('users.create')->with(['physios' => $physios, 'treats' => $treats]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['u' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:9',
            'birthday' => 'required|date',
            'role' => 'required|in:basic,physio,admin',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('updateSuccess', 'usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
