<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Category;
use App\Models\Ator;
use App\Models\Avaliation;

class FilmController extends Controller
{
    /**
     * Display a listing oFilm the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Film::all();
    }

    /**
     * Show the Filmorm Filmor creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $film = new Film;
        $film->titulo = $request->titulo;
        $film->ano = $request->ano;
        $categoryId = $request->categoria;
        $atores = $request->atores;
        $film->save();
        $film->categories()->attach($categoryId);
        $film->actors()->attach($atores);

        return response()->json($film);

    }

    /**
     * Display the speciFilmied resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Film::with('categories', 'actors')->find($id);

    }

    // Search filter
    public function search(Request $request){
        
        $terms = $request->only('titulo', 'nome', 'categoria');

        foreach($terms as $nome => $valor) {
            if($valor) {
                if($nome === 'categoria'){
                    $found = Category::with('films')->where($nome, 'LIKE', '%' . $valor . '%')->get();
                }

                if($nome === 'nome') {
                    $found = Ator::with('films')->where($nome, 'LIKE', '%' . $valor . '%')->get();
                }

                if($nome === 'titulo') {
                    $found = Film::where($nome, 'LIKE', '%' . $valor . '%')->get();
                }
            } else {
                return response()->json('Campo de pesquisa vazio!');
            }
        }
        return response()->json($found);

        
    }

    // top 10 rank of best rate
    public function relatorio() {
        $avaliations = Avaliation::with('film')->orderByRaw('rate DESC')->get();

        $rankId = $avaliations->map(function ($film) {
            return $film->film_id;
        });

        return Film::find($rankId)->groupBy('id')->take(10);
    } 

    /**
     * Show the Filmorm Filmor editing the speciFilmied resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the speciFilmied resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Film::find($id)->update($request->all());

        return Film::find($id);
    }

    /**
     * Remove the speciFilmied resource Filmrom storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::find($id);
        if(!$film) {
            return response()->json('Filmilme não existe!');
        }

        $film->delete();

        return response()->json('Filmilme excluido!');
    }
}
