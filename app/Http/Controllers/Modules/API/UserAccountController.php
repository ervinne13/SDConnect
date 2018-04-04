<?php

namespace App\Http\Controllers\Modules\API;

use App\Http\Controllers\Controller;
use App\Modules\System\User\Student;
use App\Modules\System\User\Teacher;
use App\Modules\System\User\UserAccount;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    public function currentUser()
    {
        return Auth::user();
    }

    public function listStudentsJson()
    {
        return Student::with('user_account')->with('user_account.groups')->get();
    }

    public function listTeachersJson()
    {
        return Teacher::with('user_account')->with('user_account.groups')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return Response
     */
    public function profile($username)
    {
        return UserAccount::with('groups')
                ->with('teacher')
                ->with('student')
                ->with('badges')
                ->findOrFail($username);
    }

}
