<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Modules\System\Badge\Badge;
use App\Modules\System\User\Student;
use App\Modules\System\User\Teacher;
use App\Modules\System\User\UserAccount;
use Illuminate\Http\Request;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
