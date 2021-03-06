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
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $('#datatable-keytable').dataTable({"order":[],"orderClasses":false,"stripeClasses":['even','odd'],"pagingType":"simple"});
                    });
                </script>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                               <div class="card-box table-responsive">
                                    <table id="datatable-keytable" class="table table-striped table-bordered confirmed_order">
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($commandes)
                                            @foreach($commandes as $commande)
                                                @if($commande->status ==6)
                                                    <tr>
                                                        <td>{{$commande->created_at->diffForHumans()}}</td>
                                                        <td>AM-{{$commande->id}}</td>
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
        </div>      

        @include('templates.script')

    </div>
</div>

</body>
</html>
