@extends('layouts.app')

@section('content')
    <h1>Loja de informática - 
        @if (isset($produto))
            Editar Produto
        @else
            Criar Produto 
        @endif
        </h1>
    <div class="detalhes">
        <p>{{session("msg")}}</p>
        @if ($errors->any())
            <div class = "error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li> 
                    @endforeach
                </ul>
            </div>    
        @endif
        
        <form 
            @if (isset($produto))
                action="{{route("products.update",$produto->id)}}"
            @else
                action="{{route("products.store")}}"
            @endif
            method="post" enctype="multipart/form-data">
            @csrf

            @if (isset($produto))
               @method("PUT") 
            @endif

            <label for="name"> Nome do Produto: </label>
            <input type="text" id = "name" name = "name"
            @if (isset($produto))
                value="{{$produto->nome}}" 
            @endif
            >
            <br>

            <label for="desc"> Descrição do produto</label>
            <input type="text" id = "desc" name ="desc" 
            @if (isset($produto))
                value="{{$produto->desc}}" 
            @endif>
            <br>

            <label for="url"> Url da imagem do produto</label>
            <input type="hidden" id="changed" value = "false">
            <input type="file" id = "url" name ="url" 
                onchange="document.getElementById('changed').value='true'"
            >@if (isset($produto))
                (não alterar para manter a imagem)
            @endif
            <br>
            
            <label for="price"> Preço do produto</label>
            <input type="text" id = "price" name ="price"
            @if (isset($produto))
                value="{{$produto->preco}}" 
            @endif
            >
            <br>
            <label for="tipoProduto">Tipo de Produto:</label>
            <select name="tipoProduto" id="tipoProduto">
                
                @foreach ($tipos as $tipo)
                    <option value="{{$tipo->id}}"
                    @if (isset($produto) && $produto->tipo_produto_id == $tipo->id)
                        selected="selected"     
                    @endif
                    >{{$tipo->nome}}</option>
                @endforeach
            </select>
            <br>
            <input type="submit" 
            @if (isset($produto))
                value="Editar Produto"
            @else
                value="Criar Produto" 
            @endif
            >
        </form>

        <a href="{{route("products.index")}}">Voltar para a página de produtos</a>
    </div>
@endsection