<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(){
        $order = Order::all();
        return response(OrderResource::collection($order), Response::HTTP_ACCEPTED);
    }

    public function show($id){
        $order = Order::find($id);

        return response(new OrderResource($order), Response::HTTP_ACCEPTED);
    }
}
