<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;

class CreateUnitKerja extends Component
{
    public $nama;
    public $kode;

    protected $rules = [
        'nama' => 'required|string|max:100',
        'kode' => 'required|string|max:10|unique:unit_kerja,kode',
    ];

    public function save()
    {
        $this->validate();

        UnitKerja::create([
            'nama' => $this->nama,
            'kode' => $this->kode,
        ]);

        session()->flash('message', 'Unit Kerja berhasil ditambahkan.');
        return redirect()->route('unit-kerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.create-unit-kerja');
    }
}
