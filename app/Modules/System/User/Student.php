<?php

namespace App\Modules\System\User;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public $incrementing  = false;
    public $timestamps    = false;
    protected $table      = 'student';
    protected $primaryKey = 'student_number';

    /**
     * Alias of user_account
     * @return type
     */
    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_username');
    }

    public function user_account()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_username');
    }

}
