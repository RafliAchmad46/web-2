<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Ruang;
use App\Models\Pegawai;

class CreatePeminjaman extends Component
{
    public $ruang_id;
    public $pegawai_id;
    public $tanggal;
    public $jam_mulai;
    public $jam_akhir;
    public $keterangan;

    public $ruangs;
    public $pegawais;

    protected $rules = [
        'ruang_id' => 'required|exists:ruang,id',
        'pegawai_id' => 'required|exists:pegawai,id',
        'tanggal' => 'required|date',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_akhir' => 'required|date_format:H:i|after:jam_mulai',
        'keterangan' => 'nullable|string',
    ];

    public function mount()
    {
        $this->ruangs = Ruang::all();
        $this->pegawais = Pegawai::all();
    }

    public function save()
    {
        $this->validate();

        Peminjaman::create([
            'ruang_id' => $this->ruang_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Peminjaman berhasil disimpan.');
        return redirect()->route('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman');
    }
}