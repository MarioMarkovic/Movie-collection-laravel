<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', [
            'genres'    => $genres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(GenreRequest $request)
    {
        $genres = Genre::where('name', '=', $request->input('name'))->get();
        if(count($genres) > 0) {
            return redirect()->route('genre.create')->with('message', 'Ovaj žanr već postoji!');
        }
        else 
        {
            $genre = new Genre;
            $genre->name = $request->input('name');
            $genre->save();
            return redirect()->route('genre.index')->with('message', 'Novi žanr kreiran!');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('genre.edit', [
            'genre' => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update($id, GenreRequest $request)
    {
        $genres = Genre::where('name', '=', $request->input('name'))->get();
        if(count($genres) > 0) {
            return redirect()->route('genre.create')->with('message', 'Ovaj žanr već postoji!');
        }
        else 
        {
            $genre = Genre::findOrFail($id);
            $genre->name = $request->input('name');
            $genre->save();
            return redirect()->route('genre.index')->with('message', 'Žanr uspješno izmijenjen');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        Genre::destroy($id);
        return redirect()->route('genre.index')->with('message', 'Žanr izbrisan!');
    }
}
