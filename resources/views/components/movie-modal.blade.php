<div id="modal-horarios-{{ $movie->id }}"
     class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center p-4 z-50">

    <div class="bg-gray-800 w-full max-w-3xl p-6 rounded-xl shadow-xl text-white relative">

        <button onclick="document.getElementById('modal-horarios-{{ $movie->id }}').classList.add('hidden')"
                class="absolute top-2 right-2 text-gray-300 hover:text-white">
            ✕
        </button>

        <h2 class="text-3xl font-bold">{{ $movie->title }}</h2>
        <p class="text-gray-300 mb-4 mt-2">Sin descripción disponible.</p>

        <h3 class="text-xl text-yellow-400 mb-4 flex items-center">
            ⏱ Horarios
        </h3>

        {{-- =============================================
             AGRUPAR HORARIOS POR CINE
        ============================================== --}}
        @foreach(($groupedShowtimes[$movie->id] ?? []) as $cinemaId => $items)

            <div class="mb-6">

                <h4 class="font-semibold text-white text-lg mb-2">
                    {{ $items->first()->cinema->name }}
                </h4>

                {{-- =============================================
                     AGRUPAR POR FORMATO + IDIOMA
                ============================================== --}}
                @php
                    $byFormatLang = $items->groupBy(function($h){
                        return $h->format . ' - ' . $h->language;
                    });
                @endphp

                @foreach($byFormatLang as $groupName => $horarios)
                    <p class="text-yellow-300 font-semibold mb-2 text-sm">
                        {{ $groupName }}
                    </p>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($horarios as $h)
                            <button
                                onclick="window.location.href='{{ route('asientos.ver', $h->id) }}'"
                                class="px-4 py-2 bg-yellow-500 text-black rounded hover:bg-yellow-400 transition font-semibold">
                                {{ \Carbon\Carbon::parse($h->time)->format('H:i') }}
                            </button>
                        @endforeach
                    </div>

                @endforeach

            </div>

        @endforeach

    </div>
</div>








