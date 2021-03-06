<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//
/**/
// <editor-fold defaultstate="collapsed" desc="skarla">

function skarla_url($url)
{
    return url("skarla/{$url}");
}

function skarla_js_url($url)
{
    return url("skarla/assets/js/{$url}");
}

function skarla_css_url($url)
{
    return url("skarla/assets/css/{$url}");
}

function skarla_images_url($url)
{
    return url("skarla/assets/images/{$url}");
}

function skarla_vendor_url($url)
{
    return url("skarla/assets/vendor/{$url}");
}

function skarla_bower_url($url)
{
    return url("skarla/assets/bower_components/{$url}");
}

// </editor-fold>

/**/
// <editor-fold defaultstate="collapsed" desc="Vendor">

function vendor_url($url)
{
    return url("vendor/{$url}");
}

function vendor_js_url($url)
{
    return url("vendor/js/{$url}");
}

function vendor_css_url($url)
{
    return url("vendor/css/{$url}");
}

function vendor_fonts_url($url)
{
    return url("vendor/fonts/{$url}");
}

// </editor-fold>

/**/
// <editor-fold defaultstate="collapsed" desc="Data Tables">

function datatables_bs_url($url)
{
    return url("bower_components/datatables.net-bs/{$url}");
}

function datatables_url($url)
{
    return url("bower_components/datatables.net/{$url}");
}

// </editor-fold>

/**/
// <editor-fold defaultstate="collapsed" desc="Utility Functions">

if ( !function_exists('response_ajax_error') ) {

    function response_ajax_error(Exception $e, $responseCode = 500)
    {
        if ( App::environment('local') ) {
            throw $e;
        } else if ( App::environment('production') ) {
            return response($e->getMessage(), $responseCode);
        }
    }

}

if ( !function_exists('value_at_key') ) {

    function value_at_key(array $assocArray, $key, $defaultValue = null)
    {
        return array_key_exists($key, $assocArray) ? $assocArray[$key] : $defaultValue;
    }

}

if ( !function_exists('handle_controller_exception') ) {

    function handle_controller_exception(\Exception $e)
    {
        if ( env('APP_DEBUG', false) ) {
            throw $e;
        } else {
            return response($e->getMessage(), 500);
        }
    }

}

if ( !function_exists('task_type_name') ) {

    function task_type_name($typeCode)
    {
        switch ( $typeCode ) {
            case 'A':
                $taskTypeName = 'Assignment';
                break;
            case 'E':
                $taskTypeName = 'Exam';
                break;
            case 'Q':
                $taskTypeName = 'Quiz';
                break;
        }

        return $taskTypeName;
    }

}

// </editor-fold>
