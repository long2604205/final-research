<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $total = Genre::whereIn('status', [1, 2])->count();
        $list = Genre::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->paginate(10);
        $data = [
            'list' => $list,
            'title' => 'Genres',
            'total' => $total,
        ];
        return view('admin.genres.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'pagename' => 'ADD NEW GENRES',
            'method' => 'POST',
            'action' => route('genre.store'),
        ];
        return view('admin.genres.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        Genre::insert([
            'title' => $request->title,
            'status' => $request->status,
            'image' => $request->image,
        ]);

        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $genre = Genre::where('id', $id)->first();
        if (!$genre) {
            return redirect()->route('genre.index');
        }
        $data = [
            'pagename' => 'EDIT GENRE - ' . $genre->title,
            'method' => 'PUT',
            'action' => route('genre.update', $genre->id),
            'genre' => $genre,
        ];
        return view('admin.genres.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $genre = Genre::where('id', $id)->first();
        if (!$genre) {
            return redirect()->route('genre.index');
        }
        Genre::where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'image' => $request->image,
        ]);
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // $genre = Genre::where('id', $id)->first();
        // if (!$genre) {
        //     return redirect()->route('genre.index');
        // }

        // $genre->status = 0;
        // $result = $genre->save();

        // if ($result) {
        //     return redirect()->route('genre.index');
        // }

        $genre = Genre::where('id', $id)->first();
        if (!$genre) {
            return redirect()->route('genre.index');
        }

        $genre->status = 0;
        $result = $genre->save();

        if ($result) {
            // Lấy tất cả các phim thuộc thể loại có ID là $id
            $movies = $genre->movies;

            foreach ($movies as $movie) {
                // Kiểm tra xem phim có chỉ thuộc về một thể loại hay không
                if ($movie->genres->count() == 1 && $movie->genres->first()->status == 0) {
                    // Cập nhật trạng thái của phim về 0
                    $movie->status = 0;
                    $movie->save();
                }
            }

            return redirect()->route('genre.index');
        }
    }
    public function changeStatus(string $id, $status)
    {
        // Tìm movie theo ID
        $genre = Genre::findOrFail($id);

        // Cập nhật trạng thái
        $genre->status = $status;
        $genre->save();

        // Trả về route chính xác dựa trên mô hình RESTful
        return redirect()->route('genre.index');
    }
}