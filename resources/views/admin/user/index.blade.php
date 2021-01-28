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
                @if(\Illuminate\Support\Facades\Session::has('user_added'))
                 <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-top: 5%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('user_added')}}</strong>
                  </div>
                @elseif(\Illuminate\Support\Facades\Session::has('user_edit'))    
                  <div class="alert alert-info alert-dismissible fade in" role="alert" style="margin-top: 5%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('user_edit')}}</strong>
                  </div>
                @elseif(\Illuminate\Support\Facades\Session::has('user_delete'))                     
                  <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top: 5%;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>{{session('user_delete')}}</strong>
                  </div>
                @endif              
                <div class="page-title">
                    <div class="title_left">
                        <h3>List users</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel" style="overflow-x: auto !important;">
                            <div class="x_content">
                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                          <th>Id</th>                                          
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Role</th>
                                          <th>Status</th>
                                          <th>Created</th>
                                          <th>Updated</th>
                                          <th>Edit</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($users as $user)
                                          <tr>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->id}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->name}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->email}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->role["name"]}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->is_active==1?"Active":"No active"}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->created_at->diffForHumans()}}</a></td>
                                            <td><a href="{{route('user.edit',$user->id)}}">{{$user->updated_at->diffForHumans()}}</a></td>
                                            <td>                                                
                                              <a href="{{route('user.edit',$user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                              {!! Form::open(['method' => 'DELETE','action' => ['UserController@destroy',$user->id]]) !!}
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o"></i> Delete
                                                </button>                                                  
                                              {!! Form::close() !!}                                              
                                            </td>
                                          </tr>
                                       @endforeach
                                    </tbody>
                                  </table>
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
