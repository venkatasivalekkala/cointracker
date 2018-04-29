<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/$
    < html xmlns = "http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Apache2 Ubuntu Default Page: It works</title>
	<link href="style.css" rel="stylesheet">
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

        include "getDailyReportHtml.php";
        echo getHeader();
?>

	<form action="update.php" method="post">
        <div id='data' align="center">
	<br> <br>
	<table border="1" align="middle" id="myTable" class="tablesorter" >
		<thead>
	       		<tr>
				<th>#</th>
				<th>Coin</th>
				<th>Quantity</th>
	       		</tr>
		</thead>

		<tbody>
<?php
#include "dbconnect.php";

   $db = getDatabaseHandle();
if (!empty($_POST)) {
    if($_POST['formType'] == 'update') {
        $data = $_POST;
        unset($data['formType']);
        foreach ($data as $key => $value) {
            $updateQuery = "update coins_data set quantity = $value where symbol = '$key' ;";
            getQueryResult($db, $updateQuery);
        }
    } elseif($_POST['formType'] == 'create'){
        $coin = $_POST['coin'];
        $quantity = $_POST['quantity'];
	$symbol = $_POST['symbol'];
	$result = mysqli_query( $db, "select * from coins_data  where coin = '$coin'");
	$rowCount = mysqli_num_rows($result);
	if(!$rowCount > 0){
        	$createQuery = "insert into coins_data (coin,symbol, quantity) values('$coin','$symbol', $quantity);";
       		getQueryResult($db, $createQuery);
	}
    } elseif($_POST['formType'] == 'delete'){
   	 $symbol = $_POST['symbol'];
	mysqli_query( $db, "delete from coins_data  where symbol = '$symbol'"); 
   }
}

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
	       echo "	<td> <input type='text' name='".$row['symbol']."' value='".$row['quantity']."' /> </td>";
	       echo "</tr>";
	}
   }

	echo "</tbody>";
	echo "</table>";

	echo "<br> <br>";
	echo "<table align='middle'";
	echo "<tr> <td align='center' ><h2><p><input type='submit' value='Update'/></p></h2></td> </tr>";
	echo "</table>";
	mysqli_close($db);
?>
<p class="hidden"><input type="hidden" name="formType" value="update" /></p>
</div>
<br/><br/>
</form>
<form action="update.php" method="post">
    <div align="center">
	<table>
		<tr>
        		<td> <p>Coin Name: <input type="text" name="coin" /></p> </td>
			<td> <p>Symbol: <input type="text" name="symbol" /></p>  </td>
		        <td> <p>Quantity: <input type="text" name="quantity" /></p> </td>
		        <td> <p class="hidden"><input type="hidden" name="formType" value="create" /></p> </td>
		        <td> <p><input type="submit" value="Create" /></p> </td>
		</tr>
	</table>
    </div>
</form>
<br/><br/>
<form action="update.php" method="post">
    <div align="center">
	<table>
		<tr>
        		<td> <p>Symbol: <input type="text" name="symbol" /></p> </td>
        		<td> <p class="hidden"><input type="hidden" name="formType" value="delete" /></p> </td>
		        <td> <p><input type="submit" value="Delete" /></p> </td>
		</tr>
	</table>
    </div>
</form>

	<br> <br> <br>

</body>
</html>