@extends('layouts.default')
@section('miq')
<div class="better_display">
    {{-- affichage des données sql --}}
    <div class="minisquare">({{ $users }}) Utilisateurs connecté<button>AJAX</button></div>
    <div class="minisquare">Nombre de commandes passées :({{ $orders }})<button>AJAX</button> </div>
    <div class="minisquare">Plus grosse commande: Commande "n° {{ $ordersnum }}" pour un prix total de {{ $ordermax }} €<button>AJAX</button></div>
</div>
<script src="{{ asset('js/ajax.js') }}"></script>

@endsection