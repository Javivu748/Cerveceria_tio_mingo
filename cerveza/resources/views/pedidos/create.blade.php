<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold mb-6">Realizar Pedido</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pedidos.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-5 gap-8">

                <!-- COLUMNA IZQUIERDA (CERVEZAS) -->
                <div class="md:col-span-4">
                    <div class="grid grid-cols-4 gap-6">
                        @foreach($cervezas as $cerveza)
                            <div class="border rounded-lg shadow hover:shadow-lg overflow-hidden flex flex-col items-center p-4">
                                <!-- IMAGEN -->
                                <div class="w-20 h-20 md:w-20 md:h-20 mb-2">
                                    <img src="{{ $cerveza->imagen_url }}" alt="{{ $cerveza->name }}" class="w-full h-full object-cover rounded">
                                </div>

                                <!-- NOMBRE Y INPUT -->
                                <div class="w-full flex flex-col items-center">
                                    <h4 class="font-semibold text-center mb-1 text-sm md:text-base">
                                        {{ $cerveza->name }}
                                    </h4>

                                    <div class="flex items-center gap-2">
                                        <p class="text-gray-600 text-sm">€{{ number_format($cerveza->precio_eur, 2) }}</p>
                                        <input
                                            type="number"
                                            name="cervezas[{{ $cerveza->id }}][cantidad]"
                                            min="0"
                                            value="0"
                                            class="w-16 border rounded px-2 py-1 cantidad"
                                            data-id="{{ $cerveza->id }}"
                                            data-nombre="{{ $cerveza->name }}"
                                            data-precio="{{ $cerveza->precio_eur }}"
                                        >
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- COLUMNA DERECHA (RESUMEN) -->
                <div class="md:col-span-1">
                    <div class="border p-6 rounded shadow-md sticky top-4 max-h-[80vh] overflow-y-auto">
                        <h3 class="text-lg font-semibold mb-4">Resumen del Pedido</h3>

                        <div id="resumen" class="space-y-2 text-sm text-gray-700">
                            <p class="text-gray-500">No hay productos seleccionados.</p>
                        </div>

                        <hr class="my-4">

                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span>€<span id="total">0.00</span></span>
                        </div>

                        <button
                            type="submit"
                            class="mt-6 w-full bg-black text-white py-2 rounded hover:bg-gray-800 transition"
                        >
                            Pagar
                        </button>

                        <p class="text-xs text-gray-500 mt-2 text-center">
                            *La pasarela de pago se implementará próximamente.
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- SCRIPT RESUMEN DINÁMICO -->
    <script>
        const inputs = document.querySelectorAll('.cantidad');
        const resumenDiv = document.getElementById('resumen');
        const totalSpan = document.getElementById('total');

        inputs.forEach(input => {
            input.addEventListener('input', actualizarResumen);
        });

        function actualizarResumen() {
            let total = 0;
            let contenido = '';

            inputs.forEach(input => {
                const cantidad = parseInt(input.value) || 0;
                if (cantidad > 0) {
                    const nombre = input.dataset.nombre;
                    const precio = parseFloat(input.dataset.precio);
                    const subtotal = cantidad * precio;
                    total += subtotal;

                    contenido += `
                        <div class="flex justify-between">
                            <span>${nombre} x${cantidad}</span>
                            <span>€${subtotal.toFixed(2)}</span>
                        </div>
                    `;
                }
            });

            if (contenido === '') {
                contenido = '<p class="text-gray-500">No hay productos seleccionados.</p>';
            }

            resumenDiv.innerHTML = contenido;
            totalSpan.innerText = total.toFixed(2);
        }
    </script>
</x-app-layout>
