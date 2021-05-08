<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(){
        return view('tag.index')->with('tags', Tag::all());
    }

    public function create()
    {
        return view('tag.create');
        session()->flash('success','Categoria foi cadastrado com sucesso!');
        return redirect(route('tag.index')); //RETORNA PARA A TELA DE PRODUTO
    }

    public function store(Request $request)
    {
        Tag::create($request->all()); //FAZ O INSERT
        session()->flash('success','Tag foi cadastrado com sucesso!');
        return redirect(route('tag.index')); //RETORNA PARA A TELA DE PRODUTO
    }


    public function show(Tag $tag){
        return view('tag.show')->with(['tag' => $tag, 'products' => $tag->products()->paginate(3)]);
    }


    public function edit(tag $tag)
    {
        return view('tag.edit')->with('tag', $tag);
    }

    public function update(Request $request, tag $tag)
    {
        $tag->update($request->all());
        session()->flash('success','Tag alterado com sucesso!');
        return redirect(route('tag.index')); //RETORNA PARA A TELA DE PRODUTO
    }

    public function destroy(tag $tag)
    {
        //SÓ PODE APAGAR SE A CATEGORIA NÃO TIVER NENHUM PRODUTO
        if($tag->products()->count() > 0){
            session()->flash('success','Você não pode deletar a tag que tenha produto!');
            return redirect(route('tag.index')); //RETORNA PARA A TELA DE PRODUTO
        }

        $tag->delete();
        session()->flash('success','Tag apagadas com sucesso!');
        return redirect(route('tag.index')); //RETORNA PARA A TELA DE PRODUTO
    }
}
