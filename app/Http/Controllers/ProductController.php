<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;
use Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index() {
        return Product::all();
    }

    public function store(ProductCreateRequest $request){

   
       $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_CREATED );
    }

    public function update(Request $request, $id){

        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED);
    }
}
