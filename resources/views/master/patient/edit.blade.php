<x-app-layout>
    <x-slot name="header">
        Edit Pasien
    </x-slot>
    <x-container>
        <x-slot name="content">
            <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="text-xs md:text-sm space-y-3 max-w-xl mx-auto">
                    <div class="flex flex-col gap-1">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $patient->name }}" placeholder="Masukkan Nama Pasien" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $patient->nik }}" placeholder="Masukkan NIK"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md select2" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option {{ $patient->gender == 'L' ? 'selected' : '' }} value="L">Laki Laki</option>
                            <option {{ $patient->gender == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $patient->birth_date }}" placeholder="Masukkan Tanggal Lahir" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="phone">Nomor Hp</label>
                        <input type="text" id="phone" name="phone"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $patient->phone }}" placeholder="Contoh: 081234567890" maxlength="13"
                            inputmode="numeric" pattern="^(08|62)[0-9]{8,11}$"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" rows="3"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md" placeholder="Masukkan Alamat Pasien"
                            required>{{ $patient->address }}</textarea>
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
                            href="{{ route('patient.index') }}">
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
