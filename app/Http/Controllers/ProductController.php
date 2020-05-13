<?php

namespace App\Http\Controllers;

// panggil model request product
use App\Http\Requests\ProductRequest;
// slug bawaan laravel
use illuminate\Support\Str;
// panggil model
use App\Models\Product;
use App\models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        // ambil semua data
        $items = Product::orderBy('id', 'DESC')->get();
        // tampilkan view
        return view('pages.products.index')->with([
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
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // insert semuanya jika sudah divalidasi oleh ProductRequest
        $data = $request->all();
        // bikin slug, pakai method bawaan laravel
        $data['slug'] = Str::slug($request->name);
        // insert data
        Product::create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // jika ketemu keluarkan data, jika tidak lgsg page 404
        $item = Product::findOrFail($id);
        return view('pages.products.edit')
            ->with([
                'item' => $item
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // insert semuanya jika sudah divalidasi oleh ProductRequest
        $data = $request->all();
        // bikin slug, pakai method bawaan laravel
        $data['slug'] = Str::slug($request->name);
        // cari data
        $item = Product::findOrFail($id);
        // update data
        $item->update($data);
        return redirect()->route('products.index');
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
        $item = Product::findOrFail($id);
        // hapus
        $item->delete();
        // hapus gambar
        ProductGallery::where('product_id', $id)->delete();
        return redirect()->route('products.index');
    }

    public function gallery(Request $request, $id)
    {
        // $product = Product::findOrFail($id);
        // panggil method untuk relasi, yg sama seperti id
        $items = ProductGallery::with('product')
            ->where('product_id', $id)
            ->get();
        return view('pages.product-galleries.index')->with([
            'items' => $items
        ]);
    }
}
