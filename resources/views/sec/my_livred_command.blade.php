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
                <form method="POST" action="{{route('sec.calcule')}}">    
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
                              <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                          <tr>
                                              <th>My commande delivred </th>
                                              
                                          </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                               <td>{{$count}}</td>
                                              
                                             </tr>  
                                             
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

</body>
</html>
