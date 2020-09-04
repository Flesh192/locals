<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\UserMute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(PostRequest $request)
    {
        $order = $request->getOrder();
        $key = request()->fingerprint().$order;
        $data = Cache::get($key);
        if ($data === null) {
            //$userId = Auth::user()->id
            //to simplify I will use current user id = 1
            $userId = 1;
            $posts = Post::whereNotIn('user_id', UserMute::where('user_id', $userId)->where('expired_at', '>=',
                Carbon::now())->pluck('mute_user_id')->toArray());

            if ($order == 'random'){
                $posts->inRandomOrder();
            } else {
                $posts->orderBy('created_at', $order);
            }
            $posts->limit(50);

            $data = $posts->get()->toArray();
            Cache::put($key, $data);
        }

        return response()->json($data);
    }
}
