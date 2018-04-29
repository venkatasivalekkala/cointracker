<?php
include "dbconnect.php";

$db = getDatabaseHandle();
function getCoinsData($db) {
   $query = "select *  from coins_data";
   $result = getQueryResult($db, $query);
   return $result;
};
$result = getCoinsData($db)
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC)
echo json_encode($outp)
?>