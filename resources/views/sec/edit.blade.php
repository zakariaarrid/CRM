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
                        <h3>Edit Commande</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">                   
                        <div class="x_panel" >
                            <div class="x_content">
                                {!! Form::model($commande,['method' => 'PATCH','action' => ['secController@update',$commande->id],'class' => 'form-horizontal form-label-left']) !!}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::text('nom_prenom' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::text('phone' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="ville_id">Ville</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::select('ville_id' , $villes ,null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Adress</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::text('adress' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::text('prix' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Produit</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::text('produit' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {{ Form::number('Qty' , null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Statut</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="status" class="form-control" id="status_select">  
                                            @if($commande->status)
                                             <option value="{{$commande->status}}">{{$statuts[$commande->status]}}</option>
                                            @else
                                             <option value=""></option>
                                            @endif
                                            @foreach($statuts as $stat)
                                              <option value="{{array_search($stat,$statuts)}}">{{$stat}}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                                <?php
                                   $style_send_todeli="display:none;";$style_appoi="display:none;";
                                   if($commande->status==3) $style_appoi="display:block;";
                                ?> 
                                <div class="form-group" id="time_appointment" style="{{$style_appoi}}">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Appointment :</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status" name="created_at" value="{{$date_created_at}}">
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>                                                                     
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {!! Form::textarea('note', null, ['rows' => 4, 'cols' => 54, 'style' => 'resize:none','class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success col-sm-3" name="edit" style="margin-top: 18px;">Edit</button>
                                        <button type="submit" class="btn btn-danger col-sm-3" name="delete" style="margin-top: 18px;">Cancel the order</button>

                                    </div>
                                </div>
                                {!! Form::close() !!}

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
<script>
$(document).ready(function(){   
    $("#status_select").change(function(){
       if($(this).val()==3) $("#time_appointment").show(500);
       else $("#time_appointment").hide(500);
    });
});    
</script>
</html>
