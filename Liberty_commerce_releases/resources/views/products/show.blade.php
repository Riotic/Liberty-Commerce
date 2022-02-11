@extends('layouts.default')

@section('miq')
<div class=main_div>
    <div class="square">
        <div class="child">
            <img src="../products_pictures/{{$product->picture}}" alt="product {{$product->id}} picture">
            {{-- php echo '<img src="data:image;base64,'.base64_encode($product['picture']).'" alt="Product_picture" > ' ?> --}}
        </div>
        <div class="child">
            <p>Quantity= {{ $product->product_quantity }}<br>
                 Seller: {{ $product->user_id }}<br>
                 Catégorie: {{ $product->product_type }}<br>
                 Title : {{ $product->title }}<br>
                 {{ $product->product_description }}<br>
                 {{ $product->product_price }}€<br>

            <button class="px-4 py-2 text-white bg-blue-800 rounded" onclick='buy({{$product}});'>add to cart</button>
            <button class="px-4 py-2 text-white bg-blue-800 rounded" onclick="buy({{$product}});window.location='{{ url('/cart') }}'">buy now</button>
        </div>

    @can('update', $product)
    <a href="{{ route('products.edit', $product->id) }}">
        <button>Editer</button>
    </a>
    @endcan

    @can('delete', $product)
    <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Arrêter la vente</button>
    </form> 
    @endcan
    {{-- Permet de gérer les possibilités de suppression et de modification via les policies --}}
    </div>
</div>   
    
@endsection