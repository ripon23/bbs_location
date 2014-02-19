<?php
$host1="localhost";
$user1="root";
$pass1="";
$db1="gramweb_db_server";
$conn1=database_connection($host1,$user1,$pass1,$db1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      #map_canvas {
       width:500px;
	   height: 300px;
       margin: 0px;
       padding: 0px;
	   float:left;
      }
	  .location_title{
		float:left;
		width:500px;
		height:60px;
		background-color:#FCC;
	  }
    </style>

<script src="js/jquery-1.6.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="js/ui/jquery.ui.map.js"></script>
<script>


jQuery(document).ready(function(){

	//Start
	$("#site_division").change(function()
	{
	var id=$(this).val();
	var ltype='DT';
	var dataString = 'id='+ id+'&ltype='+ltype;
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_location.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#site_district").html(html);
			//$('#site_union_show').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_count_total.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#count_total_district").html(html);			
			}
		});
	
	});
	//End
	
	//Start
	$("#site_district").change(function()
	{
	var id=$(this).val();
	var ltype='UP';
	var dataString = 'id='+ id+'&ltype='+ltype;
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_location.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#site_upazila").html(html);
			//$('#site_union_show').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
		
	$.ajax
		({
			type: "POST",
			url: "ajax_load_count_total.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#count_total_upazila").html(html);			
			}
		});	
		
	//Google map		
	$.ajax
		({
			type: "POST",
			url: "ajax_load_google_map.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#map_canvas").html(html);			
			}
		});		
		
	
	});
	//End
	
	//Start
	$("#site_upazila").change(function()
	{
	var id=$(this).val();
	var ltype='UN';
	var dataString = 'id='+ id+'&ltype='+ltype;
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_location.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#site_union").html(html);
			//$('#site_union_show').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
		
	$.ajax
		({
			type: "POST",
			url: "ajax_load_count_total.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#count_total_union").html(html);			
			}
		});	
	
	});
	//End
	
	//Start
	$("#site_union").change(function()
	{
	var id=$(this).val();
	var ltype='MA';
	var dataString = 'id='+ id+'&ltype='+ltype;
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_location.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#site_mouza").html(html);
			//$('#site_union_show').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_count_total.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#count_total_mouza").html(html);			
			}
		});
	
	});
	//End
	
	//Start
	$("#site_mouza").change(function()
	{
	var id=$(this).val();
	var ltype='VI';
	var dataString = 'id='+ id+'&ltype='+ltype;
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_location.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#site_village").html(html);
			//$('#site_union_show').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
	
	$.ajax
		({
			type: "POST",
			url: "ajax_load_count_total.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#count_total_village").html(html);			
			}
		});
	
	});
	//End

});
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>Division:</td>
    <td>District: </td>
    <td>Upazila: </td>
    <td>Union: </td>
    <td>Mouza: </td>
    <td>Village: </td>
  </tr>
  <tr>
    <td><select name="site_division" id="site_division" size="15" >
      <option value="">-- Division--</option>
      <?php            
    $sql=mysql_query("SELECT DISTINCT
				location_bbs2011.division,
       location_bbs2011.*,       
       location_bbs2011.loc_type
  FROM gramweb_db_server.location_bbs2011 location_bbs2011
 WHERE (location_bbs2011.loc_type = 'DV') ORDER BY location_bbs2011.loc_name_en ASC");
    while($row=mysql_fetch_array($sql))
    {
    $id=$row['division'];
    $data=$row['loc_name_en'];			 
    echo '<option value="'.$id.'">'.$data.'</option>';
    } 
	?>
    </select></td>
    <td><select name="site_district" id="site_district" size="15">
      <option selected="selected" value="">--District--</option>
    </select></td>
    <td><select name="site_upazila" id="site_upazila" size="15">
      <option selected="selected" value="">--Upazila--</option>
    </select></td>
    <td><select name="site_union" id="site_union" size="15">
      <option selected="selected" value="">--Union--</option>
    </select></td>
    <td><select name="site_mouza" id="site_mouza" size="15">
      <option selected="selected" value="">--Mouza--</option>
    </select></td>
    <td><select name="site_village" id="site_village" size="15">
      <option selected="selected" value="">--Village--</option>
    </select></td>
  </tr>
  <tr>
    <td><div id="count_total_division"> </div></td>
    <td><div id="count_total_district"> </div></td>
    <td><div id="count_total_upazila"> </div></td>
    <td><div id="count_total_union"> </div></td>
    <td><div id="count_total_mouza"> </div></td>
    <td><div id="count_total_village"> </div></td>
  </tr>
</table>
<br/>
<?php
/**********************************************************************************/
/********************************* Functions  *************************************/
/**********************************************************************************/
function database_connection($host,$user,$pass,$db)
{
	$connect= mysql_connect($host,$user,$pass);
	if(!$connect)
	{
		echo "database not connected For the following error<br />".mysql_error();
	}
	else if($connect)
	{
		//echo "database connected";
	}
	
	mysql_select_db($db,$connect);
	if($db)
	{
		//echo "Database Selected";
	}
	
	elseif(!$db)
	{
		echo "Database cannot be Selected for the following reasons <br />".mysql_error();
	}
} // END function database_connection
?>
    <div id="map_canvas">
    
    </div>
  </body>
</html>
