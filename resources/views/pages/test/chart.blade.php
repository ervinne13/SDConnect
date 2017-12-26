@extends('layouts.skarla')

@section('js')
<!--https://github.com/dabeng/OrgChart.js-->
<script src="{{url("vendor/es6-orgchart/orgchart.js")}}"></script>
<script src="{{url("vendor/es6-orgchart/medprojects-orgchart.js")}}"></script>

<script type="text/javascript">

(function () {
    $(document).ready(function () {
        initializeChart();
    });

    function initializeChart() {

        let datascource = {
            name: '',
            departmentName: 'Board of Directors',
            children: [
                {
                    name: 'Dept.',
                    departmentName: 'Executive Comittee',
                    children: [
                        {name: 'Lizeth Batarao', departmentName: 'President',
                            children: [
                                {
                                    name: 'Dept.',
                                    departmentName: 'Finance Services',
                                    children: [
                                        {
                                            name: 'Gretchen Garcia',
                                            departmentName: 'Chief Finance Officer',
                                        }
                                    ]
                                },
                                {
                                    name: 'Dept.',
                                    departmentName: 'Administrative Services',
                                    children: [
                                        {
                                            name: 'Elizabeth Naluz',
                                            departmentName: 'Chief Admin Officer',
                                        }
                                    ]
                                },
                                {
                                    name: 'Dept.',
                                    departmentName: 'Sales & Marketing',
                                    children: [
                                        {
                                            name: 'Doris Tumulak',
                                            departmentName: 'Vice President',
                                        }
                                    ]
                                },
                                {name: 'Dept.', departmentName: 'Operations Services',
                                    children: [
                                        {name: 'Gabrielle Flores', departmentName: 'Chief Operating Officer'},
                                        {name: 'Anna Salino', departmentName: 'Nursing Services'},
                                        {name: 'Ehmar Villalon', departmentName: 'Auxillary Management'},
                                    ]
                                },
                                {
                                    name: 'Dept.',
                                    departmentName: 'Information Technology',
                                    children: [
                                        {
                                            name: 'Charmaine Sorilla',
                                            departmentName: 'Chief Information Officer',
                                        }
                                    ]
                                },
                                {
                                    name: 'Dept.',
                                    departmentName: 'Medical Services',
                                    children: [
                                        {
                                            name: 'Gretchen Garcia',
                                            departmentName: 'Medical Director',
                                        }
                                    ]
                                },
                            ]
                        },
                    ]
                }
            ]
        };

//        let datascource = {
//            name: 'Doris Tumulak',
//            departmentName: 'general manager',
//            children: [
//                {name: 'Ehmar Villalon', departmentName: 'department manager'},
//                {name: 'Lizeth Batarao', departmentName: 'department manager',
//                    children: [
//                        {name: 'Gretchen Garcia', departmentName: 'senior engineer'},
//                        {name: 'Gabrielle Flores', departmentName: 'senior engineer',
//                            children: [
//                                {name: 'Elizabeth Naluz', departmentName: 'engineer'},
//                                {name: 'Anna Salino', departmentName: 'UE engineer'}
//                            ]
//                        }
//                    ]
//                },
//                {name: 'Charmaine Sorilla', departmentName: 'department manager'},
//            ]
//        };

        new MedProjectsOrgChart({
            chartContainer: '#chart-container',
            data: datascource,
            depth: 6,
            verticalDepth: 5,
            nodeContent: 'departmentName'
        });
    }

})();

</script>
@endsection

@section('vendor-css')
<link rel="stylesheet" href="{{url("vendor/es6-orgchart/orgchart.css")}}">
@endsection

@section('css')

<style>

    #wrapper {
        width: 860px;
        margin: 0 auto;
        font-family: "Arial";
    }

    #wrapper li {
        margin-top: 20px;
    }

    #wrapper a {
        font-size: 24px;
    }

    #wrapper span {
        font-size: 24px;
    }

    #chart-container {
        position: relative;
        display: inline-block;
        top: 10px;
        left: 10px;
        height: 480px;
        width: calc(100% - 24px);
        border: 2px dashed #aaa;
        border-radius: 5px;
        overflow: auto;
        text-align: center;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }

    .orgchart .node .org-chart-node-title {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        height: 20px;
        line-height: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        background-color: rgba(217, 83, 79, 0.8);
        color: #fff;
        border-radius: 4px 4px 0 0; 
    }

    .orgchart.b2t .node .org-chart-node-title {
        -ms-transform: rotate(-180deg);
        -moz-transform: rotate(-180deg);
        -webkit-transform: rotate(-180deg);
        transform: rotate(-180deg);
        -ms-transform-origin: center bottom;
        -moz-transform-origin: center bottom;
        -webkit-transform-origin: center bottom;
        transform-origin: center bottom;
    }

    .orgchart.l2r .node .org-chart-node-title {
        -ms-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -moz-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -webkit-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -ms-transform-origin: bottom center;
        -moz-transform-origin: bottom center;
        -webkit-transform-origin: bottom center;
        transform-origin: bottom center;
        width: 120px;
    }

    .orgchart.r2l .node .org-chart-node-title {
        -ms-transform: rotate(-90deg) translate(-40px, -40px);
        -moz-transform: rotate(-90deg) translate(-40px, -40px);
        -webkit-transform: rotate(-90deg) translate(-40px, -40px);
        transform: rotate(-90deg) translate(-40px, -40px);
        -ms-transform-origin: bottom center;
        -moz-transform-origin: bottom center;
        -webkit-transform-origin: bottom center;
        transform-origin: bottom center;
        width: 120px;
    }

    .orgchart .node .org-chart-node-title .symbol {
        float: left;
        margin-top: 4px;
        margin-left: 2px;
    }

    .orgchart .org-chart-node-content {
        width: 100%;
        height: 20px;
        font-size: 11px;
        line-height: 18px;
        border: 1px solid rgba(217, 83, 79, 0.8);
        border-radius: 0 0 4px 4px;
        text-align: center;
        background-color: #fff !important;
        color: #333;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .orgchart.b2t .orgchart-node-content {
        -ms-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        -ms-transform-origin: center top;
        -moz-transform-origin: center top;
        -webkit-transform-origin: center top;
        transform-origin: center top;
    }

    .orgchart.l2r .orgchart-node-content {
        -ms-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -moz-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -webkit-transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        transform: rotate(-90deg) translate(-40px, -40px) rotateY(180deg);
        -ms-transform-origin: top center;
        -moz-transform-origin: top center;
        -webkit-transform-origin: top center;
        transform-origin: top center;
        width: 120px;
    }

    .orgchart.r2l .orgchart-node-content {
        -ms-transform: rotate(-90deg) translate(-40px, -40px);
        -moz-transform: rotate(-90deg) translate(-40px, -40px);
        -webkit-transform: rotate(-90deg) translate(-40px, -40px);
        transform: rotate(-90deg) translate(-40px, -40px);
        -ms-transform-origin: top center;
        -moz-transform-origin: top center;
        -webkit-transform-origin: top center;
        transform-origin: top center;
        width: 120px;
    }

</style>

@endsection

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-12">
            <div id="chart-container" class="chart-container"></div>
        </div>
    </div>
</div>
@endsection
