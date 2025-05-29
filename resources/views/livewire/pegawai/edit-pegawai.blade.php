<div class="container mx-auto">
   <h1 class="text-2xl font-bold mb-4">Edit Pegawai</h1>

   <form wire:submit.prevent="save" class="space-y-4">
      <flux:input
           type="text"
           id="nip"
           wire:model.defer="nip"
           label="NIP"
           placeholder="Masukkan NIP pegawai"
           required
           />

       <flux:input
           type="text"
           id="nama"
           wire:model.defer="nama"
           label="Nama Pegawai"
           placeholder="Masukkan Nama Pegawai"
           required
           />

       <flux:select id="unit_kerja" wire:model.defer="unit_kerja" label="Unit Kerja" placeholder="" required>
        <option value="">-- Pilih Unit Kerja --</option>
        @foreach($unit_kerjas as $unit)
        <option value="{{ $unit->id }}" @selected($unit->id == $unit_kerja)>{{ $unit->nama }}</option>
        @endforeach
       </flux:select>
       <flux:button
           type="submit"
           variant="primary"
           >
           Save
       </flux:button>
   </form>
</div>
