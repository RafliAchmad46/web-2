<?php

namespace App\Livewire\UnitKerja;

use Livewire\Component;
use App\Models\UnitKerja;

class EditUnitKerja extends Component
{
    public $nama;
    public $kode;
    public UnitKerja $unitKerja;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:100',
            // Validasi unik kecuali record yang sedang diedit
            'kode' => 'required|string|max:10|unique:unit_kerja,kode,' . $this->unitKerja->id,
        ];
    }

    public function mount(UnitKerja $unitKerja)
    {
        $this->unitKerja = $unitKerja;
        $this->nama = $unitKerja->nama;
        $this->kode = $unitKerja->kode;
    }

    public function update()
    {
        $this->validate();

        $this->unitKerja->update([
            'nama' => $this->nama,
            'kode' => $this->kode,
        ]);

        session()->flash('message', 'Unit Kerja berhasil diubah!');
        return redirect()->route('unit-kerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.edit-unit-kerja');
    }

}
