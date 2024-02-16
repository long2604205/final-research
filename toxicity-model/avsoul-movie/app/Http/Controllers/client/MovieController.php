<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class MovieController extends Controller
{
    //
    public function details(string $alias, $id)
    {
        // $movie = Movie::with('ratings')->findOrFail($id);
        $id = $id;
        // $movie = Movie::with('ratings.user')->findOrFail($id);
        $movie = Movie::with(['ratings' => function ($query) {
            // Lọc các xếp hạng có trạng thái là 1
            $query->where('status', 1);
        }])->findOrFail($id);
        $moviex = Movie::with(['ratings.user' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        $ratings = $moviex->ratings()->paginate(5);

        // $total_comment = Comment::whereIn('status', [1])->count();
        // $total_rate = Rating::whereIn('status', [1])->count();
        $total_comment = Comment::where('movie_id', $id)
        ->where('status', 1)
        ->count();

        $total_rate = Rating::where('movie_id', $id)
            ->where('status', 1)
            ->count();

        // $comment_reply = Movie::with(['comments.user', 'comments.replies.user'])->find($id)->paginate(5);
        // $comment_reply = Movie::find($id)->comments()->with('user', 'replies.user')->paginate(5);
        $comment_reply = Movie::find($id)->comments()->with('user', 'replies.user')->where('status', 1)->orderBy('created_at', 'desc')->paginate(5);




        $flag = $this->hasReviewedMovie($id);
        $data = [
            'movie' => $movie,
            'method' => 'GET',
            'flag' => $flag,
            'total_comment' => $total_comment,
            'total_rate' => $total_rate,
            'comment_reply' => $comment_reply,
            'ratings' => $ratings
        ];
        return view('client.movie.details', $data);
    }
        // Hàm để kiểm tra xem người dùng đã review phim hay chưa
    public function hasReviewedMovie($movieId)
    {
        $userId = Auth::id();
        $hasReviewed = Rating::where('movie_id', $movieId)
                        ->where('user_id', $userId)
                        ->exists();
        return $hasReviewed;
    }


    public function review(Request $request)
    {
        $rating = new Rating();
        $rating->movie_id = $request->movie_id;
        $rating->user_id = Auth::id(); // Lấy ID của user hiện tại
        $rating->title = $request->title;
        $rating->rate = $request->rate;
        $rating->content = $request->content;
        $rating->save();

        // Lấy thông tin user đã đánh giá
        $user = $rating->user()->first();

        // Định dạng ngày giờ
        $formattedDateTime = $rating->created_at->format('Y-m-d H:i:s');

        // Trả về thông tin đánh giá và thông tin user trong response JSON
        return response()->json([
            'rating' => [
                'title' => $rating->title,
                'rate' => $rating->rate,
                'content' => $rating->content,
                'created_at' => $formattedDateTime,
                'user_name' => $user->name,
                'avatar' => $user->avatar
            ]
        ]);
    }

    public function showForm()
    {
        return view('client.movie.showForm');
    }

    // public function predict(Request $request)
    // {
    //     $comment = $request->input('comment');
    //     $apiUrl = 'http://127.0.0.1:5000/predict'; // Địa chỉ API của Flask

    //     $response = Http::post($apiUrl, ['comment' => $comment]);
    //     $result = $response->json();

    //     return view('client.movie.ketqua', ['result' => $result]);
    // }

    public function predict(Request $request)
    {
        $comment = $request->input('comment');
        $apiUrl = 'http://127.0.0.1:5000/predict'; // Địa chỉ API của Flask

        $response = Http::post($apiUrl, ['comment' => $comment]);
        $result = $response->json();

        return response()->json($result);
    }


    public function comment(Request $request)
    {
        $comment = new Comment();
        $comment->movie_id = $request->movie_id;
        $comment->user_id = Auth::id(); // Lấy ID của user hiện tại
        $comment->content = $request->content;
        $comment->save();

        // Lấy thông tin user đã đánh giá
        $user = $comment->user()->first();

        // Định dạng ngày giờ
        // $formattedDateTime = $comment->created_at->format('Y-m-d H:i:s');
        $formattedDateTime = Carbon::parse($comment->created_at)->format('F j, Y, H:i');


        // Trả về thông tin đánh giá và thông tin user trong response JSON
        return response()->json([
            'comment' => [
                'content' => $comment->content,
                'like_count' => $comment->like_count,
                'dislike_count' => $comment->dislike_count,
                'created_at' => $formattedDateTime,
                'user_name' => $user->name,
                'avatar' => $user->avatar
            ]
        ]);
        // return redirect()->back();
    }

}