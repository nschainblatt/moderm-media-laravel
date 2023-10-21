<?php

namespace App\Http\Controllers;

//use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            "message" => "User Added"
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $user = User::find($id);
        if (!empty($user))
        {
            return Response()->json($user);
        }
        else
        {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }


    public function update(Request $request, $id): JsonResponse
    {
        if (User::where('id', $id)->exists())
        {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->save();
            return response()->json([
                "message" => "User updated"
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }


    public function destroy($id): JsonResponse
    {
        if (User::where('id', $id)->exists())
        {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                "message" => "User deleted"
            ], 202);
        }
        else
        {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

}
