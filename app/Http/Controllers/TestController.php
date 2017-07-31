<?php

namespace App\Http\Controllers;

use App\Modules\Base\Mappers\Impl\SnakeToPascalCaseAttributeMapper;

class TestController extends Controller
{

    public function test()
    {

        $attributes = [
            "display_name"   => "Ervinne",
            "email"          => "ervinne@test.com",
            "remember_token" => "456yu2jejdshgdsdf"
        ];

        $mapper = new SnakeToPascalCaseAttributeMapper();

        return $mapper->map($attributes);
    }

    public function chart()
    {
        return view("pages.test.chart");
    }

}
