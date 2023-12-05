@extends('layouts.app')

@section('content')
    <h1>Loja de informática - Produtos</h1>
    <div class ="listaTipos">
        @if (isset($actTipo))
            <b>
        @endif
        <a href="{{ route('products.index') }}">Todos os produtos</a>
        @if (isset($actTipo))
            </b>
        @endif

        @foreach ($tipos as $tipo)
            @if (isset($actTipo) && $actTipo == $tipo->id)
                <b>
            @endif
            - <a href="{{ route('products.by.type', $tipo->id) }}">{{ $tipo->nome }}</a>
        @endforeach
        @if (isset($actTipo) && $actTipo == $tipo->id)
            </b>
        @endif
    </div>
    @foreach ($produtos as $produto)
        <div class = "produto">
            <a href="{{ route('products.show', $produto->id) }}">
                <img src="{{ $produto->url }}" alt="/img/produto">
                <h2>{{ $produto->nome }}</h2>
            </a>
        </div>
    @endforeach
@endsection
