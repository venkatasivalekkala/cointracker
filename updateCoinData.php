<?php
include "coinmc.php";
include "dbconnect.php";

$db = getDatabaseHandle();

function getCoinsList($db) {
   $query = "select coin, quantity from coins_data";
   $result = getQueryResult($db, $query);
   return $result;
};

function updateTableRow($rowData, $quantity, $db){
	$data = $rowData[0];
	$price = $data->price_usd;
	$change_per = $data->percent_change_24h;
	$value = $quantity * $price;
	$coin = $data->id;
	$symbol = $data->symbol;
	$query = "update coins_data set change_per=$change_per, price=$price, value=$value, symbol='$symbol'  where coin ='$coin';" ;
	getQueryResult($db, $query);
}

$coinsList = getCoinsList($db);

if($coinsList -> num_rows > 0 ){
   while($row = $coinsList->fetch_assoc()) {
        $id = $row["coin"];
	$quantity = $row["quantity"];
	$coinData = getCoinData($id);
	if($coinData){
	  updateTableRow($coinData, $quantity, $db);
	}
  }
}
//$coin_data = getCoinData("bitcoin");


?>