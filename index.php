<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/$
    < html xmlns = "http://www.w3.org/1999/xhtml" >
    <head>
  	<meta http-equiv="refresh" content="15">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Todays Data</title>

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
	$data = getDailyReportHtml();
	echo $data["html"];

?>	
	</div>
    </body>
</html>