<script src="js/jquery-1.6.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ui/jquery.ui.map.js"></script>
<?php
$host1="localhost";
$user1="root";
$pass1="";
$db1="peacedb";
$conn1=database_connection($host1,$user1,$pass1,$db1);
/**********************************************************************************/
/********************************* Functions  *************************************/
/**********************************************************************************/
function database_connection($host,$user,$pass,$db)
{
	
	// Create connection
	$conn = mysqli_connect($host, $user, $pass, $db);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	return $conn;
}
// function database_connection($host,$user,$pass,$db)
// {
// 	$connect= mysql_connect($host,$user,$pass);
// 	if(!$connect)
// 	{
// 		echo "database not connected For the following error<br />".mysql_error();
// 	}
// 	else if($connect)
// 	{
// 		//echo "database connected";
// 	}
	
// 	mysql_select_db($db,$connect);
// 	if($db)
// 	{
// 		//echo "Database Selected";
// 	}
	
// 	elseif(!$db)
// 	{
// 		echo "Database cannot be Selected for the following reasons <br />".mysql_error();
// 	}
// } // END function database_connection
?>
<?php

if($_POST['id'])
{
$id=$_POST['id'];
$ltype=$_POST['ltype'];

if($ltype=='DT')
{$dbfield='district'; $parentdbfield='division';}
else if($ltype=='UP')
{$dbfield='upazila'; $parentdbfield='district'; $pltype='DT';}
else if($ltype=='UN')
{$dbfield='unionid'; $parentdbfield='upazila'; $pltype='UP';}
else if($ltype=='MA')
{$dbfield='mouza'; $parentdbfield='unionid'; $pltype='UN';}
else if($ltype=='VI')
{$dbfield='village'; $parentdbfield='mouza'; $pltype='MA';}


$sql="SELECT location_bbs2011.".$parentdbfield.", loc_type, loc_name_en, latitude_longitude
  FROM location_bbs2011 location_bbs2011
 WHERE (location_bbs2011.loc_type = '$pltype') AND location_bbs2011.".$parentdbfield."=".$id." ORDER BY location_bbs2011.loc_name_en ASC";
$result=mysqli_query($conn1, $sql);
$row = mysqli_fetch_row($result);
$id=$row[0]; 						//id
$loc_type=$row[1];					//loc_type
$loc_name_en=$row[2];				//loc_type
$latitude_longitude=$row[3];		//loc_type
//echo $loc_name_en;
echo "<script> $('#map_canvas').gmap({'center': '$latitude_longitude', 'zoom': 10, 'bounds': true, 'disableDefaultUI':true, 'callback': function() {
						var self = this;
						self.addMarker({'position': this.get('map').getCenter() }).click(function() {
							self.openInfoWindow({ 'content': '$loc_name_en' }, this);
						});	
					}});</script><br/><h4>$loc_name_en</h4>";
//echo $loc_name_en." (".$latitude_longitude.")";
?>
<?php	
}
else
echo 'Google map latitude longitude not define';
?>