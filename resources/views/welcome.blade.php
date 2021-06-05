@extends('layouts.master')

@section('content')
        <div class="flex-center position-ref full-height">
            <form id="form-filter-profit" action="" method="get" class="form-horizontal">
                <input type="hidden" class="form-control" name="startEmission" id="startEmission" value="2016-01-01">
                <input type="hidden" class="form-control" name="endEmission" id="endEmission" value="<?php echo date("Y-m-d");?>">
                <input type="hidden" id="barsSelector" value="month">
            </form>
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-primary">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Ingresos</h4>
                                        <div class="info">
                                            <strong class="amount">$ {{ $totalRevenue }}</strong>
                                            <span class="text-primary"></span>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase"></a>
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
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Usuarios</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $totalUsers }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase" href="{{URL::action('UsersController@index')}}">ver Todos</a>
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
                                        <h4 class="title">Total Egresos</h4>
                                        <div class="info">
                                            <strong class="amount">$ {{ $totalExpenses }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6">
                    <section class="panel panel-featured-left panel-featured-quartenary">
                        <div class="panel-body">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon bg-quartenary">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Total Clientes</h4>
                                        <div class="info">
                                            <strong class="amount">

                                                    {{$customerTotal}}

                                                </strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-uppercase" href="{{URL::action('CustomerController@index')}}">Ver todos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <h2> Gráfico de Ganancias en Factura por meses</h2>
            <div class="row">

                <div class="col-lg-12">

                    <!-- Flot: Bars -->
                    <div class="chart chart-lg" id="flotBars"></div>


                </div>
            </div>
        </div>

        </div>
@stop
 @section("scripts")
     <script>
         var flotBarsDataDay=[];
         var flotBarsDataMonth=[];
         var flotBarsDataYear=[];
         var totalProfit=0;
         var totalDebt=0;
         var totalInvoices=0;
         $(document).ready(function(){
             var fecha = new Date();
             filterProfit();

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
             var url = "{{ url('/profit/filterProfit')}}";
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

                     $("#spanTotalProfit").text(totalProfit);
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

 @endsection