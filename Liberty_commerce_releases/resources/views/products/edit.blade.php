@extends('layouts.default')

@section('miq')
<div class=main_div>
        <div class="square">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="child">
                            <img src="/products_pictures/{{$product->picture}}" alt="product {{$product->id}} picture"><br>
                        </div>
                        <div class="child">
                            <input type="text" placeholder="Title" name="title" value="{{$product->title}}"><br>
                        </div>
                        <div class="child">
                            <input type="file" placeholder="Image" name="picture" accept="image/*"><br>
                        <textarea name="product_description" placeholder="Description" id="" cols="10" rows="10">{{$product->product_description}}</textarea><br>
                        <input type="number" placeholder="Price" name="product_price" value="{{$product->product_price}}"><br>
                        <input type="number" placeholder="Quantity" name="product_quantity" value="{{$product->product_quantity}}"><br>
                        {{--checking product type and autocheck right radio button--}}
                        <input type="radio" name="product_type" value="Manga" {{ ($product->product_type=="Manga")? "checked" : "" }}/> Manga<br />
                        <input type="radio" name="product_type" value="JV" {{ ($product->product_type=="JV")? "checked" : "" }}/>Jeux Vidéo<br />
                    <button>
                        Update
                    </button>
                        </div>
                </form> 
        </div>
</div>

@endsection