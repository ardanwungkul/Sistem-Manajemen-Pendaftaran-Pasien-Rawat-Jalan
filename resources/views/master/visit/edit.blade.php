<x-app-layout>
    <x-slot name="header">
        Edit Kunjungan Rawat Jalan
    </x-slot>
    <x-container>
        <x-slot name="content">
            <form action="{{ route('visit.update', $visit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="text-xs md:text-sm space-y-3 max-w-xl mx-auto">

                    <div class="flex flex-col gap-1">
                        <label for="patient_id">Pasien</label>
                        <select name="patient_id" id="patient_id"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md" required>
                            <option value="" selected disabled>Pilih Pasien</option>
                            <option value="{{ $visit->patient_id }}" selected>{{ $visit->patient->nik }} -
                                {{ $visit->patient->name }}</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="poly_id">Poli</label>
                        <select name="poly_id" id="poly_id"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md select2" required>
                            <option value="" selected disabled>Pilih Poli</option>
                            @foreach ($poly as $item)
                                <option value="{{ $item->id }}"
                                    {{ $visit->doctor->poly->id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="doctor_id">Dokter</label>
                        <select name="doctor_id" id="doctor_id"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md select2" required>
                            <option value="" selected disabled>Pilih Dokter</option>
                            @foreach ($visit->doctor->poly->doctor as $item)
                                <option value="{{ $item->id }}"
                                    {{ $visit->doctor_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="visit_date">Tanggal</label>
                        <input type="date" id="visit_date" name="visit_date"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md"
                            value="{{ $visit->visit_date }}" placeholder="Pilih Tanggal Kunjungan" required>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="complaint">Keluhan</label>
                        <textarea name="complaint" id="complaint" rows="3" placeholder="Masukkan Keluhan"
                            class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md" required>{{ $visit->complaint }}</textarea>
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

        $('#patient_id').select2({
            dropdownCssClass: "text-xs md:text-sm",
            selectionCssClass: 'text-xs md:text-sm',
            language: {
                inputTooShort: function(args) {
                    var remainingChars = args.minimum - args.input.length;
                    return "Masukkan " + remainingChars + " karakter lagi";
                }
            },
            ajax: {
                url: `{{ route('visit.create') }}`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search_patient: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function(data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.pagination?.more || false
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 3,
            templateSelection: function(data) {
                if (data.name && data.nik) {
                    return data.nik + ' - ' + data.name;
                }
                return data.text;
            }
        });

        $('#poly_id').on('change', function() {
            const poly_id = $(this).val();
            if (poly_id) {
                $.ajax({
                    url: "{{ route('visit.create') }}",
                    type: "GET",
                    data: {
                        poly_id: poly_id
                    },
                    success: function(response) {
                        $('#doctor_id').empty();
                        $('#doctor_id').append(
                            '<option value="" selected disabled>Pilih Dokter</option>'
                        );

                        if (response.length > 0) {
                            $.each(response, function(index, data) {
                                $('#doctor_id').append('<option value="' + data.id +
                                    '">' + data.name + '</option>');
                            });
                        } else {
                            $('#doctor_id').append(
                                '<option value="" disabled>Tidak ada Data tersedia</option>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#doctor_id').empty();
                $('#doctor_id').append(
                    '<option value="" selected disabled>Pilih Dokter</option>'
                );
            }
        });
    })
</script>
