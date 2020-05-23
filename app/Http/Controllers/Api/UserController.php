<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Psr7\str;

class UserController extends Controller
{
    public function store() {
        $user = User::create([
            "name"       => request()->input("name"),
            "phone"      => request()->input("phone"),
            "image"      => null,
            "address_1"  => request()->input("address_1"),
            "address_2"  => null,
            "gps"        => request()->input("gps"),
            "state"      => UserState::ACTIVE,
            "created_at" => date("Y-m-d")
        ]);

        if (!$user)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => "User not created, try again."
            ]);

        return response()->json([
            "data"   => new UserCollection($user),
            "status" => true,
            "error"  => null
        ]);
    }

    public function update() {
        $user = User::find(request()->input("id"));

        if (!$user)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => "The user is not exist."
            ]);

        switch (request()->input("update")) {
            case "info":
                $data = [
                    "name"      => request()->input("name"),
                    "address_1" => request()->input("address_1"),
                    "address_2" => request()->input("address_2"),
                    "gps"       => request()->input("gps")
                ];
                break;
            case "image":
                if ($user->image)
                    Storage::delete($user->image);
                $data = [
                    "image" => Storage::put("public/user", request()->file('image'))
                ];
                break;
            default: $data = array();
        }

        $user->update($data);

        if (!$user)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => "The user is not updated, try again."
            ]);

        return response()->json([
            "data"   => new UserCollection($user),
            "status" => true,
            "error"  => false
        ]);
    }

    public function getByPhone($phone){
        $phone = substr(str_replace(' ', '', $phone), -10);
        $user = User::where("phone", $phone)->first();

        if (!$user)
            return response()->json([
                "data"   => null,
                "status" => false,
                "error"  => "The user is not exist."
            ]);

        return response()->json([
            "data"   => new UserCollection($user),
            "status" => true,
            "error"  => false
        ]);
    }
}
