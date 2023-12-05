<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\NewProductRequest;
use App\Models\Product;
use App\Models\tipo_produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    public function index(){
        $tipos = tipo_produto::all();
        $products = Product::all();
        return view('produtos', ["produtos" => $products, "tipos" => $tipos]);
    }

    public function show($id){

        $produto = Product::findOrFail($id);
    
    return view('detalhes',["produto" => $produto]);
    }

    public function create(){
        $tipos = tipo_produto::all();

        $user = auth()->user();
        $userProducts = $user->products;

        if ($userProducts->count() >= env("MAX_PRODUCTS")){
            return redirect("/home")->with("msg", "O utilizador já criou demasiados produtos");
        }

        return view("createProduct",["tipos"=>$tipos]);
    }

    public function store(NewProductRequest $request){

        $nome = request("name");
        $desc = request("desc");
        $url = "";
        $preco = request("price");
        $tipo = request("tipoProduto");

        if ($request->has("url")){
            $image = $request->file("url");

            $iname = "prod_" . time();
            $folder = "/img/produtos/";

            $fileName = $iname . "." . $image->getClientOriginalExtension();

            $filePath = $folder . $fileName;
            $image->storeAs($folder,$fileName,"public");
            $url = "/storage/".$filePath;

        }

        $produto = new  Product();
        $produto->nome = $nome;
        $produto->desc = $desc;
        $produto->url = $url;
        $produto->preco = $preco;
        $produto->tipo_produto_id = $tipo;
        $produto->created_by = auth()->user()->id;

        $produto->save();

        return redirect("/produtos/create")->with("msg","produto criado");
    }

    public function destroy($id){
        
        $produto = Product::findOrFail($id);
        $produto->delete();
        return redirect("/produtos");
    }

    public function produtosPorTipo($id){
        $tipos = tipo_produto::all();
        $tipo = tipo_produto::findOrFail($id);
        $produtos = $tipo->products;

        return view("produtos",["produtos" => $produtos, "tipos" => $tipos, "actTipo" => $id]);
    }

    public function edit($id){
        $produto = Product::findOrFail($id);
        $tipos = tipo_produto::all();

        return view("createProduct",["produto" => $produto, "tipos" => $tipos]);
    }

    public function update($id, EditProductRequest $request){

        $nome = request("name");
        $desc = request("desc");
        $preco = request("price");
        $tipo = request("tipoProduto");
        $changed = request("changed");

        $produto = Product::findOrFail($id);

        if ($changed == 'true'){
            $url = '';
            if ($request->has("url")){
                $image = $request->file("url");
    
                $iname = "prod_" . time();
                $folder = "/img/produtos/";
    
                $fileName = $iname . "." . $image->getClientOriginalExtension();
    
                $filePath = $folder . $fileName;
                $image->storeAs($folder,$fileName,"public");
                $url = "/storage/".$filePath;
                
            }
            $produto->url = $url;
        }

        $produto->nome = $nome;
        $produto->desc = $desc;
        $produto->preco = $preco;
        $produto->tipo_produto_id = $tipo;
        $produto->created_by = auth()->user()->id;
        $produto->save();
        return redirect("/produtos/$id")->with("msg", "Produto atualizado");

    }
}
