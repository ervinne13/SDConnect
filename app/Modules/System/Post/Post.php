<?php

namespace App\Modules\System\Post;

use App\Modules\System\Group\Group;
use App\Modules\System\Task\Task;
use App\Modules\System\User\UserAccount;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table    = "post";
    protected $fillable = [
        "group_code",
        "author_username",
        "include_in_calendar",
        "module",
        "calendar_color",
        "relative_url",
        "related_data_id",
        "date_time_from",
        "date_time_to",
        "content"
    ];
    protected $casts    = [
        'include_in_calendar' => 'boolean'
    ];

    // <editor-fold defaultstate="collapsed" desc="Relationships">

    public function group()
    {
        return $this->belongsTo(Group::class, "group_code");
    }

    public function author()
    {
        return $this->belongsTo(UserAccount::class, "author_username");
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'related_data_id');
    }

    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Scopes">

    public function scopeAccessibleByUsername($query, $username)
    {
        return $query->select("post.*")
                ->join("group_member", "group_member.group_code", "=", "post.group_code")
                ->where("user_account_username", $username);
    }

    // </editor-fold>

    /**/
    // <editor-fold defaultstate="collapsed" desc="Encapsulation">

    public function setGroup(Group $group)
    {
        $this->group_code     = $group->getCode();
        $this->calendar_color = $group->getColor();
        return $this;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setAuthor(UserAccount $userAccount)
    {
        $this->author_username = $userAccount->getUsername();
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function includeInCalendar($include = true)
    {
        $this->include_in_calendar = $include ? 1 : 0;
        return $this;
    }

    public function isIncludedInCalendar()
    {
        return $this->include_in_calendar ? true : false;
    }

    public function setModule(string $module)
    {
        $this->module = $module;
        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setRelativeUrl($url)
    {
        $this->relative_url = $url;
        return $this;
    }

    public function getRelativeUrl()
    {
        return $this->relative_url;
    }

    public function setDateTimeFrom(DateTime $dateTimeFrom)
    {
        $this->date_time_from = $dateTimeFrom->format("Y-m-d H:i:s");
        return $this;
    }

    public function getDateTimeFrom()
    {
        return new DateTime($this->date_time_from);
    }

    public function setDateTimeTo(DateTime $dateTimeTo)
    {
        $this->date_time_to = $dateTimeTo->format("Y-m-d H:i:s");
        return $this;
    }

    public function getDateTimeTo()
    {
        return new DateTime($this->date_time_to);
    }

    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    // </editor-fold>
}
