<?php

namespace App\Modules\System\User;

use App\Modules\System\Group\Group;
use App\Modules\System\Role\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserAccount extends Authenticatable implements JWTSubject
{

    use Notifiable;

    public $incrementing  = false;
    public $timestamps    = false;
    protected $table      = "user_account";
    protected $primaryKey = "username";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'display_name', 'password', 'image_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "user_account_role", "user_account_username", "role_code");
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_account_username');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, "group_member", "user_account_username", "group_code");
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_account_username');
    }

    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    // <editor-fold defaultstate="collapsed" desc="Functions">

    public function getSerializedRoleNames()
    {
        $roles     = $this->roles;
        $roleNames = array_column($roles->toArray(), "name");

        return implode(", ", $roleNames);
    }

    public function isAdmin()
    {
        return $this->hasRole("ADMIN");
    }

    public function hasRole($roleCode)
    {
        $roleCodes = array_column($this->roles->toArray(), "code");
        return in_array($roleCode, $roleCodes);
    }

    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Encapsulation">

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $displayName)
    {
        $this->display_name = $displayName;
        return $this;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->image_url = $imageUrl;
        return $this;
    }

    // </editor-fold>

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
