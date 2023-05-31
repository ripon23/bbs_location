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
{$dbfield='upazila'; $parentdbfield='district';}
else if($ltype=='UN')
{$dbfield='unionid'; $parentdbfield='upazila';}
else if($ltype=='MA')
{$dbfield='mouza'; $parentdbfield='unionid';}
else if($ltype=='VI')
{$dbfield='village'; $parentdbfield='mouza';}


$sql="SELECT DISTINCT location_bbs2011.".$dbfield.",
       location_bbs2011.*,       
       location_bbs2011.loc_type
  FROM location_bbs2011 location_bbs2011
 WHERE (location_bbs2011.loc_type = '$ltype') AND location_bbs2011.".$parentdbfield."=".$id." ORDER BY location_bbs2011.loc_name_en ASC";
$result=mysqli_query($conn1, $sql);
//echo '<option value=""> --All--</option>';
	while($row=mysqli_fetch_array($result))
	{
	$id=$row[$dbfield];
    $data=$row['loc_name_en'];	
	echo '<option value="'.$id.'">'.$data.'('.$id.')</option>';
	}
}
else
echo '<option value=""> --All--</option>';
?>
