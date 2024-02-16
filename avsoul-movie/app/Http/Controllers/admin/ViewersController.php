<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ViewersController extends Controller
{
    //
    public function index()
    {
        $users = User::where(function ($query) {
            $query->where('status', '>=', 1)
                    ->where('role', 0);
        })
        ->withCount(['ratings', 'comments'])
        ->paginate(10);

        $total = $users->count();

        $data = [
            'pagename' => 'Viewers',
            'total' => $total,
            'users' => $users,
        ];

        return view('admin.viewers.list', $data);
    }
    public function changeStatus(string $id, $status)
    {
        // dd($status);
        // Tìm movie theo ID
        $user = User::findOrFail($id);

        // Cập nhật trạng thái
        $user->status = $status;
        $user->save();

        // Trả về route chính xác dựa trên mô hình RESTful
        return redirect()->route('viewers.index');
    }

    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('viewers.index');
        }

        $comments = $user->comments()->with('movie')->paginate(10);
        $ratings = $user->ratings()->with('movie')->paginate(10);


        $data = [
            'pagename' => 'DETAIL VIEWER - ' . $user->name,
            'user' => $user,
            'comments' => $comments,
            'ratings' => $ratings,
        ];

        return view('admin.viewers.detail', $data);
    }
}
