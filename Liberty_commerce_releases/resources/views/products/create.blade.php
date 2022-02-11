@extends('layouts.default')

@section('miq')
<div class=main_div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="middlesquare">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Title" name="title"><br>
            <input type="file" placeholder="Image" name="picture"><br>
            <textarea name="product_description" placeholder="Description" id="" cols="30" rows="10"></textarea><br>
            <input type="number" placeholder="Price" name="product_price"><br>
            <input type="number" placeholder="Quantity" name="product_quantity"><br>
            <input type="radio" name="product_type" value="Manga"/> Manga<br />
            <input type="radio" name="product_type" value="Jeux Vidéo"/>Jeux Vidéo<br />
            <button>
                Créer
            </button>
        </form>
    </div>
</div>
@endsection