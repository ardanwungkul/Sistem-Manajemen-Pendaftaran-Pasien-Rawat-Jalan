@php
    $items = [
        [
            'icon' => 'fa-grid-2',
            'label' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'icon' => 'fa-user-doctor',
            'label' => 'Dokter',
            'route' => 'doctor.index',
        ],
        [
            'icon' => 'fa-hospital-user',
            'label' => 'Pasien',
            'route' => 'patient.index',
        ],
        [
            'icon' => 'fa-book-medical',
            'label' => 'Data Rawat Jalan',
            'route' => 'visit.index',
        ],
    ];
@endphp

{{-- Header --}}
<div class="flex gap-4 items-center pb-3 border-b border-bay-900/50">
    <div>
        <div class="rounded-lg border border-white w-10 h-10 flex items-center justify-center">
            <p class="text-white font-extrabold">L</p>
        </div>
    </div>
    <div class="w-full">
        <p class="text-white font-medium leading-none">SMPPRJ</p>
    </div>
</div>
{{-- Items --}}
<div class="py-3 space-y-1 overflow-y-scroll h-full no-scrollbar" id="accordion-collapse" data-accordion="collapse">
    @foreach ($items as $index => $item)
        <a href="{{ route($item['route']) }}"
            class="w-full flex items-center gap-3 group hover:bg-white px-3 py-2 rounded-lg transition-all duration-300">
            <i
                class="fa-regular {{ $item['icon'] }} text-white group-hover:text-blue-950 transition-all duration-300"></i>
            <p class="text-white group-hover:text-blue-950 font-medium transition-all duration-300 text-sm">
                {{ $item['label'] }}</p>
        </a>
    @endforeach
</div>

{{-- Session --}}
<div class="flex gap-3 pt-2">
    <div class="rounded-full bg-white/20 w-9 h-9 flex items-center justify-center flex-none">
        <i class="fa-regular fa-user text-white/70"></i>
    </div>
    <div>
        <p class="text-sm text-white/70 line-clamp-1">{{ Auth::user()->name }}</p>
        <p class="text-xs text-white/30 leading-none line-clamp-1">System Admin</p>
    </div>
</div>
