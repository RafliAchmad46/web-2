<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Daftar Unit Kerja</h1>

    <div class="flex justify-between mb-4">
        <flux:button :href="route('unit-kerja.create')" variant="primary">Tambah Unit Kerja</flux:button>
    </div>

    @if (session('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full border-collapse border border-gray-400 mt-4">
        <thead>
            <tr class="text-left bg-gray-100">
                <th class="py-2 px-4 border border-gray-300">#</th>
                <th class="py-2 px-4 border border-gray-300">Kode</th>
                <th class="py-2 px-4 border border-gray-300">Nama</th>
                <th class="py-2 px-4 border border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unitKerjas as $unit)
                <tr>
                    <td class="py-2 px-4 border border-gray-300">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border border-gray-300">{{ $unit->kode }}</td>
                    <td class="py-2 px-4 border border-gray-300">{{ $unit->nama }}</td>
                    <td class="py-2 px-4 border border-gray-300 space-x-2">
                        <flux:button :href="route('unit-kerja.edit', $unit)" size="sm">Edit</flux:button>
                        <flux:button variant="danger" size="sm" wire:click="delete({{ $unit->id }})" wire:confirm="Apakah Anda yakin ingin menghapus?">
                            Hapus
                        </flux:button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
