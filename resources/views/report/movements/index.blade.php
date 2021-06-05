@extends('layouts.master')
@section('title')
Reporte de Movimientos

@stop
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Reporte de Movimientos</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-usd"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Ingresos totales del Mes</h4>
                            <div class="info">
                                <strong class="amount">S/. {{ $reportOfThisMonthComplete[0]['quantity'] }}</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a class="text-muted text-uppercase">
                                ( 
                                    <?php 
                                        $date = new DateTime('now');
                                        $lastDay = $date -> format('t');
                                        echo '1 al '. $lastDay .' de ' . date('M'); 
                                    ?> 
                                )
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-secondary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-secondary">
                            <i class="fa fa-usd"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Egresos totales del Mes</h4>
                            <div class="info">
                                <strong class="amount">S/.  {{ $reportOfThisMonthComplete[1]['quantity'] }}</strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a class="text-muted text-uppercase">
                                ( 
                                    <?php 
                                        $date = new DateTime('now');
                                        $lastDay = $date -> format('t');
                                        echo '1 al '. $lastDay .' de ' . date('M'); 
                                    ?> 
                                )
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

<div class="panel-body panel-featured-left panel-featured-info">
    <form id="form-filter-movement" action="" method="get" class="form-horizontal">

                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Fecha</label>
                            <div class="col-md-10">
                                <div class="input-daterange input-group" data-plugin-datepicker>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control" name="startDate" id="startDate" value='<?php echo date("Y-m-d");?>'>
                                    <span class="input-group-addon">hasta</span>
                                    <input type="text" class="form-control" name="endDate" id="endDate" value="<?php echo date("Y-m-d");?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group ">
                            <label  class="col-sm-2 control-label" > Tipo </label>
                            <div class="col-sm-4">
                                <select id="type" name="type" class="form-control select2">
                                    <option value="">Seleccione</option>
                                    <option value="1">Ingresos</option>
                                    <option value="2">Egresos</option>
                                    <option value="">Egresos e Ingresos</option>
                                </select>
                            </div>
                            <label  class="col-sm-2 control-label" > Agrupar por </label>
                            <div class="col-sm-4">
                                <select id="groupBy" name="groupBy" class="form-control select2">
                                    <option value="">Seleccione</option>
                                    <option value="0">Dia</option>
                                    <option value="1">Mes</option>
                                    <option value="2">Año</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div class="col-sm-4 pull-right">
                                <a  class="btn btn-success pull-right" onClick="filterMovements()" >Filtrar Movimientos</a>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</div>
</br>
<div class="panel-body panel-featured-left panel-featured-success">
    <div class="row">
        <div class="col-md-12">
            <div class="chart chart-md" id="chartMovements"></div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<script>

    /*
        INPUT  : dateRange, type
        OUTPUT : plot with data between the dateRange and for the type indicated
    */ 

    /* To enable date selection on input */

    $('.input-daterange input').datepicker({
        orientation: "auto"
    });

    /* Declaring variables */
    var chartData = [];
    var type;
    var startDate;
    var endDate;
    var maxY;

    function resetChartData(){
        maxY = 0;

        chartData[0] = {
                data: [],
                label : "Ingresos",
                color : "#61DD30"
            };

        chartData[1] = {
                data: [],
                label : "Egresos",
                color : "#F89205"
            };


    }

    function getFirstDateSelected (){
        var date = new Date($('#startDate').val());
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    }

    function getLastDateSelected (){
        var date = new Date($('#startDate').val());
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        return lastDay;
    }

    function presetChartData ( min, max ) {
        // When type = 0,2,' '
        if( $('#type').val() != 2 ){
            for(var i = min ; i <= max ; i++) {
                chartData[0].data[i] = (
                    [i,0]
                    );
            }
        }

        // When type = 1,2,' '
        if( $('#type').val() != 1 ){
            for(var i = min ; i <= max ; i++) {
                chartData[1].data[i] = (
                    [i,0]
                    );
            }
        }
    }

    function formatData(){

        var startDate = new Date($('#startDate').val());
        var endDate = new Date($('#endDate').val());

        switch( $('#groupBy').val() ){
            case '0':   // DAYS

                    var minDate = startDate.getUTCDate();
                    var maxDate = endDate.getUTCDate();

                    presetChartData (minDate, maxDate);

                break;
            case '1':   // MONTHS

                    var minMonth = startDate.getUTCMonth() + 1; // +1 Because getUTCMonth() gives 0 .... 11
                    var maxMonth = endDate.getUTCMonth() + 1;

                    presetChartData (minMonth, maxMonth);

                break;
            case '2':   // YEARS

                    var minYear = startDate.getUTCFullYear();
                    var maxYear = endDate.getUTCFullYear();

                    presetChartData (minYear, maxYear);

                break;
        }
    }

    /* The first time, after the document is ready,
       the data by default will be
       type : both
       dateRange: 01/01/thisYear to Today 
    */
    $(document).ready(function(){
        
        resetChartData();

        plotData();
        
    });

    /* Function for calling the data with the parameters selected 
        and pushing the data inthe chardData array
    */

    function filterMovements() {
        var url = "{{ URL::action('MovementController@callData') }}";

        $.ajax({
            url : url,
            type : 'get',
            data: readFormValues(document.forms['form-filter-movement']),
            dataType : 'json',

            success : function(data) {
                resetChartData();
                formatData();

                for (i in data) {
                    if(parseInt(data[i].type) - 1 < 2){         // No include 'Prestamos' where type received = 3 => 3-1 = 2
                        chartData[parseInt(data[i].type) - 1].data[data[i].date] =
                            [
                                data[i].date ,
                                data[i].quantity
                            ];

                        if(parseInt(data[i].quantity) > maxY){          // CAUTION must be used parseInt !!!
                            maxY = parseInt(data[i].quantity);
                        }
                
                    }
                    
                }

                plotData();
            },
            error : function(xhr, status) {
            }
        });

    }

    /* Function for plotting data */

    function plotData() {
            var plot = $.plot('#chartMovements', chartData, {
                series: {
                    lines: {
                        show: true,
                        lineWidth: 2
                    },
                    points: {
                        show: true
                    },
                    shadowSize: 0
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderColor: 'rgba(0,0,0,0.1)',
                    borderWidth: 1,
                    labelMargin: 15,
                    backgroundColor: 'transparent'
                },
                yaxis: {
                    min: 0,
                    color: 'rgba(0,0,0,0.1)'
                },
                xaxis: {
                    color: 'rgba(0,0,0,0.1)',
                    mode: 'categories'
                },
                tooltip: true,
                tooltipOpts: {
                    content: '%s en la fecha %x : %y',
                    shifts: {
                        x: -60,
                        y: 25
                    },
                    defaultTheme: false
                }
            });
        };

</script>
@stop
