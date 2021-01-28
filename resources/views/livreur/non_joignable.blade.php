@include('templates.header')
<script src="https://unpkg.com/vue@2.5.16/dist/vue.js"></script>
<script src="{{ asset('assets/js/get_content.js' )}}"></script>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('templates.sidebar_left')

    <!-- top navigation -->
    @include('templates.top_navigation')
    <!-- /top navigation -->
        <!-- page content -->
<script type="text/javascript">
 $(document).ready(function () {
   var table= $('#myTable').DataTable({
        "order": [[ 1, "desc" ]],
        
       });
 });
      
</script>

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">                    
                </div>
                <div class="clearfix"></div>
               <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
                <script type="text/javascript">   -->              
                </script>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" style="overflow-x: auto !important;">
                            <div class="x_content">
                               <div class="card-box table-responsive">
                                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline c22" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">           
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th style="width: 75px;">Ref#</th>
                                            <th>Nom</th>
                                            <th>Phone</th>                                            
                                            <th>Ville</th>                                           
                                            <th>Adress</th>
                                            <th>Price</th>                                           
                                            <th>Produit</th>                                            
                                            <th>Note</th>
                                            <th>Detail</th>                                                                                      
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyid">
                                        @if($commandes)
                                            @foreach($commandes as $commande)
                                            @if($commande->status==1)  
                                                <tr style='background-color:#bae3bb !important;'> 
                                            @elseif($commande->status==7)
                                                <tr style='background-color:#fb6161 !important;'>  
                                            @else
                                                <tr>
                                             @endif
                                                <td>{{$commande->created_at->diffForHumans()}}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'POST','action' => 'LivController@edit_statut' , 'id' => 'id1'.$commande->id]) !!}
                                                    <!--*******-->
                                                        <div id="id1">    
                                                            <?php $statut_selected="" ?>
                                                            @if($commande->status!=0)
                                                            <?php
                                                                $statut_selected=$statut[$commande->status];
                                                                ?>
                                                            @endif                                                   
                                                            <input type="hidden" name="id_commande" value="{{$commande->id}}">
                                                            <select name="statut" onchange="onChange1('id1{{$commande->id}}')" class="c1">
                                                                <option value="{{$commande->status}}">{{$statut_selected}}</option>                                                            
                                                                @foreach($statut as $stat)
                                                                <option value="{{array_search($stat,$statut)}}">{{$stat}}</option>
                                                                @endforeach
                                                            </select>
                                                    <!--*******-->
                                                    {!! Form::close() !!}
                                                        </div>
                                                </td>
                                                <td>AM-{{$commande->id}}</td>
                                                <td>{{$commande->nom_prenom}}</td>
                                                <td><a href="tel:{{$commande->phone}}">{{$commande->phone}}</a></td>
                                                <td>
                                                  @if($commande->ville_name)
                                                    {{$commande->ville_name}}
                                                  @else
                                                     {{$commande->ville["name"]}}
                                                  @endif

                                                </td>
                                                
                                                <td>{{$commande->adress}}</td>
                                                <td>{{$commande->prix}}</td>  
                                                <td>{{$commande->produit}}</td>                                                
                                                <td>{{$commande->note}}</td> 
                                                <td><a href="{{route('Liv.edit',$commande->id)}}"><button type="button" class="btn btn-success btn-xs">Edit</button></a></td>                             
                                             </tr>
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
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>        
        @include('templates.script')
        <script>
          $(document).ready(function() {             
                $('#myTable').DataTable({
                    "order": [[ 1, "desc" ]]
                });
            
                setInterval(function () {  
                    table = $('#datatable-responsive').DataTable();
                    
                    axios.get('./Liv')
                        .then(function (response) {
                            rowCount = $('.c22 tr').length;
                            if(!table.data().any() && response.data>=1){
                                $('#id_order_nbr_livreur').html(response.data);                                
                            }else if(table.data().any() && rowCount-1>=1 && response.data>=1){
                                $('#id_order_nbr_livreur').html(response.data-(rowCount-1));                             
                            }                                                            
                        })
                        .catch(function (error) {                            
                            console.log(error);
                        })                   
                }, 5000)
            })


            
                   /* if(rowCount-1 < response.data.nbr_row){
                        $('#id_order_nbr').html("+");
                    }
                    else if(response.data.nbr_row==1 && ! table.data().any()){
                        $('#id_order_nbr').html("+");                        
                    }*/
        </script>

    </div>
</div>

</body>
</html>
