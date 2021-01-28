<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "c1298069c_admin_db";
    $dbpass = "balbali2012hamza";
    $db = "c1298069c_e_gest";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}
$conn = OpenCon();

$sql_retour=$conn->query("SELECT count(*) as nbr_row from commandes where commandes.status!=6 or commandes.status is null");

$row=$sql_retour->fetch_object();

echo json_encode($row);

CloseCon($conn);



/*$commandes=Role::all();
dd($commandes);*/

?>