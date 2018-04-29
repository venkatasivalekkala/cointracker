<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/$
    < html xmlns = "http://www.w3.org/1999/xhtml" >
    <head>
  	<meta http-equiv="refresh" content="15">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Apache2 Ubuntu Default Page: It works</title>
        <style type="text/css" media="screen">
            * {
                margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
        }
            td, th {
                padding: 0px 10px 0px 10px;
        }
    </style>

	<script type="text/javascript" src="tablesorter/jquery-latest.js"></script> 
	<script type="text/javascript" src="tablesorter/jquery.tablesorter.js"></script> 

	<script>
		$(document).ready(	function() { 
        			$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
    			} 
		); 
	</script>
    </head>
    <body>
<?php

include "dbconnect.php";

 echo "<div id='data' align='center'>";
 echo "<br>";
 echo "<table align='middle'";
 echo "<tr> <td align='center' ><h2> ".date("m / d / Y")."</h2></td> </tr>";
 echo "</table>";
 echo "<br>";

 echo  '<table border="1" align="middle" id="myTable" class="tablesorter" >
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
	       echo "<tr>";
	       echo "<td>".$cnt."</td>";
	       $cnt++;
	       #echo "	<td>".$row['coin']." ( ".$row['symbol']." )</td>";
	       echo "	<td title='".$row['coin']."'> <a href='https://coinmarketcap.com/currencies/".$row['coin']."/' style='text-decoration: none;' target='_blank'><strong> ".$row['symbol']." </strong> </a> </td>";
	       echo "	<td>$". round( $row['price'],4)."</td>";
	       $change = round( $row['change_per'], 2);
	       if( $change < 0 ) {
	       		echo "	<td style='color:red;'> <strong> ". $change ." % </strong>  </td>";
	       } else {
	       		echo "	<td style='color:green;'> <strong> ". $change ." % </strong>  </td>";
	       }
	       echo "	<td>".$row['quantity']."</td>";
	       echo "	<td>$".$row['value']."</td>";
	       echo "</tr>";
	}
   }

	echo "</tbody>";
	echo "</table>";

   	$query = "select sum(value) as sum  from coins_data";
   	$result = getQueryResult($db, $query);
	$row = mysqli_fetch_assoc($result);

	echo "<br> <br>";
	echo "<table align='middle'";
	echo "<tr> <td align='center' ><h2> Total : $".number_format($row['sum'],0,".",",")."</h2></td> </tr>";
	echo "</table>";

?>	
	</div>
    </body>
</html>