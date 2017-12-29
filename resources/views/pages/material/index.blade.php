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
                    <div class="col-md-4 col-md-offset-8">
                        <div class="input-group input-group-sm pull-left p-10">
                            <input type="text" class="form-control" placeholder="Filter materials...">
                            <span class="input-group-btn">
                                <button id="action-filter" class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>

</div>
@endsection
