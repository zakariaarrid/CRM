<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "c1298069c_admin_db";
    $dbpass = "balbali2012hamza";
    $db = "c1298069c_e_gest";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    $conn -> set_charset("utf8");

    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}
 $conn = OpenCon();

 $sql_retour=$conn->query("SELECT commandes.id,commandes.adress,commandes.tracknumber,commandes.created_at,commandes.day1,commandes.day2,commandes.day3,commandes.prix,commandes.produit,commandes.status,commandes.validated_by,commandes.id,commandes.ville_id,commandes.nom_prenom,commandes.note,commandes.phone,villes.name from commandes JOIN villes on commandes.ville_id=villes.id where commandes.status=6");
//SELECT commandes.adress,commandes.created_at,commandes.day1,commandes.day2,commandes.day3,commandes.prix,commandes.produit,commandes.status,commandes.validated_by,commandes.id,commandes.ville_id,commandes.nom_prenom,commandes.note,commandes.phone,villes.name from commandes JOIN villes commandes.ville_id=villes.id on where commandes.status=6
 while($row=$sql_retour->fetch_object()){
    $data[]=$row;
 }


echo json_encode($data);

CloseCon($conn);



/*$commandes=Role::all();
dd($commandes);*/

?>