<?php

namespace App\Livewire;

use App\Models\Specialist;
use App\Models\Treatment;
use Livewire\Component;

class TreatmentSelector extends Component
{

    public $treatments;
    public $physios = [];
    public $selectedTreatment = null;

    public function mount()
    {
        $this->treatments = Treatment::all();
    }
    public function updatedSelectedTreatment($treatmentId)
    {
        //dd($treatmentId); // Verifica qué se está enviando

        $this->physios = Specialist::where('treatment', $treatmentId)
            ->join('users', 'specialists.physio', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname')
            ->get()
            ->toArray();

        //dd($this->physios); // Verifica qué se está enviando
    }


    public function render()
    {

       // dd("Cargando Livewire");

        return view('livewire.treatment-selector');
    }
}
