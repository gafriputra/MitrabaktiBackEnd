<?php

namespace App\Http\Controllers;

// panggil from validation request
use App\Http\Requests\ProductGalleryRequest;
// model
use App\models\Product;
use App\models\ProductGallery;

class ProductGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // langsung berelasi dengan product, panggil method didlm model
        $items = ProductGallery::with('product')->orderBy('id', 'DESC')->get();
        // tampilkan view dengan ngirim datanya juga
        return view('pages.product-galleries.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ambil data product
        $products = Product::all();
        // tampilkan view
        return view('pages.product-galleries.create')->with([
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        // die;
        $data['image'] = $request->file('image')->store(
            'assets/product',
            'public'
        );

        ProductGallery::create($data);
        return redirect()->route('product-galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductGalleryRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cari product
        $item = ProductGallery::findOrFail($id);
        // hapus
        $item->delete();
        return redirect()->route('product-galleries.index');
    }
}
