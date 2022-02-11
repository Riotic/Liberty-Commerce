<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use DB;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $id = Auth::user()->id;
        $users = User::all();
        // connecte la bdd et identifie la classe users
        $sql = "UPDATE users SET online = 1 WHERE id= $id";
        // stockage de la requête dans une variable avec l'id qui correspond
        DB::update($sql);
        // Modification de la bdd

        $products = Product::all();
        // récupére les données de la table produits
        return view('products.index', [
            'products' => $products
        ]);
        // permet de les afficher
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // Permet d'update un status via la bdd
        $id = Auth::user()->id;
        // récupere l'id user;
        Auth::guard('web')->logout();
        $users = User::all();
        // connecte la bdd et identifie la classe users
        $sql = "UPDATE users SET online = 0 WHERE id= $id";
        // stockage de la requête dans une variable avec l'id qui correspond
        DB::update($sql);
        // Modification de la bdd

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
