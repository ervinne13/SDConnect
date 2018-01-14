<?php

namespace App\Modules\System\User;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    public $incrementing  = false;
    protected $table      = 'teacher';
    protected $primaryKey = 'user_account_username';

    public function user_account()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_username');
    }

}
