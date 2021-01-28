<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"><img src="{{ asset('assets/images/logo_am.png') }}" alt="" style="width: 54px;">AM-GROUP</a>
        </div>

        <div class="clearfix"></div>
       <!-- menu profile quick info -->
       <!-- <div class="profile clearfix">
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>-->
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">                                     
                  @if(!Auth::user()->isLiv())
                    <li><a><i class="fa fa-shopping-cart"></i> Orders <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            @if(Auth::user()->isAdmin())
                                <li><a href="{{route('commande.create')}}">Add Order </a></li>
                                <li><a href="{{route('admin.list_orders')}}">List orders </a></li>
                                <li><a href="{{route('admin.confirmation_order')}}">Confirmed order </a></li>                                
                                <li><a href="{{route('admin.order_in_delivering')}}">Order in delivering </a></li>
                                <li><a href="{{route('admin.order_delivered')}}">Orders delivered </a></li>
                            @endif
                            @if(Auth::user()->isSec())
                                <li><a href="{{route('sec.create')}}">Add Order </a></li>
                                <li><a href="{{route('sec.confirmation_order')}}">My confirmed order </a></li>
                                <li><a href="{{route('sec.calcule_delivery')}}">My command livred </a></li>

                            @endif
                            @if(Auth::user()->isValidator())
                                <li><a href="{{route('validateur.create')}}">Add Order </a></li>
                                <li><a href="{{route('validator.order_in_delivering')}}">Order in delivering  </a></li>
                            @endif
                        </ul>
                    </li>
                  @endif  
                    @if(Auth::user()->isAdmin())
                    <li><a><i class="fa fa-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('user.create')}}">Add User</a></li>
                            <li><a href="{{route('user.index')}}">List users</a></li>
                        </ul>
                    </li>                    
                    <li><a><i class="fa fa-bar-chart"></i> Statistic <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('statistics-payment.index')}}">Payment</a></li>
                            <li><a href="{{route('statistic.calcule_statistics')}}">Statistics</a></li>
                            <li><a href="{{route('statistic.calcule_delivring')}}">Statistics delivery</a></li>
                            <!--<li><a href="{{route('statistic.calcule')}}">Calculation table</a></li>-->                   
                        </ul>
                    </li>                    
                    @endif
                    @if(Auth::user()->isLiv())
                        <li><a><i class="fa fa-bar-chart"></i> commands & statistics <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('liv.none_joingnable')}}">Orders none joignable</a></li>
                                <li><a href="{{route('liv.livreur_livred')}}">Statistics</a></li>                               
                                <!--<li><a href="{{route('statistic.calcule')}}">Calculation table</a></li>-->                   
                            </ul>
                        </li>   
                    @endif
                       <!-- <ul class="nav child_menu">
                            <li><a href="index.html">Dashboard</a></li>
                            <li><a href="index2.html">Dashboard2</a></li>
                            <li><a href="index3.html">Dashboard3</a></li>
                        </ul>-->
                    <!--</li>-->
                    <li><a><i class="fa fa-plus-square"></i> Other options <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#"><i class="fa fa-wechat"></i>Chat</a></li>                            
                        </ul>
                    </li>  

                </ul>
            </div>
            <div class="menu_section">
                <!--<h3>Live On</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="e_commerce.html">E-commerce</a></li>
                            <li><a href="projects.html">Projects</a></li>
                            <li><a href="project_detail.html">Project Detail</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="profile.html">Profile</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="page_403.html">403 Error</a></li>
                            <li><a href="page_404.html">404 Error</a></li>
                            <li><a href="page_500.html">500 Error</a></li>
                            <li><a href="plain_page.html">Plain Page</a></li>
                            <li><a href="login.html">Login Page</a></li>
                            <li><a href="pricing_tables.html">Pricing Tables</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#level1_1">Level One</a>
                            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                                    </li>
                                    <li><a href="#level2_1">Level Two</a>
                                    </li>
                                    <li><a href="#level2_2">Level Two</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#level1_2">Level One</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
                -->
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">           
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>