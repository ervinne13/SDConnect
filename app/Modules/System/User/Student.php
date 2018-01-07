<?php

namespace App\Modules\System\User;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public $incrementing  = false;
    public $timestamps    = false;
    protected $table      = 'student';
    protected $primaryKey = 'student_number';

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_username');
    }

}
