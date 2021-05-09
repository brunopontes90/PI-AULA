@extends('layouts.store')
@section('content')
<section>
    <div class="row py-5">
        <div class="text-center">
            <h2>{{$tag->name}}</h2>
            <span class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores, eveniet.</span>
        </div>
        <div class="row">
            @foreach ($products() as $product)
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
    <div class="row">
        {{$products->links()}}
    </div>
</section>
@endsection
