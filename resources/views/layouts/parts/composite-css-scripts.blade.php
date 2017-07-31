
@if (isset($uses))

@if (in_array("form", $uses))
<!--Switchery-->
<link rel="stylesheet" href="{{url("vendor/bower_components/switchery/dist/switchery.min.css")}}">
@endif

@if (in_array("fullcalendar", $uses))
<link rel="stylesheet" href="{{url("vendor/bower_components/switchery/dist/switchery.min.css")}}">
@endif

@if (in_array("colorpicker", $uses))
<link rel="stylesheet" href="{{url("vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css")}}">
@endif

@endif