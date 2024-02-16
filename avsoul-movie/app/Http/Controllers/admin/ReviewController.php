<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class ReviewController extends Controller
{
    //
    public function index()
    {
        $total = Rating::whereIn('status', [1, 2])->count();
        $list = Rating::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->with('movie')->with('user')->paginate(10);

        $data = [
            'pagename' => 'Reviews',
            'ratings' => $list,
            'total' => $total,
        ];
        return view('admin.review.list', $data);
    }

    public function destroy(string $id)
    {
        // Tìm movie theo ID
        $rating = Rating::where('id', $id)->first();


        $rating->status = 0;
        $rating->save();

        return redirect()->route('review.index');
    }

    public function changeStatus(string $id, $status)
    {
        // Tìm movie theo ID
        $rating = Rating::findOrFail($id);

        // Cập nhật trạng thái
        $rating->status = $status;
        $rating->save();

        // Trả về route chính xác dựa trên mô hình RESTful
        return redirect()->route('review.index');
    }
}