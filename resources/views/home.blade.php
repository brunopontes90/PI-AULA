@extends('layouts.store')
@section('css')
<style>
    #banner{
        background: url('https://via.placeholder.com/2000x800');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 400px;
    }
</style>
@endsection
@section('content')
<section id="banner" class="d-flex align-items-cente px-4">
    <div>
        <span class="h2 d-block text-capitalize mb-0">Toda nossa loja está</span>
        <span class="h1 d-block text-uppercase font-weight-bold mb-3">em promoção</span>
        <button class="btn btn-lg btn-primary">Veja nossos produtos</button>
</section>

<section>
    <div class="row py-5">
        <div class="text-center">
            <h2>Produtos em Promoção</h2>
            <span class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores, eveniet.</span>
        </div>

        @foreach (\App\Models\Product::promocoes() as $product)
            <div class="row">
                <div class="col-lg-4 col-md-2 col-sm-10">
                    <div class="text-center" style="height: 250px;">
                        <img src="{{asset($product->image)}}" class="h-100">
                    </div>
                    <div class="text-center">
                        <span class="d-block font-weight-bold">{{$product->name}}</span>
                        <span class="d-block">R${{$product->price}}</span>
                        <div class="mt-2">
                            <a href="{{route('product.show', $product->id)}}" class="btn btn-secondary">Visualizar</a>
                            <a href="{{route('cart.add', $product->id)}}" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
