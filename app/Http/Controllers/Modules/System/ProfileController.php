<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Modules\System\Badge\Badge;
use App\Modules\System\User\Student;
use App\Modules\System\User\Teacher;
use App\Modules\System\User\UserAccount;
use Illuminate\Http\Response;
use function view;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::with('user_account')->with('user_account.groups')->get();
        $teachers = Teacher::with('user_account')->with('user_account.groups')->get();

        $badges = Badge::all();

        return view('pages.user.profiles', [
            'students' => $students,
            'teachers' => $teachers,
            'badges'   => $badges,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return Response
     */
    public function show($username)
    {
        return UserAccount::with('groups')
                ->with('teacher')
                ->with('student')
                ->with('badges')
                ->findOrFail($username);
    }

}
