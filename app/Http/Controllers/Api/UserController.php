<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ResponseTrait;

    public function store(Request $request) {
        $user = User::create([
            "name"      => $request->input("name"),
            "phone"     => substr(str_replace(" ", "", $request->input("phone")), -10),
            "address_1" => $request->input("address_1")
        ]);

        if (!$user)
            return $this->simpleResponseWithMessage(false, "api.user.store-failed");

        // For get all info from db.
        $user = User::find($user->id);

        return $this->simpleResponse(new UserCollection($user));
    }

    public function update(Request $request) {
        $user = User::find($request->input("id"));

        if (!$user)
            return $this->simpleResponseWithMessage(false, "api.user.not-found");

        switch ($request->input("update")) {
            case "info":
                $data = [
                    "name"      => $request->input("name"),
                    "address_1" => $request->input("address_1"),
                    "address_2" => $request->input("address_2"),
                    "gps"       => $request->input("gps")
                ];
                break;
            case "image":
                if ($user->image)
                    Storage::delete($user->image);
                $data = [
                    "image" => Storage::put("public/user", $request->file("image"))
                ];
                break;
            default: $data = array();
        }

        $success = $user->update($data);

        if (!$success)
            return $this->simpleResponseWithMessage(false, "api.user.updated-failed");

        return $this->simpleResponse(new UserCollection($user));
    }

    public function getByPhone($phone){
        $phone = substr(str_replace(" ", "", $phone), -10);
        $user = User::where("phone", $phone)->first();

        if (!$user)
            return $this->simpleResponseWithMessage(false, "The user is not exist.");

       return $this->simpleResponse(new UserCollection($user));
    }
}
