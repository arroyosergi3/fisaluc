<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $physios = User::all()->where('role' , 'physio');
        $treats = Treatment::all();
        return view('clients.newappointment')->with(['physios' => $physios,'treats' => $treats]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("va a  validar"); ESTE SI LO HACE
        $request->validate([
            'physio' => 'required',
            'treat' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ], [
            'physio.required' => 'El campo de fisioterapeuta es obligatorio.',
            'treatment.required' => 'El campo de tratamiento es obligatorio.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha no es válida.',
            'time.required' => 'La hora es obligatoria.',
        ]);

        try {
            $appointment = Appointment::create([
                'physio' => $request->physio,
                'patient' => Auth::id(),
                'treatment' => $request->treat,
                'date' => $request->date,
                'time' => $request->time,
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return to_route('dashboard')->with('msg', 'hay errores tete');
        }


        return redirect()->route('dashboard')->with('success', 'Appointment created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
