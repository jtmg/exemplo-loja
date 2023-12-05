@extends('layouts.app')

@section('content')
    <h1>Loja de informática CHIP 8</h1>
    <div class="intro">
        <img src="/img/loja.jpg" alt="img/loja">
        <br>
        <a href="{{route("products.index")}}">Ver Produtos da Loja CHIP 8</a>
    </div>
    
@endsection