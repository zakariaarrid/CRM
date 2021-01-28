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
                        <h3>Create Commande</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    @if(count($errors)>0)
                    <div class="alert alert-warning alert-danger fade in" role="alert" style="margin-top: 2%;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                        </ul>    
                    </div>
                    @endif
                        <div class="x_panel">
                            <div class="x_content">
                                {!! Form::open(['method' => 'POST','action' => 'ValidatorController@store','class' => 'form-horizontal form-label-left']) !!}
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ville</label>
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
                                            {{ Form::number('Qty' , null, ['class' => 'form-control','min'=>'1']) }}
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
                                        <button type="submit" class="btn btn-success" style="width: 115px;">Add</button>
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
</html>
