@include('templates.header')
<script src="https://unpkg.com/vue@2.5.16/dist/vue.js"></script>

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
               @if(Session::has('message'))
                  <div class="alert alert-info alert-danger fade in" role="alert" style="margin-top:70px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{Session::get('message')}}</strong>
                  </div>  
                @endif  
                <form method="POST" action="{{route('statistic.search_command')}}">    
                  @csrf       
                      <div class="col-lg-4 col-sm-12">
                            <span style="font-weight:bold;font-style:italic;vertical-align: text-top;">From</span>
                            <div class="control-group">                                                        
                                    <div class="controls">                             
                                        <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                        <?php
                                           $date1='';
                                           
                                           if(isset($time_1_1) || isset($time_2_1)){                                           
                                              $date1="value='".$time_1_1."'";
                                              $date2="value='".$time_2_1."'";
                                           }
                                           else{
                                              $date1="";
                                              $date2="";
                                           }
                                        ?>
                                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="date" aria-describedby="inputSuccess2Status2" name="date_1" style="padding-left: 62px;" {{$date1}}>
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                            </div>
                        </div> 
                        <div class="col-lg-4 col-sm-12">
                            <span style="font-weight:bold;font-style:italic;vertical-align: text-top;">To</span>
                            <div class="control-group">                                                        
                                    <div class="controls">                             
                                        <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="date" aria-describedby="inputSuccess2Status2" name="date_2" style="padding-left: 62px;" {{$date2}}>
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <span style="font-weight:bold;font-style:italic;vertical-align: text-top;visibility:hidden;">.</span>
                            <div class="control-group">                                                        
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>                
                        </div>
                    </div>
                </form>
                <div class="x_panel">
                    <div class="x_content" style="overflow-x: auto !important;">
                        <div class="row">
                            <div class="col-sm-12">
                              <!--<div class="card-box table-responsive search-table-outter">-->
                              <table class="table table-bordered jambo_table bulk_action">
                                        <thead>
                                          <tr>
                                              <th>Number of orders</th>
                                              <th>Confirmed order</th>
                                              <th>Shipping on progress</th>
                                              <th>Orders delivered</th>
                                              <th>Orders Canceled</th>
                                              <th>Total sales</th>
                                              <th>AOV sale</th>
                                              <th>P.U</th>
                                              <th>T.achat.p</th>
                                              <th>SH/U</th>
                                              <th>T.Shipping</th>
                                              <th>Sh cost</th>
                                              <th>CPConf</th>
                                              <th>CPC salary</th>
                                              <th>CPDcall</th>
                                              <th>CPconf</th>
                                              <th>C per Deliv</th>
                                              <th>E P D</th>
                                              <th>Total profit</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @if($number_order !=0)
                                            <td>{{$number_order}}</td>
                                            <td>{{$confirmed_order}} <span style="font-size: 9pt;">@if($confirmed_order!=0)({{round($confirmed_order*100/$number_order)}} %)@else  (0%)@endif</span></td>
                                            <td>{{$on_progress}} <span style="font-size: 9pt;">@if($confirmed_order!=0)({{round($delivred*100/$confirmed_order)}} %)@else  (0%)@endif</td>
                                            <td><span id="deli">{{$delivred}}</span> <span style="font-size: 9pt;" id="delivred_per">@if($confirmed_order!=0)({{round($delivred*100/$confirmed_order)}} %)@else (0%)@endif</span></td>
                                            <!--<td>{{$canceled}} <span style="font-size: 9pt;">@if($confirmed_order!=0)({{round($canceled*100/$confirmed_order)}} %)@else  (0%)@endif</span></td>-->
                                            <td>{{$canceled}}</td>
                                            <td>{{$total}} MAD</td>
                                            <td><span id="aov">@if($delivred!=0){{round($total/$delivred, 2)}} @else 0 @endif</span> </td>
                                            <td id="PU" contenteditable="true" oninput="functionPU(event)" style="background-color: #efeaea;"></td> 
                                            <td id="Tachatp"></td> 
                                            <td id="SHU" contenteditable="true" oninput="functionshu(event)" style="background-color: #efeaea;"></td> 
                                            <td id="TShipping"></td>
                                            <td id="Shcost"></td>
                                            <td id="CPConf" contenteditable="true" oninput="functionCPConf(event)" style="background-color: #efeaea;"></td>
                                            <td id="CPC_salary" contenteditable="true" oninput="functionCPC_salary(event)" style="background-color: #efeaea;"></td>
                                            <td id="CPDcall" contenteditable="true" oninput="functionCPDcall(event)" style="background-color: #efeaea;"></td>
                                            <td id="CPconf1"></td>
                                            <td id="C_per_Deliv"></td>
                                            <td id="E_P_D"></td>
                                            <td id="Totalprofit"></td>
                                        
                                        @endif    
                                        </tbody>

                                    </table>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <br />
        </div>
        <!-- /page content -->

        @include('templates.footer')
    </div>
</div>
@include('templates.script')
<script>
function functionPU(event) {
    let val = $(event.target).text();   
    let deli = $('#deli').text();    
    $('#Tachatp').html(val*deli);
 
}
function functionshu(event) {
    let val = $(event.target).text();   
    let deli = $('#deli').text();    
    $('#TShipping').html(val*deli);
    let tshipping = val*deli;
    let s = (val*deli)/deli;  
    $('#Shcost').html(s);  
   
   
 
}
function functionCPConf(event) {
    let val = $(event.target).text(); 
    let val2 = $('#CPC_salary').text();
    let val3 = $('#CPDcall').text();
    let val4 = $('#Shcost').text();
    let val5 = $('#deli').text();
    let val6 = $('#Tachatp').text();
    
    
    $('#CPconf1').html(Math.round(parseFloat(val)+parseFloat(val2)+parseFloat(val3)+(parseFloat(val4)/parseFloat(val5))+(parseFloat(val6)/parseFloat(val5))));
    
 
}
function functionCPC_salary(event) {
    let val = $(event.target).text();  
    let val2 = $('#CPConf').text();
    let val3 = $('#CPDcall').text();
    let val4 = $('#Shcost').text();
    let val5 = $('#deli').text();
    let val6 = $('#Tachatp').text();
    
    
    $('#CPconf1').html(Math.round(parseFloat(val)+parseFloat(val2)+parseFloat(val3)+(parseFloat(val4)/parseFloat(val5))+(parseFloat(val6)/parseFloat(val5))));

}
function functionCPDcall(event) {
    let val = $(event.target).text(); 
    let val2 = $('#CPC_salary').text();
    let val3 = $('#CPConf').text();
    let val4 = $('#Shcost').text();
    let val5 = $('#deli').text();
    let val6 = $('#Tachatp').text();    
    let val7 = $('#delivred_per').text();  
    let val8 = $('#TShipping').text();  

    let thenum = val7.replace(/\D/g, ""); 
    thenum =  parseInt(thenum)/100; 

    
    
    $('#CPconf1').html(Math.round(parseFloat(val)+parseFloat(val2)+parseFloat(val3)+(parseFloat(val4)/parseFloat(val5))+(parseFloat(val6)/parseFloat(val5))));

    $('#C_per_Deliv').html(Math.round((parseInt(val3)/thenum)+parseFloat(val)+parseFloat(val2)+(parseFloat(val8)/parseInt(val5))+((parseFloat(val6)/parseInt(val5)))));
    
    let val10 = $('#C_per_Deliv').text();
    
    let val9 = $('#aov').text();

    $('#E_P_D').html(Math.round(parseFloat(val9)-parseInt(val10)));

    let val11 = $('#E_P_D').text();


    $('#Totalprofit').html(Math.round(parseFloat(val11)*parseInt(val5)));

   
   
 
}








</script>
</body>
</html>
