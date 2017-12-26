<?php

namespace App\Modules\System\User;

use App\Modules\Base\Traits\HasCompositeKeys;
use App\Modules\System\Group\Group;
use Illuminate\Database\Eloquent\Model;

class UserAccountGroup extends Model
{

    use HasCompositeKeys;

    public $timestamps    = false;
    public $incrementing  = false;
    protected $table      = "group_member";
    protected $primaryKey = ["user_account_username", "group_owner_username", "group_code"];
    protected $fillable   = ["user_account_username", "group_owner_username", "group_code"];

    public function group()
    {
        return $this->belongsTo(Group::class, "group_code", "code");
    }

    public function scopeUserAccountUsername($query, $username)
    {
        return $query->where("user_account_username", $username);
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group)
    {
        $this->group_owner_username = $group->getOwner()->getUsername();
        $this->group_code           = $group->getCode();
        return $this;
    }

    public function getGroupCode()
    {
        return $this->group_code;
    }

    public function getUserAccountUsername()
    {
        return $this->user_account_username;
    }

    public function setGroupCode($group_code)
    {
        $this->group_code = $group_code;
        return $this;
    }

    public function setUserAccountUsername($user_account_username)
    {
        $this->user_account_username = $user_account_username;
        return $this;
    }

}
