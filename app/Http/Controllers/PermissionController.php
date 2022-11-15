<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();

        return response($permissions, Response::HTTP_ACCEPTED);
    }


    public function store(Request $request) {
        $permissions = Permission::create($request->only('name'));

        return response($permissions, Response::HTTP_CREATED);
    }

    public function show($id) {
        $permissions = Permission::find($id);

        return response($permissions, Response::HTTP_ACCEPTED);
    }

    public function update(Request $request, $id){
        $permissions = Permission::find($id);

        $permissions->update($request->only('name'));

        return response($permissions, Response::HTTP_ACCEPTED );
    }

    public function destroy($id){

        $permissions = Permission::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
