<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliation;
use App\Models\User;
use App\Models\Film;

class AvaliationController extends Controller
{
    
    public function store(Request $request) {
        $avaliation = new Avaliation;
        $userId = $request->userId; 
        $filmId = $request->filmId;
        $rate = $request->rate;

        if(!User::find($userId)){
            return response()->json("Usuário Incorreto!");
        }

        if(!Film::find($filmId)){
            return response()->json("Filme Incorreto!");
        }

        $findAvaliation = $avaliation::where('user_id', $userId)->where('film_id', $filmId)->get();

        foreach($findAvaliation as $data) {
            if(!empty($data)) {
               return response()->json("Erro, uma avaliação existente para este filme"); 
            }
        }

        if($rate > "0" && $rate < "6"){
            $avaliation->user_id = $userId;
            $avaliation->film_id = $filmId;
            $avaliation->rate = $rate;
            $avaliation->save();
            return $avaliation;
        } else {
            return redirect('/avaliation/create')->with('status', 'Avaliação deve ser entre 0 e 5');
        }
        
    }
}
