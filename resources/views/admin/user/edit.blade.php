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
                        <h3>Add user</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                {!! Form::model($user,['method' => 'PATCH','action' => ['UserController@update',$user->id]]) !!}
                                <div class="form-group">
                                    {{ Form::label('name' , 'name:') }}
                                    {{ Form::text('name' , null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email' , 'email:') }}
                                    {{ Form::email('email' , null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('ville_id' , 'Ville:') }}
                                    {{ Form::select('ville_id' , $villes ,null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('is_active' , 'status:') }}
                                    {{ Form::select('is_active' ,array(1 => 'Active',0 => 'Not active'), null , ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('role_id' , 'Role:') }}
                                    {{ Form::select('role_id' , $roles ,null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password' , 'Password:') }}
                                    {{ Form::password('password',['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit('Edit' , ['class' => 'btn btn-round btn-success col-sm-3','name'=>'edit']) }}
                                    {{ Form::submit('Delete' , ['class' => 'btn btn-round btn-danger col-sm-3','name'=>'delete']) }}
                                </div>
                                {!! Form::close() !!}
                                {!! Form::model($user,['method' => 'DELETE','action' => ['UserController@destroy',$user->id],'class'=>'col-sm-6']) !!}
                                <div class="form-group">
                                   <!-- {{ Form::submit('Delete' , ['class' => 'btn btn-round btn-danger col-sm-6','style'=>'']) }}-->
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->


    </div>
</div>
@include('templates.script')
</body>
</html>
