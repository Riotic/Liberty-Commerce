<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Order;

// création d'un controller user pour afficher la vue des utilisateurs

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
      // appelle la bdd et compte les utilisateurs ou l'id 1 (état connecté)
      $users = DB::table('users')->where('online', '=', 1)->count();
      $orders = DB::table('orders')->count();
      //   pour avoir la commande la plus grosse on peut faire 
      $ordersmax = DB::table('orders')->max('totalPrice');
    //   $ordersnum = Order::where(function ($query) {
    //     $query->select('id')
    //         ->from('orders')
    //         ->orderByDesc('totalPrice')
    //         ->limit(1);
    // },)->get();
    $ordersnum = DB::table('orders')->select('id')->where('totalPrice', '=', $ordersmax)->get();
      // ca prendra la valeur avec la plus grosse quantité
        return view('user.index', ['users' => $users, 'orders' => $orders , 'ordermax' => $ordersmax, 'ordersnum' => $ordersnum]);
    }

}