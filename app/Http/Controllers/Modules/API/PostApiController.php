<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use App\Modules\System\Post\Post;
use Illuminate\Support\Facades\Auth;

class PostApiController extends Controller
{

    public function listAllMobile()
    {
        $user = Auth::user();
        return Post::NonTask()->AccessibleByUsername($user->username)->get();
    }

}
