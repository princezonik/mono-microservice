<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantCreateRequest;
use App\Models\Restaurant;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends Controller
{

    public function index(){
        $res = Restaurant::all();

        return response($res, Response::HTTP_ACCEPTED);
    }

    public function store(RestaurantCreateRequest $request){
        $res = Restaurant::create($request->only('name','address', 'email', 'phone'));

        return response($res, Response::HTTP_CREATED);

    }

    public function show($id) {
        $res = Restaurant::find($id);
        return response($res, Response::HTTP_ACCEPTED);
    }

    public function update(Request $request, $id) {
        $res = Restaurant::find($id);
        $res->update($request->only('name', 'address', 'email', 'phone'));
        return response($res, Response::HTTP_ACCEPTED);
    }

    public function destroy($id) {
        $res = Restaurant::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }



    // public function findNearestRestaurants($latitude, $longitude, $radius = 400){

    //     $restaurants = DB::table('restaurants')
    //                     ->selectRAW("id, name, address, latitude, longitude, rating, zone, (637100 * acos(cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance)", [$latitude, $longitude, $latitude])
    //                     ->where('active', '=', 1)
    //                     ->having("distance", "<", $radius)
    //                     ->orderBy("distance", 'asc')
    //                     ->offset(0)
    //                     ->limit(20)
    //                     ->get();

    //     return $restaurants;

    // }
}
