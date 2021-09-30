<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserListResource;
use App\Models\{User};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('username', 'LIKE', '%' . $request->username . '%')->oldest('username')->get();
        return response()->json(['status' => 'true', 'message' => '', 'data' => UserListResource::collection($users)]);
    }
}
