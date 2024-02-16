<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Respositories\Respositories;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Movie::whereIn('status', [1, 2])->count();
        $list = Movie::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->with('genres')
            ->with('ratings')
            ->paginate(10);

        $rate = Movie::with('ratings')->get();

        $data = [
            'list' => $list,
            'title' => 'List of Movie',
            'total' => $total
        ];
        return view('admin.movie.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->get();
        $data = [
            'pagename' => 'ADD NEW MOVIES',
            'method' => 'POST',
            'action' => route('movie.store'),
            'genres' => $genres,
        ];
        return view('admin.movie.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->image = $request->image;
        $movie->images = $request->images;
        $movie->description = $request->description;
        $movie->quality = $request->quality;
        $movie->age = $request->age;
        $movie->duration = $request->duration;
        $movie->year = $request->year;
        $movie->video = $request->video;
        $movie->country = $request->country;
        $movie->alias = $request->alias;
        $movie->status = $request->status;

        // Save the movie to the database
        $movie->save();

        // Get the selected genres from the request
        $genreIds = $request->input('genres');

        // Attach the genres to the movie
        $movie->genres()->attach($genreIds);

        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $genres = Genre::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->get();



        $movie = Movie::where('id', $id)->first();
        if (!$movie) {
            return redirect()->route('movie.index');
        }

        $comments = $movie->comments()->with('user')->paginate(10);

        $reviews = $movie->ratings()->with('user')->paginate(10);

        $data = [
            'pagename' => 'MOVIE DETAIL - ' . $movie->title,
            'movie' => $movie,
            'genres' => $genres,
            'comments' => $comments,
            'reviews' => $reviews,
        ];
        return view('admin.movie.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $genres = Genre::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->get();

        $movie = Movie::where('id', $id)->first();
        if (!$movie) {
            return redirect()->route('movie.index');
        }
        $data = [
            'pagename' => 'EIDT MOVIE - ' . $movie->title,
            'method' => 'PUT',
            'action' => route('movie.update', $movie->id),
            'movie' => $movie,
            'genres' => $genres,
        ];

        return view('admin.movie.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $movie = Movie::where('id', $id)->first();
        if (!$movie) {
            return redirect()->route('movie.index');
        }
        $movie->title = $request->title;
        $movie->image = $request->image;
        $movie->images = $request->images;
        $movie->description = $request->description;
        $movie->quality = $request->quality;
        $movie->age = $request->age;
        $movie->duration = $request->duration;
        $movie->year = $request->year;
        $movie->video = $request->video;
        $movie->country = $request->country;
        $movie->alias = $request->alias;
        $movie->status = $request->status;

        $movie->save();

        // Get the selected genres from the request
        $genreIds = $request->input('genres');

        $movie->genres()->detach();

        // Attach the genres to the movie
        $movie->genres()->attach($genreIds);

        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // $movie = Movie::where('id', $id)->first();
        // if (!$movie) {
        //     return redirect()->route('movie.index');
        // }

        // $movie->status = 0;
        // $result = $movie->save();

        // if ($result) {
        //     return redirect()->route('movie.index');
        // }

        $movie = Movie::where('id', $id)->first();
        if (!$movie) {
            return redirect()->route('movie.index');
        }

        $movie->status = 0;
        $result = $movie->save();

        if ($result) {
            // Lấy tất cả các xếp hạng của phim có ID là $id
            $ratings = $movie->ratings;

            // Lặp qua từng xếp hạng và cập nhật trạng thái về 0
            foreach ($ratings as $rating) {
                $rating->status = 0;
                $rating->save();
            }

            // Lấy tất cả các bình luận của phim có ID là $id
            $comments = $movie->comments;

            // Lặp qua từng bình luận và cập nhật trạng thái về 0
            foreach ($comments as $comment) {
                $comment->status = 0;
                $comment->save();
            }

            return redirect()->route('movie.index');
        }

    }
    public function changeStatus(string $id, $status)
    {
        // Tìm movie theo ID
        $movie = Movie::findOrFail($id);

        // Cập nhật trạng thái
        $movie->status = $status;
        $movie->save();

        // Trả về route chính xác dựa trên mô hình RESTful
        return redirect()->route('movie.index');
    }

}
