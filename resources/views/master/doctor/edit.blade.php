<x-app-layout>
    <x-slot name="header">
        Edit Dokter
    </x-slot>
    <x-container>
        <x-slot name="content">
            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="text-xs md:text-sm space-y-3 max-w-xl mx-auto">
                    <div class="flex flex-col gap-1">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $doctor->name }}" placeholder="Masukkan Nama Dokter" required>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="poly_id">Poli</label>
                        <select name="poly_id" id="poly_id"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md select2" required>
                            <option value="" selected disabled>Pilih Poli</option>
                            @foreach ($poly as $item)
                                <option value="{{ $item->id }}"
                                    {{ $doctor->poly_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex md:justify-end justify-between items-center md:gap-4 gap-1">
                        <button
                            class="bg-green-500 hover:bg-opacity-80 text-white py-2 px-4 rounded-lg flex items-center gap-1 text-xs md:text-sm shadow-md"
                            type="submit">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>

                            <p>Simpan</p>
                        </button>
                        <a class="bg-blue-950 hover:bg-opacity-80 text-white py-2 px-4 rounded-lg flex items-center gap-1 text-xs md:text-sm shadow-md"
                            href="{{ route('doctor.index') }}">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="4" d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <p>Kembali</p>
                        </a>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-container>
</x-app-layout>
<script type="module">
    $(document).ready(function() {
        $('.select2').select2({
            dropdownCssClass: "text-xs md:text-sm",
            selectionCssClass: 'text-xs md:text-sm',
        });
    })
</script>
