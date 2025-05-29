<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Ruang;
use App\Models\Pegawai;

class EditPeminjaman extends Component
{
    public $peminjaman;

    public $ruang_id;
    public $pegawai_id;
    public $tanggal;
    public $jam_mulai;
    public $jam_akhir;
    public $keterangan;

    public $ruangs;
    public $pegawais;

    protected function rules()
    {
        return [
            'ruang_id' => 'required|exists:ruang,id',
            'pegawai_id' => 'required|exists:pegawai,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_akhir' => 'required|date_format:H:i|after:jam_mulai',
            'keterangan' => 'nullable|string',
        ];
    }

    public function mount(Peminjaman $peminjaman)
{
    $this->peminjaman = $peminjaman;

    $this->ruangs = Ruang::all();
    $this->pegawais = Pegawai::all();

    $this->ruang_id = $peminjaman->ruang_id;
    $this->pegawai_id = $peminjaman->pegawai_id;
    $this->tanggal = $peminjaman->tanggal;
    $this->jam_mulai = $peminjaman->jam_mulai instanceof \DateTime
        ? $peminjaman->jam_mulai->format('H:i')
        : $peminjaman->jam_mulai;
    $this->jam_akhir = $peminjaman->jam_akhir instanceof \DateTime
        ? $peminjaman->jam_akhir->format('H:i')
        : $peminjaman->jam_akhir;
    $this->keterangan = $peminjaman->keterangan;
}


    public function update()
    {
        $this->validate();

        $this->peminjaman->update([
            'ruang_id' => $this->ruang_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Peminjaman berhasil diupdate.');
        return redirect()->route('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman');
    }
}
