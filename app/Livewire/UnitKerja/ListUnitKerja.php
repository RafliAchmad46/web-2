<?php

namespace App\Livewire\UnitKerja;

use Livewire\Component;
use App\Models\UnitKerja;

class ListUnitKerja extends Component
{
    public $unitKerjas;

    public function mount()
    {
        $this->unitKerjas = UnitKerja::all();
    }

    public function delete($id)
    {
        UnitKerja::destroy($id);
        $this->unitKerjas = UnitKerja::all(); // Refresh
    }

   public function render()
   {
       return view('livewire.unit-kerja.list-unit-kerja', [
           'unitKerjas' => UnitKerja::all(),
       ]);
   }
}
