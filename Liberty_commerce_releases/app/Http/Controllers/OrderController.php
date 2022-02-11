<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function index()
    {
      // appelle la bdd et compte les utilisateurs ou l'id 1 (état connecté)
      $orders = DB::table('orders')->count();

    //   pour avoir la commande la plus grosse on peut faire 
    // $orders = DB::table('orders')->max('quantity');
    // ca prendra la valeur avec la plus grosse quantité
    
     
        return view('order.index', ['orders' => $orders]);
    }
}
