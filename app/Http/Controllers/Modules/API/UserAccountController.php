<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    public function currentUser()
    {
        return Auth::user();
    }

}
