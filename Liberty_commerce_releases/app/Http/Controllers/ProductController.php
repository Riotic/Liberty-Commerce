<?php


namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::all();
        // récupére les données de la table produits
        return view('products.index', [
            'products' => $products
        ]);
        // permet de les afficher
    }

    public function productList()
    {
        $products = Product::all();

        return view('carts.products', compact('products'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'picture' => 'required',
            'product_description' => 'required|max:1000',
            'product_price' => 'required|max:1000',
            'product_type' => 'in:Manga,Jeux Vidéo',
            'product_quantity' => 'required|max:1000'
        ]);
        $validated['user_id']= Auth::user()->id;
        //recovering initial pic_name 
        $filename=$request->file('picture') ->getClientOriginalName() ;
        $filename=date("Y-m-d_H:i:s") . $filename;
        //upload folder in a folder and adding dateTime for avoid name mismatch
        $request->file('picture') -> storeAs('products_pictures', $filename, [ 'disk' => 'products_pictures']);
        //storing path on the BDD 
        $validated['picture']=$filename;

        $product = Product::create($validated);
        return redirect()->route('products.show' , ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //$products = Product::all();
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'product_description' => 'required|max:1000',
            'product_price' => 'required|max:1000',
            'product_type' => 'in:Manga,JV',
            'product_quantity' => 'required|max:1000'
        ]);

        //checking if a new image as been uploaded from the update form if not keeping actual image 
        if(empty($request->file('picture'))) 
        {
            $product->title=$validated['title'];
            $product->product_description=$validated['product_description'];
            $product->product_price=$validated['product_price'];
            $product->product_type=$validated['product_type'];
            $product->product_quantity=$validated['product_quantity'];
            $product->save();
            return redirect()->route('products.show' , ['product' => $product->id]);
            // redirige vers la page produit une fois le produit modifié
        } 
        //if a new images as been added we do following actions 
        else 
        {
            //recovering path of the old picture
            $path = public_path('products_pictures/'.$product->picture);
            //checking if old picture is already in this directory if yes deleting the picture
            if(file_exists($path))
            {
                unlink($path);
            } 
            //recovering initial file name
            $filename=$request->file('picture') ->getClientOriginalName();
            $filename=date("Y-m-d_H:i:s") . $filename;
            //upload folder in a folder and adding dateTime for avoid name mismatch
            $request->file('picture') -> storeAs('products_pictures', $filename, [ 'disk' => 'products_pictures']);
            //storing path on the BDD 
            $validated['picture']=$filename;
            $product->title=$validated['title'];
            $product->picture=$validated['picture'];
            $product->product_description=$validated['product_description'];
            $product->product_price=$validated['product_price'];
            $product->product_type=$validated['product_type'];
            $product->product_quantity=$validated['product_quantity'];
            $product->save();
            return redirect()->route('products.show' , ['product' => $product->id]);
            // redirige vers la page produit une fois le produit modifié
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //recovering path of the old picture
        $path = public_path('products_pictures/'.$product->picture);
        //checking if old picture is already in this directory if yes deleting the picture
        if(file_exists($path))
        {
            unlink($path);
        } 
        $product->delete();
        return redirect()->route('products.index');
    }
}



