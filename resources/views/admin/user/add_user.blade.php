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
                @if(\Illuminate\Support\Facades\Session::has('mail_exist'))
                 <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top: 5%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('mail_exist')}}</strong>
                  </div>                   
                @endif   
                @if(count($errors)>0)
                    <div class="alert alert-warning alert-danger fade in" role="alert" style="margin-top: 7%;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach($errors->all() as $error)
                              <li>{{$error}}</li>
                            @endforeach
                        </ul>    
                    </div>
                @endif
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
                                {!! Form::open(['method' => 'POST','action' => 'UserController@store']) !!}
                                <div class="form-group">
                                    {{ Form::label('name' , 'name:') }}
                                    {{ Form::text('name' , null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email' , 'email:') }}
                                    {{ Form::email('email' , null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('is_active' , 'status:') }}
                                    {{ Form::select('is_active' ,array(1 => 'Active',0 => 'Not active'), 0 , ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('role_id' , 'Role:') }}
                                    {{ Form::select('role_id' ,['' => 'Choose options'] + $roles  ,null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('ville_id' , 'Ville:') }}
                                    {{ Form::select('ville_id' ,['' => 'Choose options'] + $villes  ,null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password' , 'Password:') }}
                                    {{ Form::password('password',['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit('Add User' , ['class' => 'btn btn-primary']) }}
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
