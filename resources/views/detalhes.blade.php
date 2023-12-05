@extends('layouts.app')

@section('content')
    <h1>Loja de informática - Detalhes</h1>

    <div class = "detalhes">
        @if (isset($produto))
            <img src="{{ $produto->url }}" alt="produto/img"> <br>
            <h2>Nome: {{ $produto->nome }}</h2> <br>
            <h3>Preço: {{ $produto->preco }}€</h3>
        @else
            <h1>O produto que selecionou não se encontra disponível!</h1>
        @endif
        @auth
        @if ($produto->created_by == auth()->user()->id || auth()->user()->isAdmin)
            <form action="{{ route('products.destroy', $produto->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button>Eliminar Produto</button>
            </form>
            <form action="{{ route('products.edit', $produto->id) }}" method="get">
                @csrf
                <button>Editar Produto</button>
            </form>
        @endif
            

        @endauth
        <a href="{{ route('products.index') }}">Voltar à listagem de produtos</a>
    </div>
@endsection
