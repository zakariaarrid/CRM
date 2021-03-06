<!-- jQuery -->
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js' )}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js' )}}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js' )}}"></script>
<!-- NProgress -->
<!--<script src="{{ asset('assets/vendors/nprogress/nprogress.js' )}}"></script>-->
<!-- Chart.js -->
<script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js' )}}"></script>
<!-- gauge.js -->
<script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js' )}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js' )}}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/vendors/iCheck/icheck.min.js' )}}"></script>
<!-- Skycons -->
<script src="{{ asset('assets/vendors/skycons/skycons.js' )}}"></script>
<!-- Flot -->
<!--<script src="{{ asset('assets/vendors/Flot/jquery.flot.js' )}}"></script>
<script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js' )}}"></script>
<script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js' )}}"></script>
<script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js' )}}"></script>
<script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js' )}}"></script>-->
<!-- Flot plugins -->
<!--<script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js' )}}"></script>
<script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js' )}}"></script>-->
<!-- DateJS -->
<script src="{{ asset('assets/vendors/DateJS/build/date.js' )}}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js' )}}"></script>
<script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js' )}}"></script>
<script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js' )}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('assets/vendors/moment/min/moment.min.js' )}}"></script>
<!-- Datatables -->
<script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js' )}}"></script>
<script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/echarts/dist/echarts.min.js' )}}"></script>
<!--<script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js' )}}"></script>
<script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js' )}}"></script>-->
<script src="{{ asset('assets/js/ownscript.js' )}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>
<script src="https://unpkg.com/vue@2.5.16/dist/vue.js"></script>







<!-- Custom Theme Scripts -->
<script src="{{ asset('assets/js/custom.js' )}}"></script>
@if(Auth::check() && Auth::user()->isAdmin())
    <script>
    /*var count=0;
    $(document).ready(function() {  
        $('#datatable-keytable').DataTable( {
        'destroy': true,
        // 'retrieve':true,
            //'scrollX': true,
            "order": [[ 0, "asc" ]]
        });
        let rowCount="";    
        let table;          
        setInterval(function () {
            table = $('#datatable-keytable').DataTable();           
            axios.post('get_count_orders.php').then(            
                function(response){  
                        rowCount =  table.rows().count(); 
                        table = $('#datatable-keytable').DataTable();
                        if(!table.data().any() && response.data.nbr_row>=1){
                            $('#id_order_nbr').html(response.data.nbr_row);
                        }
                        else if(table.data().any() && rowCount>=1 && response.data.nbr_row>=1){
                            if(response.data.nbr_row-(rowCount)>=0){
                               $('#id_order_nbr').html(response.data.nbr_row-rowCount);                             
                            }
                        }
                }
            );

        }, 5000)
    })*/
    </script>
  @endif  