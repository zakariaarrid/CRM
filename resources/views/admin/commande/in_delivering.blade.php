@include('templates.header')
<script src="https://unpkg.com/vue@2.5.16/dist/vue.js"></script>
<!--<script src="{{ asset('assets/js/get_content.js' )}}"></script>-->
<?php 
  use App\User;
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
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Order in delivering</h3>
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
                                            <th>Produit</th>
                                            <th>Note</th>
                                            <th></th>
                                            <th>Confirmer Par</th>
                                            <th>in delivering </th>                                      
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyid">
                                        @if($commandes)
                                            @foreach($commandes as $commande)                                                
                                                    <tr>
                                                        <td>{{$commande->created_at->diffForHumans()}}</td>
                                                        <td>AM-@if($commandes){{$commande->id}} @endif</td>
                                                        <td>{{$commande->nom_prenom}}</td>
                                                        <td>{{$commande->phone}}</td>
                                                        <td>{{$commande->ville["name"]}}</td>
                                                        <td>{{$commande->adress}}</td>
                                                        <td>{{$commande->prix}}</td>                                                       
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
                                                        <td style="text-align:center">
                                                        <?php
                                                           if(User::find($commande->livreur_id))
                                                            echo User::findOrFail($commande->livreur_id)->name;
                                                           else
                                                            echo "-";
                                                           
                                                        
                                                        ?>
                                                        </td>
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
        <!--<script src="{{ asset('assets/js/get_content.js' )}}"></script>-->

        @include('templates.script')
    </div>
</div>
</body>
     <script>
       /*   $(document).ready(function() {
            setInterval(function () {
                let data_commande="";
                $("#tbodyid").empty();
                axios.post('../get_content_confirmer.php').then(
                    function(response){
                        for (let row of response.data) {
                            data_commande+=`<tr>`;
                            data_commande+=`
                        <td>${row.created_at}</td>
                        <td>AM-${row.id}</td>
                        <td>${row.nom_prenom}</td>
                        <td>${row.phone}</td>
                        <td>${row.name}</td>
                        <td>${row.adress}</td>
                        <td>${row.prix}</td>                   
                        <td>${row.day1}</td>
                        <td>${row.day2}</td>
                        <td>${row.day3}</td>
                        <td>${row.produit}</td>
                        <td>${row.note}</td>
                        <td><a href="../admin/commande/${row.id}/edit"><button type="button" class="btn btn-success btn-xs">Edit</button></a></td>
                        <td>${row.validated_by}</td>`;
                            data_commande+=`</tr>`;
                        }
                    // $("#datatable-keytable > tbody").append(data_commande);
                        $(".c22 > tbody").append(data_commande);
                    }
                );
                data_commande='';
            }, 60000)

        })*/
     
     </script>
</html>
