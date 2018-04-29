<?php

include "dbconnect.php";

function getDailyReportHtml() {

 $data = Array();

 $html = "";

 $html .= "<div id='data' align='center'>";
 $html .= "<br>";
 $html .= "<table align='middle'";
 $html .= "<tr> <td align='center' ><h2> ".date("m / d / Y")."</h2></td> </tr>";
 $html .= "</table>";
 $html .= "<br>";

 $html .= '<table border="1" align="middle" id="myTable" class="tablesorter" >
		<thead>
	       		<tr>
				<th>#</th>
				<th>Coin</th>
				<th>Price</th>
				<th>Change</th>
				<th>Quantity</th>
				<th>Value</th>
	       		</tr>
		</thead>

		<tbody>';

   $db = getDatabaseHandle();
   $query = "select *  from coins_data order by value desc";
   $result = getQueryResult($db, $query);

   if( $result ) {

	$cnt = 1;
	while( $row = mysqli_fetch_assoc($result) ) {
	       $html .= "<tr>";
	       $html .= "<td>".$cnt."</td>";
	       $cnt++;
	       $html .= "<td title='".$row['coin']."'> <a href='https://coinmarketcap.com/currencies/".$row['coin']."/' style='text-decoration: none;' target='_blank'><strong> ".$row['symbol']." </strong> </a> </td>";
	       $html .= "	<td>$". round( $row['price'],4)."</td>";
	       $change = round( $row['change_per'], 2);
	       if( $change < 0 ) {
	       		$html .= "	<td style='color:red;'> <strong> ". $change ." % </strong>  </td>";
	       } else {
	       		$html .= "	<td style='color:green;'> <strong> ". $change ." % </strong>  </td>";
	       }
	       $html .= "	<td>".$row['quantity']."</td>";
	       $html .= "	<td>$".$row['value']."</td>";
	       $html .= "</tr>";
	}
   }

	$html .= "</tbody>";
	$html .= "</table>";

   	$query = "select sum(value) as sum  from coins_data";
   	$result = getQueryResult($db, $query);
	$row = mysqli_fetch_assoc($result);

	$html .= "<br> <br>";
	$html .= "<table align='middle'";
	$html .= "<tr> <td align='center' ><h2> Total : $".number_format($row['sum'],0,".",",")."</h2></td> </tr>";
	$html .= "</table>";

	$data["html"]  = $html;
        $data["total"] = "$".number_format($row['sum'],0,".",",");

	return $data;
    }

function getHistoryReportHtml() {


 $html = "";

 $html .= "<div id='data' align='center'>";

 $html .= "<br>";
 $html .= "<table align='middle'";
 $html .= "<tr> <td align='center' ><h2> History </h2></td> </tr>";
 $html .= "</table>";
 $html .= "<br>";

 $html .= '<table border="1" align="middle" id="myTable" class="tablesorter" >
		<thead>
	       		<tr>
				<th>#</th>
				<th>Date</th>
				<th>Total</th>
				<th>html</th>
	       		</tr>
		</thead>

		<tbody>';

   $db = getDatabaseHandle();
   $query = "select *  from history_daily order by id desc limit 30";
   $result = getQueryResult($db, $query);

   if( $result ) {

	$cnt = 1;
	while( $row = mysqli_fetch_assoc($result) ) {
	       $html .= "<tr>";
	       $html .= "<td>".$cnt."</td>";
	       $cnt++;
	       $html .= "	<td>".$row['day']."</td>";
	       $html .= "	<td>".$row['total']."</td>";
	       $html .= "	<td><a href='showDayData.php?day=".$row['day']."' target='_blank' >html</a></td>";
	       $html .= "</tr>";
	}
   }

	$html .= "</tbody>";
	$html .= "</table>";

	return $html;
    }

function getDayReportHtml( $day ) {


 	$html = "";
   
   	$db = getDatabaseHandle();
   	$query = "select *  from history_daily where day='".$day."'";
   	$result = getQueryResult($db, $query);

   	if( $result ) {

		while( $row = mysqli_fetch_assoc($result) ) {
		       return $row['html'];
		}
   	}

	return "";
    }


function getHeader( ) {


 	$html = '<table border="1">
			<tr>
				<td><a href="index.php" target="_blank"> index </a></td>
				<td><a href="update.php" target="_blank"> update </a></td>
				<td><a href="showHistory.php" target="_blank"> history </a></td>
			</tr>
		 </table>';
	return $html;
    }

?>