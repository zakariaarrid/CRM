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
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Confirmed order</h3>
                    </div>
                </div>
                <div class="clearfix"></div>               
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" style="overflow-x: auto !important;">
                            <div class="x_content">
                               <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered c22">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>command number</th>
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
                                            <th>Confirmer Par</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyid">
                                        @if($commandes)
                                            @foreach($commandes as $commande)
                                                @if($commande->status ==6)
                                                    <tr>
                                                        <td>{{$commande->created_at->diffForHumans()}}</td>
                                                        <td>AM-@if($commandes){{$commande->id}} @endif</td>
                                                        <td>{{$commande->nom_prenom}}</td>
                                                        <td>{{$commande->phone}}</td>
                                                        <td>{{$commande->ville["name"]}}</td>
                                                        <td>{{$commande->adress}}</td>
                                                        <td>{{$commande->prix}}</td>
                                                        <td style="text-align: center;">
                                                          @if($commande->day1!=0)
                                                            {{$statut[$commande->day1]}}
                                                           @else
                                                            {{"-"}}  
                                                          @endif  
                                                        </td>
                                                        <td style="text-align: center;">
                                                          @if($commande->day2!=0)
                                                            {{$statut[$commande->day2]}}
                                                          @else
                                                            {{"-"}}
                                                          @endif  
                                                        </td>
                                                        <td style="text-align: center;">
                                                          @if($commande->day3!=0)
                                                            {{$statut[$commande->day3]}}  
                                                          @else
                                                            {{"-"}}    
                                                          @endif                                                            

                                                        </td>
                                                        <td>{{$commande->produit}}</td>
                                                        <td>{{$commande->note}}</td>
                                                        <td>
                                                          <a href="{{route('commande.edit',$commande->id)}}"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
                                                          {!! Form::open(['method' => 'DELETE','action' => ['CommandeController@destroy',$commande->id]]) !!}
                                                                <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash-o"></i> Delete
                                                                </button>                                                  
                                                           {!! Form::close() !!}
                                                        </td>
                                                        <td>{{$commande->validated_by}}</td>

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
        </div>
        <!-- /page content -->
        

        @include('templates.script')

    </div>
</div>

</body>
<script src="{{ asset('assets/js/get_content.js' )}}"></script>

</html>
