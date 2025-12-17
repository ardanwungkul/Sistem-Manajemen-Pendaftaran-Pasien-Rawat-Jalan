<x-app-layout>
    <x-slot name="header">
        Data Riwayat Kunjungan Rawat Jalan
    </x-slot>

    <x-container>
        <x-slot name="content">
            <div>
                <div class="flex justify-between items-end gap-3">
                    <div>
                        <a href="{{ route('visit.create') }}"
                            class="bg-blue-950 text-white rounded-lg px-3 py-2.5 text-xs border border-gray-300 shadow-lg flex gap-1 items-center justify-center mb-12 md:mb-4 whitespace-nowrap w-min font-medium">
                            <svg viewBox="0 0 24 24" fill="none" class="w-3 h-3 stroke-white"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M12 4V20" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </svg>
                            <p>
                                Pendaftaran Kunjungan Rawat Jalan
                            </p>
                        </a>
                    </div>
                    <div class="!w-52">
                        <div class="flex flex-col gap-1 mb-12 md:mb-4 !w-full">
                            <select name="patient_id" id="patient_id"
                                class="text-xs md:text-sm rounded-lg border border-gray-300 shadow-md w-full"
                                style="width:208px !important" required>
                                <option value="" selected disabled>Pilih Pasien</option>
                                @if (isset($selectedPatient))
                                    <option value="{{ $selectedPatient->id }}" selected>
                                        {{ $selectedPatient->nik }} - {{ $selectedPatient->name }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-lg overflow-hidden shadow-lg border border-secondary-4">
                        <table id="datatable" class="text-sm hover stripe row-border">
                            <thead class="bg-blue-950 text-gray-300 font-medium">
                                <tr>
                                    <td class="text-xs !text-center w-20">No</td>
                                    <td class="text-xs">Tanggal</td>
                                    <td class="text-xs !text-center">Poli</td>
                                    <td class="text-xs">Dokter</td>
                                    <td class="text-xs">Keluhan</td>
                                    <td class="text-xs w-32"></td>
                                </tr>
                            </thead>
                            <tbody class="text-secondary-2">
                                @foreach ($data as $item)
                                    <tr class="text-xs">
                                        <td class="w-20">
                                            <p class="text-center"> {{ $data->firstItem() + $loop->index }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->visit_date }}</p>
                                        </td>
                                        <td>
                                            <p class="!text-center">{{ $item->department }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->doctor_name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->complaint }}</p>
                                        </td>
                                        <td>
                                            <div class="flex justify-center items-center gap-3">
                                                <div>
                                                    <div>
                                                        <a href="{{ route('visit.edit', $item->id) }}">
                                                            <svg class="w-5 h-5 text-blue-500" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        data-modal-toggle="confirm-delete-{{ $item->id }}"
                                                        data-modal-target="confirm-delete-{{ $item->id }}">
                                                        <svg class="w-5 h-5 text-red-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($data as $item)
                            <x-modal.confirm-delete :id="$item->id" :name="'Data'" :action="route('visit.destroy', $item->id)" />
                        @endforeach
                        @if ($data->count() > 0)
                            @if ($data->total() > $data->perPage())
                                <div class="p-4">
                                    {{ $data->links('pagination::tailwind') }}
                                </div>
                            @endif

                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
    </x-container>
</x-app-layout>
<script type="module">
    $(document).ready(function() {
        $('#datatable').DataTable({
            info: false,
            searching: false,
            lengthChange: false,
            deferRender: true,
            paging: false,
            language: {
                search: '',
                emptyTable: "Tidak ada data tersedia",
                searchPlaceholder: 'Cari...'
            },
            ordering: false,
            responsive: true,
            columnDefs: [{
                targets: '_all',
                className: 'dt-head-left',
            }]
        });

        $('#patient_id').select2({
            dropdownCssClass: "text-xs",
            selectionCssClass: 'text-xs',
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
        }).on('select2:select', function(e) {
            const patientId = e.params.data.id;

            window.location.href = `{{ route('visit.index') }}?patient_id=${patientId}`;
        });
    });
</script>
