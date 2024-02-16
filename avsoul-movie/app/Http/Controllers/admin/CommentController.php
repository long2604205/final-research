<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function index()
    {
        $total = Comment::whereIn('status', [1, 2])->count();
        $list = Comment::where(function ($query) {
            $query->where('status', '>=', 1)
                ->orwhere('status', 2);
        })->with('movie')->with('user')->paginate(10);

        $data = [
            'pagename' => 'Comments',
            'comments' => $list,
            'total' => $total,
        ];
        return view('admin.comment.list', $data);
    }

    public function destroy(string $id)
    {
        // Tìm movie theo ID
        $comment = Comment::where('id', $id)->first();


        $comment->status = 0;
        $comment->save();

        return redirect()->route('comment.index');
    }

    public function changeStatus(string $id, $status)
    {
        // Tìm movie theo ID
        $comment = Comment::findOrFail($id);

        // Cập nhật trạng thái
        $comment->status = $status;
        $comment->save();

        // Trả về route chính xác dựa trên mô hình RESTful
        return redirect()->route('comment.index');
    }
}