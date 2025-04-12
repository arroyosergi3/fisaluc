<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $appointments = Appointment::all();
        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $physios = User::all()->where('role', 'physio');
        $treats = Treatment::all();
        return view('clients.newappointment')->with(['physios' => $physios, 'treats' => $treats]);
    }

    public function createForPhysio()
    {
        dd('llamo al metodo por lo menos');
        $physios = User::all()->where('role', 'physio');
        $users = User::all()->where('role', 'basic');
        $treats = Treatment::all();
        return view('appointment.create')->with(['physios' => $physios, 'treats' => $treats, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'physio' => 'required',
            'treat' => 'required',
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $dayOfWeek = Carbon::parse($value)->dayOfWeek;
                    if ($dayOfWeek === Carbon::SATURDAY || $dayOfWeek === Carbon::SUNDAY) {
                        $fail('No se puede seleccionar sábados ni domingos.');
                    }
                },
            ],
            'time' => 'required',
        ], [
            'physio.required' => 'El campo de fisioterapeuta es obligatorio.',
            'treat.required' => 'El campo de tratamiento es obligatorio.',
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
/*
        $calendar = new GoogleCalendarService();

        // Obtener el cliente y el fisio
        $client = Auth::user();
        $physio = User::find($request->physio);

        // Agregar al calendario de ambos (si tienen tokens)
        if ($client->google_access_token) {
            try {
                //dd('intento crear en el de el cliente');
                $calendar->addEvent($client, $appointment);
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Algo ha salido mal');
        }

        if ($physio && $physio->google_access_token) {
            $calendar->addEvent($physio, $appointment);
        }

        */

        // Después de crear la cita
$appointment = Appointment::create([
    'physio' => $request->physio,
    'patient' => Auth::id(),
    'treatment' => $request->treat,
    'date' => $request->date,
    'time' => $request->time,
]);

// Guardar la cita en la sesión
session()->put('appointment', $appointment);

return redirect()->route('dashboard')->with('show_modal', true);

        return redirect()->route('dashboard')->with([
            'show_modal' => true,
            'appointment_id' => $appointment->id,
            'success' => 'Cita creada correctamente. ¿Deseas añadirla a tu calendario?'
        ]);
    }


    public function addToCalendar(Request $request)
{
    $appointment = Appointment::with('treatment')->findOrFail($request->appointment_id);
    $calendar = new GoogleCalendarService();

    $client = Auth::user();
    $physio = User::find($appointment->physio);

    if ($client->google_access_token) {
        $calendar->addEvent($client, $appointment);
    }

    if ($physio && $physio->google_access_token) {
        $calendar->addEvent($physio, $appointment);
    }

    return redirect()->route('dashboard')->with('success', 'Cita añadida al calendario correctamente.');
}



    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointment.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointment.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'physio' => 'required|string|max:255',
            'patient' => 'required|string|max:255',
            'treatment' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $data = $request->only(['physio', 'patient', 'treatment', 'date', 'time']);

        $appointment->update($data);

        return redirect()->route('appointment.index')->with('updateSuccess', 'Cita actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.index')->with('success', 'Cita eliminada correctamente.');
    }
}
