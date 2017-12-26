<?php

namespace App\Http\Requests\System;

use App\Http\Requests\RequestToModelTransformingRequest;
use App\Modules\System\Group\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest implements RequestToModelTransformingRequest
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
            $this->getFormRules($this->method());
        }

        return $rules;
    }

    protected function getFormRules($method)
    {
        $model = $this->getRequestModel();
        $table = $model->getTable();

        $rules = [
            'type'         => 'required',
            'code'         => 'required|max:30|unique:' . $table,
            'display-name' => 'required|max:100|unique:' . $table,
        ];

        if ( $method === 'PUT' ) {
            $rules['code'] += ',code,' . $model->getCode();
            $rules['name'] += ',name,' . $model->getName();
        }

        return $rules;
    }

    public function getRequestModel(): Model
    {
        return new Group($this->modifyInput($this->all()));
    }

    public function modifyInput($input): array
    {
        $input["display_name"]        = $input['display-name'];
        $input["is_active"]           = true;
        $input["is_system_generated"] = false;   //  every group coming from a request is not system generated

        return $input;
    }

}
