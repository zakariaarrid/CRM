$(document).ready(function() {
    setInterval(function () {
        let data_commande="";
        $("#tbodyid").empty();
        axios.post('../get_content_confirmer.php').then(
            function(response){
                for (let row of response.data) {
                    data_commande+=`<tr>`;
                    data_commande+=`
                   <td>${row.created_at}</td>
                   <td>AM-${row.id}</td>
                   <td>${row.nom_prenom}</td>
                   <td>${row.phone}</td>
                   <td>${row.name}</td>
                   <td>${row.adress}</td>
                   <td>${row.prix}</td>                   
                   <td>${row.day1}</td>
                   <td>${row.day2}</td>
                   <td>${row.day3}</td>
                   <td>${row.produit}</td>
                   <td>${row.note}</td>
                   <td><a href="../admin/commande/${row.id}/edit"><button type="button" class="btn btn-success btn-xs">Edit</button></a></td>
                   <td>${row.validated_by}</td>`;
                    data_commande+=`</tr>`;
                }
               // $("#datatable-keytable > tbody").append(data_commande);
                $(".c22 > tbody").append(data_commande);
            }
        );
        data_commande='';
    }, 5000)

})
