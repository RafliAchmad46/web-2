<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;

class ListPeminjaman extends Component
{
    public function render()
    {
        return view('livewire.peminjaman.list-peminjaman', [
            'peminjamans' => Peminjaman::with(['ruang', 'pegawai'])->get()
        ]);
    }

     public function delete($id)
    {
        $peminjaman= Peminjaman::find($id);
        if ($peminjaman) {
        $peminjaman->delete();
        session()->flash('message', 'Peminjaman berhasil dihapus.');
        }
    }
}
