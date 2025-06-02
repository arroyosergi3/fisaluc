<?php

namespace App\Livewire;

use App\Models\Specialist;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TreatmentSelector extends Component
{

    public $treatments;
    public $physios = [];
    public $selectedTreatment = null;
    public $selectedDate = null;
    public $busyHours = [];
    public $selectedPhysio = null;
    public $idSelectedTreatment;


    public function mount($sessionTreatmentId = null)
    {
        
        $this->treatments = Treatment::all();
    if (!$this->selectedTreatment && $sessionTreatmentId) {
        $this->selectedTreatment = $sessionTreatmentId;
        $this->updatedSelectedTreatment($sessionTreatmentId);
    }
    }

    public function updatedSelectedTreatment($treatmentId)
    {
        $this->physios = Specialist::where('treatment', $treatmentId)
            ->join('users', 'specialists.physio', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname')
            ->get()
            ->toArray();
    }


    public function updatedSelectedPhysio($physioId)
    {
        // Actualizar las horas ocupadas cada vez que se cambie el fisioterapeuta
        $this->updateBusyHours();
    }

    public function updatedSelectedDate($date)
    {
        // Actualizar las horas ocupadas cada vez que se cambie la fecha
        $this->updateBusyHours();
        $dayOfWeek = Carbon::parse($date)->dayOfWeek; // 0 = domingo, 6 = sábado

        if ($dayOfWeek === Carbon::SUNDAY || $dayOfWeek === Carbon::SATURDAY) {
            $this->addError('date', 'No se puede seleccionar sábados ni domingos.');
        } else {
            $this->resetErrorBag('date');
        }
    }

    public function updateBusyHours()
    {
        if ($this->selectedPhysio && $this->selectedDate) {
            // Obtener las horas ocupadas para el fisio seleccionado en la fecha seleccionada
            $this->busyHours = DB::table('appointments')
                ->where('physio_id', $this->selectedPhysio)
                ->whereDate('date', $this->selectedDate)
                ->pluck('time')
                ->map(function ($time) {
                    return \Carbon\Carbon::parse($time)->format('H:i'); // Formato adecuado
                })
                ->toArray();
        }
    }




    public function render()
    {

       // dd("Cargando Livewire");

        return view('livewire.treatment-selector');
    }
}
