<x-app-layout>

    <h2>Mis Pedidos</h2>

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    @if($pedidos->isEmpty())
        <p>Aún no has realizado ningún pedido.</p>
    @else
        @foreach($pedidos as $pedido)
            <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">
                <h4>Pedido #{{ $pedido->id }}</h4>
                <p>Fecha: {{ $pedido->fecha->format('d/m/Y') }}</p>
                <p>Estado: {{ $pedido->estado }}</p>
                <p>Total: €{{ number_format($pedido->total, 2) }}</p>
            </div>
        @endforeach
    @endif

    <a href="{{ route('pedidos.create') }}">
        <button>Realizar Pedido</button>
    </a>

</x-app-layout>
