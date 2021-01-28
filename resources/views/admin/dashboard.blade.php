@include('templates.header')
<?php
  use Illuminate\Foundation\Application;
  use Illuminate\Support\Facades\DB;
?>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('templates.sidebar_left')

    <!-- top navigation -->
    @include('templates.top_navigation')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">        
            <div class="col-md-12 col-sm-12 col-xs-12">
              @if(\Illuminate\Support\Facades\Session::has('order_added'))  
                  <div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_added')}}</strong>
                  </div> 
              @elseif(\Illuminate\Support\Facades\Session::has('order_edit'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_edit')}}</strong>
                  </div>
              @elseif(\Illuminate\Support\Facades\Session::has('commande_delete'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('commande_delete')}}</strong>
                  </div>    
              @endif  
              <!---->
              <div class="row top_tiles" id="dashy">     
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats" style="background-color: #79b9e3;">
                    <div class="icon icon_custom" style="color: #f5ebeb;"><i class="fa fa-cubes"></i></div>
                    <div class="count" style="color:white;">@{{number_order}}</div>
                    <h3 style="color: rgb(249, 249, 249);">Number of orders</h3>                 
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                    <div class="icon icon_custom"><i class="fa fa-shopping-cart"></i></div>
                    <div class="count">@{{confirmed_order}} <span style="font-size: 11pt;">(@{{Math.round(confirmed_order*100/number_order)}} %)</span></div>
                    <h3>Confirmed order</h3>                 
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                    <div class="icon icon_custom"><i class="fa fa-truck"></i></div>
                    <div class="count">@{{on_progress}}</div>
                    <h3>Shipping on progress</h3>                  
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats" style="background-color: #bae3a4;">
                    <div class="icon icon_custom" style="color: white;"><i class="fa fa-check-square-o"></i></div>
                    <div class="count" style="color: white;">@{{delivred}} <span style="font-size: 11pt;">(@{{Math.round(delivred*100/confirmed_order)}} %)</span></div>
                    <h3 style="color: white;">Orders delivered </h3>                  
                    </div>
                </div>               
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats" style="background-color: #e39797;">
                    <div class="icon icon_custom" style="color: white;"><i class="fa fa-times"></i></div>
                    <div class="count" style="color: white;">@{{canceled}} <span style="font-size: 11pt;">(@{{Math.round(canceled*100/confirmed_order)}} %)</span></div>
                    <h3 style="color: white;">Orders Canceled</h3>                                     
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                    <div class="icon icon_custom">MAD</div>
                    <div class="count">@{{total}}</div>
                                      
                    </div>
                </div>
              </div>
              <!---->               
            </div>
            <br />

            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320">
                        <div class="x_title">
                            <h2>Orders delivered</h2>                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="id1"></canvas>
                        </div>
                    </div>
                </div>            
                <div class="col-sm-6 col-xs-12">
                    <div class="x_panel tile fixed_height_320">
                        <div class="x_title">
                            <h2>Orders canceled</h2>                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="id2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Orders delivered by city</h2>                    
                    <div class="clearfix"></div>                    
                        <div id="reportrange"  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>                     
                  </div>
                  <div class="x_content c_echart_pie">                  
                    <div id="echart_pie1" style="height:350px;width:550px;"></div>
                    <p id="error" style='text-align:center;font-size: 15pt;display:none;'>Data Not found</p>
                  </div>
                </div>
              </div>               
            </div>
        </div>
        <!-- /page content -->

        @include('templates.footer')
    </div>
</div>
 
 
@include('templates.script')

<script type="text/javascript">	
    var data =[]; 
    var data_delail=[];
    var current_date=new Date();
    var d = new Date(current_date.getFullYear(), current_date.getMonth() + 1, 0);  
    let current_month=current_date.getMonth()+1;    
    current_month=(current_date.getMonth()+1>9 ? current_month: '0'+current_month);
      /*Send data to server by axios pour le premier chargement de la page*/
        axios.post('getdata_per_city',{               
                      Date_1: current_date.getFullYear()+'-'+current_month+'-01',  
                      Date_2: current_date.getFullYear()+'-'+current_month+'-'+d.getDate()
                      
        })             
        .then(function (response) {
          data=[];
          data_delail=[];         
          if(response.data.length==0){                                               
                $("#echart_pie1").css('display','none'); 
                $("#error").css('display','block');                    
          }else {
                $("#echart_pie1").css('display','block'); 
                $("#error").css('display','none'); 
          }
          // handle success
            // console.log(response.data);
            for (const property in response.data) {
              data.push(response.data[property].name); 
              data_delail.push(
                  {
                    value:response.data[property].count,
                    name:response.data[property].name                    
                  }
                  
                  ); 

            } 
            console.log(data_delail);
            exec_pie();  
             
                  
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .then(function () {
          // always executed
        });
    /* DATERANGEPICKER */
    $(document).ready(function() {
       init_daterangepicker();
    });
		function init_daterangepicker() {

        if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
        console.log('init_daterangepicker');

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2019',
          maxDate: '31/31/2023',
          dateLimit: {
          days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
          }
        };

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {            
              axios.post('getdata_per_city',{
                  Date_1: picker.startDate.format('YYYY-MM-DD'),
                  Date_2: picker.endDate.format('YYYY-MM-DD')
                                })             
              .then(function (response) {
                $("#echart_pie1").css('display','block'); 
                $("#error").css('display','none'); 
                data=[];
                data_delail=[];
                // handle success
                 // console.log(response.data);
                  for (const property in response.data) {
                    data.push(response.data[property].name); 
                    data_delail.push(
                       {
                         value:response.data[property].count,
                         name:response.data[property].name                    
                       }
                       
                       ); 
                  } 
                  if(response.data.length==0){                                               
                    $("#echart_pie1").css('display','none'); 
                    $("#error").css('display','block');                    
                  }
                  console.log(data_delail);
                  exec_pie();    
                       
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .then(function () {
                // always executed
              });

          //  alert("apply event fired, start/end dates are " + picker.startDate.format('YYYY-MM-DD') + " to " + picker.endDate.format('YYYY-MM-DD'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });

    }
    exec_pie();    


function exec_pie(){
   if ($('#echart_pie1').length ){  			  
			  var echartPie = echarts.init(document.getElementById('echart_pie1'));
			  echartPie.setOption({
				tooltip: {
				  trigger: 'item',
				  formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
				  x: 'center',
				  y: 'bottom',
          data:[...data]         
				 // data: ['Direct Access', 'E-mawilieting', 'Union Ad', 'Video Ads', 'Search Engine','Direct Access', 'E-mawilieting', 'Union Ad', 'Video Ads', 'Search Engine']
				},
				toolbox: {
				  show: true,
				  feature: {
					magicType: {
					  show: true,
					  type: ['pie', 'funnel'],
					  option: {
						funnel: {
						  x: '25%',
						  width: '50%',
						  funnelAlign: 'left',
						  max: 1548
						}
					  }
					}				
				  }
				},
				calculable: true,
				series: [{
				  name: 'Orders delivered',
				  type: 'pie',
				  radius: '55%',
				  center: ['50%', '48%'],
				  data: [...data_delail]
				}]
			  });

			  var dataStyle = {
				normal: {
				  label: {
					show: false
				  },
				  labelLine: {
					show: false
				  }
				}
			  };

			  var placeHolderStyle = {
				normal: {
				  color: 'rgba(0,0,0,0)',
				  label: {
					show: false
				  },
				  labelLine: {
					show: false
				  }
				},
				emphasis: {
				  color: 'rgba(0,0,0,0)'
				}
			  };

  } 
}
        
  			  
  
 
  if ($('#id1').length ){ 			  
        var ctx = document.getElementById("id1");
        var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January(1)", "February(2)", "March(3)", "April(4)", "May(5)", "June(6)", "July(7)", "August(8)", "September(9)", "October(10)", "November(11)", "December(12)"],
            datasets: [/*{
            label: '# of Votes',
            backgroundColor: "#26B99A",
            data: [51, 30, 40, 28, 92, 50, 45]
            }, */{
            label: '# Order delivered',
            backgroundColor: "#03586A",
            data: [{{$commande_delivred_this_years[0]}}, {{$commande_delivred_this_years[1]}}, {{$commande_delivred_this_years[2]}}, {{$commande_delivred_this_years[3]}}, {{$commande_delivred_this_years[4]}}, {{$commande_delivred_this_years[5]}}, {{$commande_delivred_this_years[6]}}, {{$commande_delivred_this_years[7]}}, {{$commande_delivred_this_years[8]}}, {{$commande_delivred_this_years[9]}}, {{$commande_delivred_this_years[10]}}, {{$commande_delivred_this_years[11]}}]
            }]
        },

        options: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true
                }
            }]
            }
        }
        });
        
    } 
    if ($('#id2').length ){ 			  
        var ctx = document.getElementById("id2");
        var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January(1)", "February(2)", "March(3)", "April(4)", "May(5)", "June(6)", "July(7)", "August(8)", "September(9)", "October(10)", "November(11)", "December(12)"],
            datasets: [/*{
            label: '# of Votes',
            backgroundColor: "#26B99A",
            data: [51, 30, 40, 28, 92, 50, 45]
            }, */{
            label: '# Order canceled',
            backgroundColor: "#03586A",
            data: [{{$commande_canceled_this_years[0]}}, {{$commande_canceled_this_years[1]}}, {{$commande_canceled_this_years[2]}}, {{$commande_canceled_this_years[3]}}, {{$commande_canceled_this_years[4]}}, {{$commande_canceled_this_years[5]}}, {{$commande_canceled_this_years[6]}}, {{$commande_canceled_this_years[7]}}, {{$commande_canceled_this_years[8]}}, {{$commande_canceled_this_years[9]}}, {{$commande_canceled_this_years[10]}}, {{$commande_canceled_this_years[11]}}]
            }]
        },

        options: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true
                }
            }]
            }
        }
        });
        
    } 
  var Vm=new Vue({
      el:'#count',
      data:{
          isActive:false      
      }
  });
  new Vue({
      el:"#dashy",
      data:{       
        confirmed_order:0,
        on_progress:0,
        delivred:0,
        new_order:0,
        canceled:0,
        total:0,
        number_order:0
       
       
      },
      methods:{
          getdata:function(){    
             
          }
      },
      mounted: function () {       
        th=this;
        setInterval(function () {               
                axios.get('/getdata/commande')
                .then(response=> {
                    // handle success                    
                    th.confirmed_order=response.data[0];
                    th.on_progress=response.data[1];
                    th.delivred=response.data[2];
                    th.canceled=response.data[4];
                    th.total=response.data[5];
                    th.number_order=response.data[6];
                })
                .catch(error=> {
                    // handle error
                    console.log(error);
                })
        },5000)
        
      },
      watch:{               
        confirmed_order:function(value){
          Vm.isActive='true';             
        },
        on_progress:function(value){
          Vm.isActive='true';            
        },
        delivred:function(value){
          Vm.isActive='true';            
        }
       },
       computed:{
             
       }
  });
  /*new Vue({
      el:'#idaa',
      methods:{
         click:function(){
           alert("ok")
         }
      }
  })*/
  
</script>

</body>
<!--
<option value="1">الرباط‏</option>
<option value="2">الدار البيضاء</option>
<option value="3">فاس</option>
<option value="4">طنجة‏</option>
<option value="5">مراكش</option>
<option value="6">مكناس</option>
<option value="7">سلا</option>
<option value="9">وجدة</option>
<option value="10">القنيطرة</option>
<option value="11">أكادير‏</option>
<option value="12">تطوان</option>
<option value="13">تمارة</option>
<option value="14">آسفي</option>
<option value="15">المحمدية</option>
<option value="16">خريبكة‏</option>
<option value="17">الجديدة </option>
<option value="18">بني ملال</option>
<option value="19">تازة</option>
<option value="20">الخميسات</option>
<option value="21">تاوريرت</option>

 -->   
</html>
