<?php

namespace App\Modules\System\Group;

use App\Modules\Base\Traits\Activatable;
use App\Modules\Base\Traits\HasCompositeKeys;
use App\Modules\System\User\UserAccount;
use App\Modules\System\User\UserAccountGroup;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    use HasCompositeKeys,
        Activatable;

    public $incrementing  = false;
    protected $table      = 'group';
    protected $primaryKey = 'code';
    protected $fillable   = [
        "owner_username", "code", "color", "is_active", "type", "display_name", "description"
    ];

    // <editor-fold defaultstate="collapsed" desc="Scopes">

    public function scopeOwnedByUsername($query, $username)
    {
        return $query->where("owner_username", $username);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Relationships">

    public function owner()
    {
        return $this->belongsTo(UserAccount::class, "owner_username");
    }

    public function members()
    {
        return $this->belongsToMany(UserAccount::class, "group_member", "group_code", "user_account_username");
    }

//    public function members()
//    {
//        return $this->belongsToMany(UserAccountGroup::class, "code", "group_code");
//    }
    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Encapsulation">

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    public function getOwner(): UserAccount
    {
        return $this->owner;
    }

    public function setOwner(UserAccount $userAccount)
    {
        $this->owner_username = $userAccount->getUsername();
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
        return $this;
    }

    public function getDisplayName()
    {
        return $this->display_name;
    }

    public function setDisplayName(string $displayName)
    {
        $this->display_name = $displayName;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function isSystemGenerated()
    {
        return $this->is_system_generated ? true : false;
    }

    public function setSystemGenerated($systemGenerated = true)
    {
        $this->is_system_generated = $systemGenerated;
        return $this;
    }

    // </editor-fold>
}
