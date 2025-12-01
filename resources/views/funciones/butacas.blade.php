@extends('layouts.app-cinerama')

@section('content')


<div class="bg-[#0b0b0b] text-white flex justify-center px-0 mt-4">





    <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- ▬▬▬ PANEL LATERAL ▬▬▬ -->
        <aside class="md:col-span-1 bg-[#111] rounded-xl p-6 shadow-xl border border-[#222]">

            <img 
                src="{{ asset($showtime->movie->image) }}"
                onerror="this.src='{{ asset('images/peliculas/default.jpg') }}'"
                class="w-full rounded-lg shadow mb-4"
            />

            <h2 class="text-xl font-bold mb-2">{{ $showtime->movie->title }}</h2>
            <p class="text-sm text-gray-300">🎥 {{ $showtime->format }} — {{ $showtime->language }}</p>

            <p class="text-sm mt-2">🏢 {{ $showtime->cinema->name }}</p>
            <p class="text-sm mt-1">🪑 Sala {{ $showtime->room }}</p>
            <p class="text-sm mt-1">📅 {{ \Carbon\Carbon::parse($showtime->date)->format('d M Y') }}</p>
            <p class="text-sm">🕒 {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>

        </aside>

        <!-- ▬▬▬ MAPA DE ASIENTOS ▬▬▬ -->
        <div class="md:col-span-3">

            <form method="POST" action="{{ route('asientos.reservar', $showtime) }}" id="seatForm">
                @csrf

                <!-- Inputs dinámicos -->
                <div id="seatsContainer"></div>

                <div class="text-center mb-6">
                    <div class="text-gray-400 font-semibold mb-2">Pantalla</div>
                    <div class="mx-auto w-64 h-2 bg-gradient-to-r from-gray-700 via-gray-400 to-gray-700 rounded-full"></div>
                </div>

                <div class="flex justify-center">
                    <div class="bg-[#111827] p-6 rounded-xl shadow-2xl border border-[#1f2937]">

                        @foreach($rows as $row)
                            <div class="flex items-center justify-center mb-1">

                                <span class="w-6 text-xs text-gray-400 mr-2 font-bold">{{ $row }}</span>

                                @foreach($cols as $col)
                                    @php
                                        $seat = $row.$col;
                                        $taken = in_array($seat, $takenSeats);
                                        $locked = in_array($seat, $seatLocks ?? []);
                                    @endphp

                                    <button
                                        type="button"
                                        data-seat="{{ $seat }}"
                                        class="seat w-7 h-7 rounded-full mx-0.5 text-[11px] flex items-center justify-center font-semibold transition
                                            {{ $taken 
                                                ? 'bg-red-700 cursor-not-allowed opacity-60'
                                                : ($locked
                                                    ? 'bg-red-500 cursor-not-allowed opacity-60'
                                                    : 'bg-gray-600 hover:bg-yellow-400 hover:text-black'
                                                )
                                            }}"
                                        {{ ($taken || $locked) ? 'disabled' : '' }}
                                    >
                                        {{ $col }}
                                    </button>

                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="mt-6 text-center text-sm flex justify-center gap-6 text-gray-300">
                    <span class="flex items-center gap-2"><span class="w-3 h-3 bg-gray-600 rounded-full"></span> Disponible</span>
                    <span class="flex items-center gap-2"><span class="w-3 h-3 bg-red-600 rounded-full"></span> Ocupada</span>
                    <span class="flex items-center gap-2"><span class="w-3 h-3 bg-yellow-400 rounded-full"></span> Seleccionada</span>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm mb-2">Butacas seleccionadas:</p>
                    <p id="selectedSeats" class="text-yellow-400 font-bold text-lg"></p>

                    <button 
                        class="mt-6 bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-lg font-bold text-lg shadow">
                        Continuar
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>



<!-- SCRIPT DE SELECCIÓN -->
<script>
    const selected = new Set();
    const display = document.getElementById('selectedSeats');

    document.querySelectorAll('.seat').forEach(btn => {
        btn.addEventListener('click', () => {

            if (btn.disabled) return;

            const seat = btn.dataset.seat;

            if (selected.has(seat)) {
                selected.delete(seat);
                btn.classList.remove('bg-yellow-400', 'text-black');
                btn.classList.add('bg-gray-600');
            } else {
                selected.add(seat);
                btn.classList.remove('bg-gray-600');
                btn.classList.add('bg-yellow-400', 'text-black');
            }

            const seatsContainer = document.getElementById('seatsContainer');
            seatsContainer.innerHTML = "";

            Array.from(selected).forEach(s => {
                let input = document.createElement('input');
                input.type = "hidden";
                input.name = "seats[]";
                input.value = s;
                seatsContainer.appendChild(input);
            });

            display.textContent = Array.from(selected).join(", ");
        });
    });
</script>

<!-- 🔥 GUARDAR ENTRADAS ANTES DE RESERVAR -->
<script>
document.getElementById("seatForm").addEventListener("submit", async function (e) {

    if (selected.size === 0) {
        e.preventDefault();
        showAlert("Selecciona al menos una butaca.");

        return;
    }

    e.preventDefault();

    let seats = Array.from(selected);

    let entradas = seats.map(s => ({
        nombre: "General 2D",
        precio: 15.00,
        cantidad: 1
    }));

    let showtime_id = {{ $showtime->id }};
    let cine_id     = {{ $showtime->cinema->id }};

    let ok = await guardarEntradas(entradas, seats, showtime_id, cine_id);

    if (ok === true) {
        this.submit();
    } else {
        showAlert("Ocurrió un error guardando tus entradas. Intenta nuevamente.");

    }
});
</script>

<script src="{{ asset('js/entradas.js') }}"></script>

<!-- 🎛 Modal personalizado Cinerama -->
<div id="alertModal"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-[#111] border border-yellow-500/30 rounded-xl p-6 w-80 shadow-2xl animate-fade-in">

        <h2 class="text-yellow-400 text-lg font-bold mb-2">
            ⚠ Atención
        </h2>

        <p id="alertMessage" class="text-gray-300 text-sm mb-5">
            Mensaje aquí...
        </p>

        <button onclick="closeAlert()"
                class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-semibold py-2 rounded-lg transition">
            Aceptar
        </button>
    </div>

</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: scale(.9); }
    to   { opacity: 1; transform: scale(1); }
}
.animate-fade-in { animation: fade-in .2s ease-out; }
</style>

<script>
function showAlert(message) {
    document.getElementById("alertMessage").innerText = message;
    document.getElementById("alertModal").classList.remove("hidden");
}

function closeAlert() {
    document.getElementById("alertModal").classList.add("hidden");
}
</script>

@endsection











