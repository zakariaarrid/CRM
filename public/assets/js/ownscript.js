/*new Vue({
    el:'#id1',
    methods:{
        onChange(event) {
           alert((event.target.value));
        }
    }
});*/
$(document).ready(function() {
    $('#dataTable').dataTable({
        "destroy":true
        
    });
    //$('.c11').dataTable({        
       /* "order": [[ 0, "desc" ]],
        "destroy":true,*/
    //});
});

function onChange1(a) {
    document.getElementById(a).submit();
}
function onChange2(a) {
    document.getElementById(a).submit();
}
function onChange3(a) {
    document.getElementById(a).submit();
}
function onChange4(a) {
    document.getElementById(a).submit();
}

 


