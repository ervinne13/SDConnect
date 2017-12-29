@extends('layouts.skarla')

@section('js')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default b-a-0 shadow-box">
                <div class="panel-heading">
                    Accessible Materials

                    <a class="btn btn-success btn-sm text-center b-t-1 pull-right" href="{{route('material.create')}}">
                        <i class="fa fa-plus"></i> Create New Material
                    </a>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>       
    </div>

</div>
@endsection
