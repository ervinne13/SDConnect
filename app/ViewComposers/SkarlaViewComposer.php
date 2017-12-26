<?php

namespace App\ViewComposers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

/**
 * Description of SkarlaViewComposer
 *
 * @author ervinne
 */
class SkarlaViewComposer
{

    public function compose(View $view)
    {
        $view->with("pageLayout", "sidebar-disabled navbar-fixed");
        $view->with("viewOptions", [
            "subTitleBar" => false,
            "footer"      => true
        ]);

        $fullActionName      = Route::getCurrentRoute()->getActionName();
        $splitFullActionName = explode("@", $fullActionName);

        if ( count($splitFullActionName) >= 2 ) {
            $actionName = explode("@", $fullActionName)[1];
            $view->with("routeAction", $actionName);
        }
    }

}
