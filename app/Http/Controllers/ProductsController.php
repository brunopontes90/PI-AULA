<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class ProductsController extends Controller
{
    public function index(){
        //ENTRA NA PASTA VIEW > PRODUCT E EXECULTA O INDEX.BLADE.PHP
        //'products' SERA O NOME DA TABELA, 'Products::all()' RETORNA TODA A TABELA
        return view('product.index')->with('products', Product::all());
    }

    public function create(){
        return view('product.create')->with(['categories' => Category::all(), 'tags' => Tag::all()]);
    }

    public function store(Request $request){
        // VERIFICA SE ESTA SENDO ADICIONADO ALGUMA IMAGEM AO UPLOAD DE IMAGEM
        if ($request->image) {
            $image =  $request->file('image')->store('product'); //PEGA A IMAGEM QUE VEM DO REQUEST E SALVA NA PRODUCT
            $image = "storage/".$image;
        }else{
            $image  ="storage/product/imagem.jpg"; //DEIXA COMO PADRÃO
        }

        $product = Product::create([ //FAZ O INSERT
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image
        ]);

        // SINCRONIZA A PRODUCT COM A TAG
        $product->tags()->sync($request->tags);
        session()->flash('success','Produto foi cadastrado com sucesso!');
        return redirect(route('product.index')); //RETORNA PARA A TELA DE PRODUTO
    }

    public function edit(Product $product){
        return view('product.edit')->with(['product'=>$product, 'categories'=>Category::all(), 'tags' => Tag::all()]);
    }


    public function update(Request $request, Product $product){
             // VERIFICA SE ESTA SENDO ADICIONADO ALGUMA IMAGEM AO UPLOAD DE IMAGEM
        if ($request->image) {
            $image =  $request->file('image')->store('product'); //PEGA A IMAGEM QUE VEM DO REQUEST E SALVA NA PRODUCT
            $image = "storage/".$image;
            if (!$product->image != "storage/product/imagem.jpg"){
                Storage::delete(str_replace('storage/', '', $product->image));
            }
        }else{
            $image = $product->image; //DEIXA COMO PADRÃO
        }
            $product->update([ //FAZ O INSERT
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'image' => $image
            ]);
            $product->tags()->sync($request->tags);
            session()->flash('success','Produto alterado com sucesso!');
            return redirect(route('product.index')); //RETORNA PARA A TELA DE PRODUTO

    }

    public function destroy(Product $product){

            $product->delete();
            session()->flash('success','Produto apagado com sucesso!');
            return redirect(route('product.index')); //RETORNA PARA A TELA DE PRODUTO

    }

    public function show(Product $product){
        return view('product.show')->with('product', $product);
    }

    /*
        1) onlyTrashed - PEGA TODOS OS PRODUTOS QUE ESTÃO NO LIXO E RETORNA UMA COLLECTION
        2) O GET() IRA PEGAR ESSA COLLECTION E RETORNA UM JSON
    */
    public function trash(){
        return view('product.trash')->with('products', Product::onlyTrashed()->get());
    }

    public function restore($id){
        $product = Product::onlyTrashed()->where('id', $id)->firstOrFail(); // FILTRA POR ID E RETORNA O 1º
        $product->restore();
        session()->flash('success','Produto restaurado com sucesso!');
        return redirect(route('product.trash'));
    }
}
