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
                        <div class="x_panel" style="overflow-x: auto !important;padding:0;">
                            <div class="x_content" id="app" style="padding: 0;">
                                  <chat-app :user="{{ auth()->user() }}"></chat-app>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        @include('templates.script')
        <script>

        </script>

    </div>
</div>

</body>
<script src="js/app.js"></script>
</html>
