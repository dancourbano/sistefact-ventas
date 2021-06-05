@extends('layouts.master')
@section('title')
Reporte de Ganancia

@stop
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Reporte de Ganancia</h3>
    </div>
</div>


<div class="panel-body panel-featured-left panel-featured-info">
    <br>
    <form id="form-filter-profit" action="" method="get" class="form-horizontal">
        <div class="container-fluid">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-2 control-label">Fecha de Emision</label>
                    <div class="col-md-8">
                        <div class="input-daterange input-group" data-plugin-datepicker>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                            <input type="text" class="form-control" name="startEmission" id="startEmission" value="2016-01-01">
                            <span class="input-group-addon">hasta</span>
                            <input type="text" class="form-control" name="endEmission" id="endEmission" value="<?php echo date("Y-m-d");?>">
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <a  class="btn btn-success" onclick="filterProfit()" >Filtrar Ventas</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
</div>
</br>

<div class="row">
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
                            <h4 class="title">Ganancia Total</h4>
                            <div class="info">
                                <strong class="amount"><span>S/.</span><span id="spanTotalProfit">0.00</span></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">Facturas Vendidas</h4>
                            <div class="info">
                                <strong class="amount"><span id="spanTotalInvoices">0</span></strong>
                            </div>
                        </div>
                        <div class="summary-footer">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

<div class="panel-body panel-featured-left panel-featured-success">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                     <h4 class="col-sm-4"><strong>Reporte por:</strong></h4>
                     <div class="col-sm-8">
                         <select class="form-control" data-plugin-multiselect id="barsSelector">
                             <option value="day" selected>Dia</option>
                             <option value="month" >Mes</option>
                             <option value="year" >Año</option>
                         </select>
                     </div>
                </div>

            </div>
            <div class="col-lg-12">

                <!-- Flot: Bars -->
                <div class="chart chart-lg" id="flotBars"></div>


            </div>

        </div>
</div>



@endsection

@section('scripts')
<script>
    var flotBarsDataDefault= [
        ["Ene", 0],
        ["Feb", 0],
        ["Mar", 0],
        ["Abr", 0],
        ["May", 0],
        ["Jun", 0],
        ["Jul", 0],
        ["Ago", 0],
        ["Sep", 0],
        ["Oct", 0],
        ["Nov", 0],
        ["Dic", 0]
    ];
    var flotBarsDataDay=[]
    var flotBarsDataMonth=[]
    var flotBarsDataYear=[]
    var totalProfit=0;
    var totalDebt=0;
    var totalInvoices=0;
    $('.input-daterange input').datepicker({
        orientation: "auto"
    });

    $(document).ready(function(){
        graphicBars(flotBarsDataDefault);
    });

    $('select#barsSelector').on('change',function(){
        var valor = $(this).val();
        if(valor!=null){
            if(valor=='day'){
                graphicBars(flotBarsDataDay);

            }
            if(valor=='month'){
                graphicBars(flotBarsDataMonth);

            }
            if(valor=='year'){
                graphicBars(flotBarsDataYear);

            }
        }
    });

    function graphicBars(flotBarsData){
        var plot = $.plot('#flotBars', [flotBarsData], {
            colors: ['#8CC9E8'],
            series: {
                bars: {
                    show: true,
                    barWidth: 0.8,
                    align: 'center'
                }
            },
            xaxis: {
                mode: 'categories',
                tickLength: 0
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderColor: 'rgba(0,0,0,0.1)',
                borderWidth: 1,
                labelMargin: 15,
                backgroundColor: 'transparent'
            },
            tooltip: true,
            tooltipOpts: {
                content: '%y',
                shifts: {
                    x: -10,
                    y: 20
                },
                defaultTheme: false
            }
        });
    }
    function filterProfit(){
        var url = ("{{ URL::action('ReportProfitController@filterProfit') }}");

        $.ajax({
            url : url,
            type : 'get',
            data: readFormValues(document.forms['form-filter-profit']),
            dataType : 'json',

            success : function(data) {

                console.log(data);

                flotBarsDataDay=[];
                flotBarsDataMonth=[];
                flotBarsDataYear=[];

                totalProfit=data.profit[0].totalSale;
                totalDebt=data.profit[0].totalDebt;
                totalInvoices=data.profit[0].totalInvoices;

                //agregamos los valores a los campos del grafico
                var i=0;

                for(i in data.day){
                    flotBarsDataDay.push([data.day[i].date,data.day[i].totalSale]);
                }

                i=0;
                for(i in data.month){
                    flotBarsDataMonth.push([getMonth(data.month[i].month)+"-"+data.month[i].year,data.month[i].totalSale]);

                }

                i=0;
                for(i in data.year){
                    flotBarsDataYear.push(["20"+data.year[i].year,data.year[i].totalSale]);

                }

                //console.log(flotBarsDataDay);
                //console.log(flotBarsDataMonth);
                //console.log(flotBarsDataYear);

                //graficamos de acuerdo al selector actual
                var valor = $('#barsSelector').val();
                if(valor!=null){
                    if(valor=='day'){
                        graphicBars(flotBarsDataDay);

                    }
                    if(valor=='month'){
                        graphicBars(flotBarsDataMonth);

                    }
                    if(valor=='year'){
                        graphicBars(flotBarsDataYear);

                    }
                }

                $("#spanTotalProfit").text(totalProfit-totalDebt);
                $("#spanTotalInvoices").text(totalInvoices);

            },
            error : function(xhr, status) {
            }
        });

    }

    function getMonth(monthNumber){
        switch(monthNumber){

            case '01': return "enero";
                        break;
            case '02': return "febrero";
                break;
            case '03': return "marzo";
                break;
            case '04': return "abril";
                break;
            case '05': return "mayo";
                break;
            case '06': return "junio";
                break;
            case '07': return "julio";
                break;
            case '08': return "agosto";
                break;
            case '09': return "setiembre";
                break;
            case '10': return "octubre";
                break;
            case '11': return "noviembre";
                break;
            case '12': return "diciembre";
                break;
        }
    }
</script>
@stop