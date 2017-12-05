<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CustomDirectivesProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('jslet', function($expression) {              
            return "<script type=\"text/javascript\">
                <?php
                
                foreach($expression as $key => $value {
                    echo 'let $key = ' . $value;
                }                
                ?>                
            </script>";
        });
        
        Blade::directive('test', function($expression) {
            return '<script type="text/javascript">                
                alert("bisaya");
            </script>';
        });
    }

}
