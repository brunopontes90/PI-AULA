<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        return view('category.index')->with('categories', Category::all());
    }
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        Category::create($request->all()); //FAZ O INSERT
        session()->flash('success','Categoria foi cadastrado com sucesso!');
        return redirect(route('category.index')); //RETORNA PARA A TELA DE PRODUTO
    }
    public function destroy(Category $category){

        $category->delete();
        session()->flash('success','Categoria apagadas com sucesso!');
        return redirect(route('category.index')); //RETORNA PARA A TELA DE PRODUTO

}
    public function edit(Category $category){
        return view('category.edit')->with('category', $category);
    }


    public function update(Request $request, Category $category){

            $category->update($request->all());
            session()->flash('success','Categoria alterado com sucesso!');
            return redirect(route('category.index')); //RETORNA PARA A TELA DE PRODUTO

    }

    public function show(Category $category){

    }


}
