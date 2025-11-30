@if(count($cart))
    @foreach($cart as $key => $item)
        <div class="cart-item flex items-center justify-between bg-gray-800 rounded-lg p-3 shadow-md mb-2">

            <div class="flex-1">
                <p class="item-name font-semibold text-white">{{ $item['name'] }}</p>
                <p class="item-price text-sm text-gray-400">{{ number_format($item['price'], 2) }}</p>

                <div class="flex items-center gap-2 mt-2">
                    <button onclick="updateQty('{{ $key }}', {{ $item['qty'] - 1 }})"
                            class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">-</button>

                    <span class="item-qty text-yellow-400 font-bold">{{ $item['qty'] }}</span>

                    <button onclick="updateQty('{{ $key }}', {{ $item['qty'] + 1 }})"
                            class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">+</button>
                </div>
            </div>

            <div class="text-right">
                <p class="item-subtotal text-yellow-400 font-semibold">
                    {{ number_format($item['price'] * $item['qty'], 2) }}
                </p>

                <button onclick="removeItem('{{ $key }}')"
                        class="text-red-400 hover:text-red-600 mt-2 block">
                    🗑️
                </button>
            </div>

        </div>
    @endforeach

    <input type="hidden" id="totalCarrito" value="{{ $total }}">

@else
    <p class="empty-msg text-gray-400">Tu carrito está vacío 😅</p>
@endif



