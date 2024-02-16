<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Rating;

class UserController extends Controller
{
    //
    public function index()
    {
        // $users = User::where(function ($query) {
        //     $query->where('status', '>=', 1)
        //         ->orwhere('status', 2)
        //         ->where('role', '>=', 1);
        // })->paginate(10);
        $users = User::where(function ($query) {
            $query->where('status', '>=', 1)
                    // ->where('role', '>=', 1);
                    ->whereBetween('role', [1, 3]);
        })
        ->withCount(['ratings', 'comments'])
        ->paginate(10);

        $total = $users->count();

        $data = [
            'pagename' => 'Users',
            'total' => $total,
            'users' => $users,
        ];

        return view('admin.user.list', $data);
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
        return redirect()->route('user.index');
    }

    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('user.index');
        }

        $comments = $user->comments()->with('movie')->paginate(10);
        $ratings = $user->ratings()->with('movie')->paginate(10);


        $data = [
            'pagename' => 'DETAIL USER - ' . $user->name,
            'user' => $user,
            'comments' => $comments,
            'ratings' => $ratings,
            'action' => route('user.update', $user->id),
            'method' => 'POST'
        ];

        return view('admin.user.detail', $data);
    }
    public function update(string $id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('user.index');
        }
        $user->role = $request->role;
        $result = $user->save();

        if ($result) {
            return redirect()->back()->with('success', 'Change role user successfully');
        }
    }
}