<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use App\Notifications\AppointmentRequested;
use App\Services\GoogleCalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $appointments = Appointment::orderBy('date', 'desc')->paginate(10);
        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = null)
    {
        //dd("id:", $id);
        $physios = User::all()->where('role', 'physio');
        $treats = Treatment::all();
        return view('clients.newappointment')->with(['physios' => $physios, 'treats' => $treats, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource from pyhsio view.
     */
    public function createForPhysio()
    {
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
            'physio_id' => 'required',
            'treatment_id' => 'required',
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
            'physio_id.required' => 'El campo de fisioterapeuta es obligatorio.',
            'treat_id.required' => 'El campo de tratamiento es obligatorio.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha no es válida.',
            'time.required' => 'La hora es obligatoria.',
        ]);
        try {
            if($request->has('createdByPhysio')){
                $appointment = Appointment::create([
                    'physio_id' => $request->physio_id,
                    'patient_id' => $request->patient_id,
                    'treatment_id' => $request->treatment_id,
                    'date' => $request->date,
                    'time' => $request->time,
                ]);

            $appointment->patient->notify(new AppointmentRequested($appointment));
            }else{
                $appointment = Appointment::create([
                    'physio_id' => $request->physio_id,
                    'patient_id' => Auth::id(),
                    'treatment_id' => $request->treatment_id,
                    'date' => $request->date,
                    'time' => $request->time,
                ]);
            }
        } catch (\Throwable $th) {

            return to_route('dashboard')->with('error', 'Ha ocurrido un error insesperado, intentelo mas tarde');
        }


session()->put('appointment', $appointment);
/** @disregard P1013 */
auth()->user()->notify(new AppointmentRequested($appointment));

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

    if ($client->google_access_token) {
        $calendar->addEvent($client, $appointment);
    }

    if ($appointment->physio && $appointment->physio->google_access_token) {
        $calendar->addEvent($appointment->physio, $appointment);
    }

    return redirect()->route('dashboard')->with('addCalendarSucess', 'Cita añadida al calendario correctamente.');
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
        $appointment->load(['physio', 'patient', 'treatment']);
        $physios = User::all()->where('role', 'physio');
        $users = User::all()->where('role', 'basic');
        //dd("Pacientes: ", $users->toArray());
        $treats = Treatment::all();
            return view('appointment.edit', compact('appointment', 'users', 'physios', 'treats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'physio_id' => 'required|string|max:255',
            'patient_id' => 'required|string|max:255',
            'treatment_id' => 'required|string|max:255',
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












    public function destroyForPatient(Appointment $appointment)
{
    $user = Auth::user(); // El usuario actual

    // Asegúrate de que la cita tiene todos los datos necesarios
    if ($appointment->date && $appointment->time && $appointment->treatment->description) {
        // Obtener el cliente de Google Calendar
        $client = app(GoogleCalendarService::class)->getGoogleClient($user);
       /** @disregard P1009 */
        $service = new \Google_Service_Calendar($client);

        // Establecer el rango de búsqueda del evento en Google Calendar (una hora antes y después de la cita)
        $start = Carbon::parse("{$appointment->date} {$appointment->time}", 'Europe/Madrid');
        $end = $start->copy()->addMinutes(45);

        // Buscar los eventos cercanos a la fecha y hora de la cita
        try {
            $events = $service->events->listEvents('primary', [
                'timeMin' => $start->toRfc3339String(),
                'timeMax' => $end->toRfc3339String(),
                'q' => 'Cita de fisioterapia',  // Usamos una descripción común
            ]);

            // Log para ver todos los eventos encontrados
            Log::info("Eventos encontrados en el rango de tiempo:");
            foreach ($events->getItems() as $event) {
                Log::info("Evento: " . $event->getSummary() . " - Start: " . $event->getStart()->getDateTime());
            }

            // Verifica que se encontraron eventos
            $foundEvent = false;

            foreach ($events->getItems() as $event) {
                // Verifica si la descripción y la fecha/hora coinciden exactamente
                if ($event->getSummary() === 'Cita de fisioterapia' &&
                    $event->getStart()->getDateTime() === $start->toRfc3339String()) {

                    // Log para depuración: Mostrar el ID del evento encontrado
                    Log::info("Evento encontrado para eliminar: " . $event->getId());

                    // Intentar eliminar el evento de Google Calendar
                    $service->events->delete('primary', $event->getId());
                    Log::info("Evento eliminado de Google Calendar con ID: {$event->getId()}");

                    $foundEvent = true;
                    break; // Salir después de eliminar el primer evento que coincide
                }
            }
            if (!$foundEvent) {
                Log::warning('No se encontró el evento para eliminar en Google Calendar.');
            }
        } catch (\Google_Service_Exception $e) {
            Log::error('Error al eliminar evento de Google Calendar: ' . $e->getMessage());
        }
    }

    $appointment->delete();
    return redirect()->route('myappointments')->with('deleteSuccess', 'Cita eliminada correctamente.');
}



}
