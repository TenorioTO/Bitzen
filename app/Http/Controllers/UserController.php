<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function validateUser($user) {
        $validator = Validator::make($user->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return $validator;
    }


    public function store(Request $request){

        $validator = $this->validateUser($request);

        if ($validator->fails()) {
            return redirect('user/create')
                ->whitError($validator);
        }

        $user = User::create($request->all());

        $token = $user->createToken('My token')->accessToken;

        return ['token' => $token->token];

    }

    public function show($id){
        return User::find($id);
    }

    public function update(Request $request, $id) {
        
        $validator  = $this->validateUser($request);

        if ($validator->fails()) {
            return response()->json('Dados incorretor!');
        }

        User::find($id)->update($request->all());

        return User::find($id);

    }

    public function exclude( $id) {
        $user = User::find($id);
        if(!$user) {
            return response()->json('Usuario não existe!');
        }

        $user->delete();

        return response()->json('Usuario excluido!');
    }
}

