<?php

namespace App\Http\Requests\System;

use App\Http\Requests\RequestToModelTransformingRequest;
use App\Modules\System\Group\Group;
use App\Modules\System\Post\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use function value_at_key;

class GroupPostRequest extends FormRequest implements RequestToModelTransformingRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ( $this->method() === 'POST' || $this->method() === ' PUT' ) {
            $this->getFormRules();
        }

        return $rules;
    }

    protected function getFormRules()
    {
        $rules = [
            'group'             => 'required',
            'module'            => 'required',
            'includeInCalendar' => 'required',
            'content'           => 'required|max:300',
        ];

        return $rules;
    }

    public function getRequestModel(): Model
    {
        $input = $this->modifyInput($this->all());

        $post = new Post($input);
        $post->setGroup($input["group"]);

        return $post;
    }

    public function modifyInput($input): array
    {
        $input["relative_url"]        = array_key_exists('relativeUrl', $input) ? $input['relativeUrl'] : null;
        $input["related_data_id"]     = array_key_exists('relatedDataId', $input) ? $input['relatedDataId'] : null;
        $input["include_in_calendar"] = $input['includeInCalendar'];
        $input["date_time_from"]      = value_at_key($input, 'dateTimeFrom', Carbon::now()->format("Y-m-d H:i:s"));
        $input["date_time_to"]        = value_at_key($input, 'dateTimeTo', Carbon::now()->format("Y-m-d H:i:s"));
        $input["group"]               = new Group($input["group"]);

        return $input;
    }

}
