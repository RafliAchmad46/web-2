<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Peminjaman</h1>

    <form wire:submit.prevent="save" class="space-y-4">
        <flux:input
            type="date"
            id="tanggal"
            wire:model.defer="tanggal"
            label="Tanggal"
            required
        />

        <flux:select
            id="ruang_id"
            wire:model.defer="ruang_id"
            label="Pilih Ruang"
            required
        >
            <option value="">-- Pilih Ruang --</option>
            @foreach($ruangs as $ruang)
                <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
            @endforeach
        </flux:select>

        <flux:select
            id="pegawai_id"
            wire:model.defer="pegawai_id"
            label="Pilih Pegawai"
            required
        >
            <option value="">-- Pilih Pegawai --</option>
            @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
            @endforeach
        </flux:select>

        <flux:input
            type="time"
            id="jam_mulai"
            wire:model.defer="jam_mulai"
            label="Jam Mulai"
            required
        />

        <flux:input
            type="time"
            id="jam_akhir"
            wire:model.defer="jam_akhir"
            label="Jam Akhir"
            required
        />

        <flux:textarea
            id="keterangan"
            wire:model.defer="keterangan"
            label="Keterangan"
            placeholder="Tambahkan keterangan..."
        />

        <flux:button type="submit" variant="primary">
            Simpan
        </flux:button>
    </form>
</div>
