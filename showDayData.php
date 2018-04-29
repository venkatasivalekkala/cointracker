<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/$
    < html xmlns = "http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Specific Daya Data</title>
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
	$html = getDayReportHtml( $_GET['day'] );
	echo $html;

?>	
	</div>
    </body>
</html>