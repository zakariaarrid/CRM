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
                    <div class="x_panel" style="overflow-x: auto !important;">
                     <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #bae3a4;">
                                <div class="icon icon_custom" style="color: white;"><i class="fa fa-check-square-o"></i></div>
                                <div class="count" style="color: white;"><span style="font-size: 11pt;">{{$count}}</span></div>
                                <h3 style="color: white;font-size: 11pt;">Orders delivered today</h3>                  
                            </div>
                    </div>  
                     <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats" style="background-color: #bae3a4;">
                                <div class="icon icon_custom" style="color: white;"><i class="fa fa-check-square-o"></i></div>
                                <div class="count" style="color: white;"><span style="font-size: 11pt;">{{$count_m}}</span></div>
                                <h3 style="color: white;font-size: 11pt;">Orders delivered this month</h3>                  
                            </div>
                    </div>  

            <div class="col-md-12 col-sm-12 col-xs-12">
              @if(\Illuminate\Support\Facades\Session::has('order_edit'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_edit')}}</strong>
                  </div>
              @elseif(\Illuminate\Support\Facades\Session::has('order_cancel'))  
                  <div class="alert alert-warning alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_cancel')}}</strong>
                  </div>
              @elseif(\Illuminate\Support\Facades\Session::has('order_added'))  
                  <div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_added')}}</strong>
                  </div> 
              @elseif(\Illuminate\Support\Facades\Session::has('order_confirmed_sec'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('order_confirmed_sec')}}</strong>
                  </div> 
              @elseif(\Illuminate\Support\Facades\Session::has('commande_delete'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 2%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('commande_delete')}}</strong>
                  </div>             
              @endif
                    <div class="x_content">
                        
                        <div class="row">
                            <div class="col-sm-12">
                               <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered c11">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th style="width: 43px;">Ref#</th>
                                            <th>Nom</th>
                                            <th>Phone</th>
                                            <th>Ville</th>
                                            <th>Adress</th>
                                            <th>Prix</th>
                                            <th>D1</th>
                                            <th>D2</th>
                                            <th>D3</th>
                                            <th>Produit</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @if($commandes)
                                            @foreach($commandes as $commande)
                                                @if($commande->status !=6)
                                                   @if($commande->status==2 || $commande->status==7)  
                                                      <tr style='background-color:#fb6161 !important;'> 
                                                   @else
                                                      <tr>   
                                                   @endif
                                                        <td>{{date("d/m/Y", strtotime($commande->created_at))}}</td>
                                                        <td>AM-{{$commande->id}}</td>
                                                        <td>{{$commande->nom_prenom}}</td>
                                                        <td>{{$commande->phone}}</td>
                                                        <td>
                                                        @if($commande->ville_id)
                                                            {{$commande->ville["name"]}}
                                                        @else
                                                            {{$commande->ville_name}}
                                                        @endif
                                                        </td>
                                                        <td>{{$commande->adress}}</td>
                                                        <td>{{$commande->prix}}</td>
                                                        <td>
                                                        {!! Form::open(['method' => 'POST','action' => 'secController@edit_statut' , 'id' => 'id1'.$commande->id]) !!}
                                                        <!--*******-->
                                                            <div id="id1">
                                                                <?php $statut_selected="" ?>
                                                                @if($commande->day1!=0)
                                                                    <?php
                                                                    $statut_selected=$statut[$commande->day1];
                                                                    ?>
                                                                @endif
                                                                <input type="hidden" name="day11" value="{{$commande->id}}">
                                                                <select name="day1" onchange="onChange1('id1{{$commande->id}}')" class="c1">
                                                                    <option value="{{$commande->day1}}">{{$statut_selected}}</option>
                                                                    @foreach($statut as $stat)
                                                                        <option value="{{array_search($stat,$statut)}}">{{$stat}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <!--*******-->
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['method' => 'POST','action' => 'secController@edit_statut' , 'id' => 'id2'.$commande->id]) !!}
                                                        <!--*******-->
                                                            <div id="id2">
                                                                <?php $statut_selected="" ?>
                                                                @if($commande->day2!=0)
                                                                    <?php
                                                                    $statut_selected=$statut[$commande->day2];
                                                                    ?>
                                                                @endif
                                                                <input type="hidden" name="day22" value="{{$commande->id}}">
                                                                <select name="day2" onchange="onChange2('id2{{$commande->id}}')" class="c1">
                                                                    <option value="{{$commande->day2}}">{{$statut_selected}}</option>
                                                                    @foreach($statut as $stat)
                                                                        <option value="{{array_search($stat,$statut)}}">{{$stat}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <!--*******-->
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['method' => 'POST','action' => 'secController@edit_statut' , 'id' => 'id3'.$commande->id]) !!}
                                                        <!--*******-->
                                                            <div id="id3">
                                                                <?php $statut_selected="" ?>
                                                                @if($commande->day3!=0)
                                                                    <?php
                                                                    $statut_selected=$statut[$commande->day3];
                                                                    ?>
                                                                @endif
                                                                <input type="hidden" name="day33" value="{{$commande->id}}">
                                                                <select name="day3" onchange="onChange3('id3{{$commande->id}}')" class="c1">
                                                                    <option value="{{$commande->day3}}">{{$statut_selected}}</option>
                                                                    @foreach($statut as $stat)
                                                                        <option value="{{array_search($stat,$statut)}}">{{$stat}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <!--*******-->
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                        <td>{{$commande->produit}}</td>
                                                        <td>{{$commande->note}}</td>
                                                        <td>                                                          
                                                          <a href="{{route('sec.edit',$commande->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>  
                                                          {!! Form::open(['method' => 'DELETE','action' => ['secController@destroy',$commande->id]]) !!}
                                                                <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash-o"></i> Delete
                                                                </button>                                                  
                                                          {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        @endif

                                        </tbody>
                                    </table>
                                </div>
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
