<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Movie;
use App\Genre;

class MovieController extends Controller
{
	public function index(Request $request)
	{
		if(!isset($request->letter))
		{
			$movies = Movie::with('genre')->orderBy('title')->get();
			return view('movie.index', [
				'movies' => $movies
			]);
		} else {
			$searchMovies = Movie::with('genre')->where('title', 'LIKE', "{$request->letter}%")->get();
			return view('movie.index', [
				'searchMovies'	=> $searchMovies
			]);
		}
	}

	public function create()
	{
		$genres = Genre::orderBy('name')->get();
		$select = [];
		foreach ($genres as $genre) {
			$select[$genre->id] = $genre->name;
		}	
		$years = range(date('Y'), 1900);
		$yearSel = [];
		foreach ($years as $year) {
			$yearSel[$year] = $year;
		}
		$movies = Movie::with('genre')->orderBy('title')->get();
		return view('movie.create', compact('select'), compact('yearSel'))->with('movies', $movies);
	}

	public function store(MovieRequest $request)
	{
		$movies = Movie::where('title', '=', $request->input('title'))->where('genre_id', '=', $request->input('genre_id'))->where('year', '=', $request->input('year'))->where('duration', '=', $request->input('duration'))->get();
		if(count($movies) > 0) {
			return redirect()->route('movie.create')->with('message', 'Ovaj film već postoji!');
		}
		else 
		{
			$filenameWithExt = $request->image->getClientOriginalName();
	    	// Get just filename without extension
	    	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// Get extension
			$extension = $request->image->getClientOriginalExtension();
			// Create new filename
			$filenameTo = $filename.'_'.time();
			$filenameToStore = $filename.'_'.time().'.'.$extension;
			$request->image->storeAs('images', $filenameToStore, 'public');
			$movie = new Movie;
			$movie->title = $request->input('title');
			$movie->genre_id = $request->input('genre_id');
			$movie->year = $request->input('year');
			$movie->duration = $request->input('duration');
			$movie->image = $filenameToStore;
			$movie->save();
			return redirect()->route('movie.index')->with('message', 'Novi film kreiran!');
		}		  
	}

	public function edit($id)
	{
		$movie = Movie::findOrFail($id);
		$genres = Genre::orderBy('name')->get();
		$select = [];
		foreach ($genres as $genre) {
			$select[$genre->id] = $genre->name;
		}	
		$years = range(date('Y'), 1900);
		$yearSel = [];
		foreach ($years as $year) {
			$yearSel[$year] = $year;
		}
		return view('movie.edit', compact('select'), compact('yearSel'))->with('movie', $movie);
	}

	public function update($id, Request $request)
	{
		$this->validate($request, [
			'title'     => 'required|min:2|max:191', 
            'genre_id'  => 'required', 
            'year'      => 'required|digits:4', 
            'duration'  => 'required|min:2|max:1440|numeric',
            'image'     => 'image|max:1999'
		]);
		
		$movies = Movie::where('title', '=', $request->input('title'))->where('genre_id', '=', $request->input('genre_id'))->where('year', '=', $request->input('year'))->where('duration', '=', $request->input('duration'))->get();
		if(count($movies) > 0) 
		{
			return redirect()->route('movie.create')->with('message', 'Ovaj film već postoji!');
		}	
		else 
		{
			$editMovie = Movie::findOrFail($id);
			if($_FILES['image']['name'] == "") 
			{
				$filenameToStore = $editMovie->image;
			} 
			else 
			{
				$filenameWithExt = $request->image->getClientOriginalName();
		    	// Get just filename without extension
		    	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				// Get extension
				$extension = $request->image->getClientOriginalExtension();
				// Create new filename
				$filenameTo = $filename.'_'.time();
				$filenameToStore = $filename.'_'.time().'.'.$extension;
				$request->image->storeAs('images', $filenameToStore, 'public');
			}
	        $editMovie->title = $request->input('title');
	        $editMovie->genre_id = $request->input('genre_id');
	        $editMovie->year = $request->input('year');
	        $editMovie->duration = $request->input('duration');
	        $editMovie->image = $filenameToStore;
	        $editMovie->save();
	        return redirect()->route('movie.index')->with('message', 'Film uređen');
	    }    
	}

	public function destroy($id)
	{
		$movie = Movie::findOrFail($id);
		unlink(public_path()."/storage/images/".$movie->image);
		$movie->delete();
        return redirect()->route('movie.create')->with('message', 'Film izbrisan!');
	}
}	