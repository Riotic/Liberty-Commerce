@extends('layouts.default')

@section('miq')

<div class=main_div>
    @if ($message = Session::get("success"))
        <p style="float: left; position: absolute; top:70px; left:20px;">
            {{ $message }}
        </p>
    @endif
    @foreach ($products as $product)
        <div class="space_around">
            <div class="block">
                <div class="child">
                    <img src="../products_pictures/{{$product->picture}}" alt="product {{$product->id}} picture">
                </div>
                <div class="child">
                    <p>
                        Titre: {{ $product->title }}
                    </p>
                    <p>
                        Price:{{ $product->product_price }}€<br>
                        Quantity= {{ $product->product_quantity }}<br>
                        {{-- <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->title }}" name="name">
                            <input type="hidden" value="{{ $product->product_price }}" name="price">
                            <input type="hidden" value="{{ $product->picture }}"  name="image">
                            <input type="hidden" value="1" name="quantity">
                            
                            <button class="px-4 py-2 text-white bg-blue-800 rounded">Add to cart</button><br>
                        </form> --}}
                        {{-- <form action="{{ route('cart.buynow') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->title }}" name="name">
                            <input type="hidden" value="{{ $product->product_price }}" name="price">
                            <input type="hidden" value="{{ $product->picture }}"  name="image">
                            <input type="hidden" value="1" name="quantity">
                            
                            <button class="px-4 py-2 text-white bg-blue-800 rounded">Buy now</button><br>
                        </form> --}}
                        <button class="px-4 py-2 text-white bg-blue-800 rounded" onclick='buy({{$product}});'>add to cart</button> {{-- add cart with onclick by product --}}
                        <button class="px-4 py-2 text-white bg-blue-800 rounded" onclick="buy({{$product}});window.location='{{ url('/cart') }}'">buy now</button>{{-- add cart with onclick by product + redirection --}}
                    <div>
                        <a href="{{ route('products.show', $product->id) }}">Description Produit</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
