<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected function getDefaultViewData()
    {

        $viewData = [
            "pageLayout"  => "sidebar-full-height",
            "viewOptions" => [
                "subTitleBar" => false,
                "footer"      => true
            ]
        ];

        if ( isset($this->pageTitle) ) {
            $viewData["pageTitle"] = $this->pageTitle;
        }

        return $viewData;
    }

}
