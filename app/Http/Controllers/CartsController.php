<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ Product;
use App\Models\ Cart;

class CartsController extends Controller
{
    public function add(Product $product){
        //SELECT * FROM CARTS WHERE PRODUCT_ID = ? AND USER_ID = ?
        $item = Cart::where([['product_id', '=', $product->id], ['user_id', '=', Auth()->user()->id]])->first();

        // SE EXISTIR, ADICIONA QUANTIDADE (FAZ UPDATE)
        if($item){
            $item->update([
                'quantity' => $item->quantity + 1
            ]);
            session()->flash('success', 'Foi adicionado mais um item ao carrinho!');
            return redirect()->back();
        }

        // SE NÃO EXISTIR, CRIAR ITEM NA TABELA
        Cart::create(
            'user_id'=> Auth()->user()->id,
            'product_id' => $product->id,
            'quantity' => 1
        );
        session()->flash('success', 'O produto foi adicionado ao carrinho!');
        return redirect()->back();
    }

    public function remove(Product $product){
        $item = Cart::where([['product_id', '=', $product->id], ['user_id', '=', Auth()->user()->id]])->first();

        // SE EXISTIR, ADICIONA QUANTIDADE (FAZ UPDATE)
        if($item->quantity > 1){
            $item->update([
                'quantity' => $item->quantity + 1
            ]);
            session()->flash('success', 'Foi removido um item do carrinho!');
            return redirect()->back();
        }

        // SE NÃO EXISTIR, CRIAR ITEM NA TABELA
       $item->delete();
       session()->flash('success', 'O removido o produto do carrinho!');
        return redirect()->back();
    }

    public function show(){
        $cart = Cart::where('user_id', '=', Auth()->user()->id)->get;
        return view('cart.show')->with('cart', $cart);
    }

}
