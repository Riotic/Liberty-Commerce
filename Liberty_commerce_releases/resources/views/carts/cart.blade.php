@extends('layouts.default')

@section('miq')
  {{-- Cart realisation --}}
  <div class="Cart">
    <div class="Header"></div>
    <div class="Corp"></div>
    <div class="Checkout">
      <form class="unset Button"  method="POST" action="{{ route('cart.checkout') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order" value="" id="order">
        <input type="hidden" name="qtyOfItems" value="" id="qtyOfItems">
        <input type="hidden" name="totalPrice" value="" id="totalPrice">
        <button class="unset Button" onclick="removeAll()">Checkout</button>
    </form>
    </div>
  </div>
  <script>setTimeout(function() {generateCart();},250)</script>
@endsection