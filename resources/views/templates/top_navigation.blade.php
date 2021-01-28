
<div class="top_nav">

    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/img.jpg" alt="">
                        @if(Auth::check())
                            {{Auth::user()->name}}
                        @endif
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">                    
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
                @if(Auth::user()->isAdmin())
                <li role="presentation" class="dropdown" id="count">
                    <a href="/" class="dropdown-toggle info-number">                        
                          <i class="fa fa-bell" v-bind:class="{notification:isActive}"></i>                        
                          <span class="badge bg-green" id="id_order_nbr"></span>                        
                    </a>
                </li>
                @endif  
                @if(Auth::user()->isLiv())
                <li role="presentation" class="dropdown">
                    <a href="{{route('dashboard')}}" class="dropdown-toggle info-number">                        
                          <i class="fa fa-bicycle" style="font-size: 20px !important;"></i>                        
                          <span class="badge bg-green" id="id_order_nbr_livreur"></span>                        
                    </a>
                </li>
                @endif  
            </ul>
        </nav>
    </div>
</div>


