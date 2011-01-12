<?php // 3dchar_viewer.php

$config['ip'] = "127.0.0.1";
$config['user'] = "root";
$config['pass'] = "ascent";
$config['char_db'] = "characters";
$config['world_db'] = "mangos";

$dbc = mysql_connect($config['ip'], $config['user'], $config['pass']);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>3D Character Viewer</title>

</head>
<body>

<form action="" method="post">
<table align="center" border="0">
<tr>
<td class="td">
<label for="name">
Character name:</label></td>
<td>
<input type="text" class="select" id="name" maxlength="50" name="name" /><br></td>
</tr>
</table><center><br />
<input type="submit" name="action" value="Search" class="button" />
</form></center> 

<?php
if (isset($_POST['action'])) {

$charname = $_POST["name"];
$definebag = "0";
$errors = 0;

mysql_select_db($config['char_db']);
$query = "SELECT guid, race, gender, playerBytes, playerBytes2 FROM characters WHERE name = '".mysql_real_escape_string($charname)."' LIMIT 1";
$result = mysql_query($query);

if (!mysql_num_rows($result) == 0) { // If OK

$row = mysql_fetch_array($result);

$guid = $row['guid'];
$race = $row['race'];
$gender = $row['gender'];
$b = $row['playerBytes'];
$b2 = $row['playerBytes2'];

// Set Character Features
$ha = ($b>>16)%256;
$hc = ($b>>24)%256;
$fa = ($b>>8)%256;
$sk = $b%256;
$fh = $b2%256;

// Set Character Race/Gender
$char_race = array(
1 => 'human',
2 => 'orc',
3 => 'dwarf',
4 => 'nightelf',
5 => 'scourge',
6 => 'tauren',
7 => 'gnome',
8 => 'troll',
10 => 'bloodelf',
11 => 'draenei');

$char_gender = array(
0 => 'male',
1 => 'female');

$rg = $char_race[$race].$char_gender[$gender];

// Set Character Equipment String 
mysql_select_db($config['char_db']);
$query = "SELECT item_template FROM character_inventory WHERE guid = '$guid' AND slot < '18'";
$result=mysql_query($query);
if (!mysql_num_rows($result) == 0) { // If OK

$eq = "";

while ($row=mysql_fetch_array($result)) {
$item_template = $row['item_template'];
if ($item_template != "") {
mysql_select_db($config['world_db']); 
$query2 = "SELECT displayid, InventoryType FROM item_template WHERE entry = '$item_template' LIMIT 1";
$result2 = mysql_query($query2);
if (!mysql_num_rows($result2) == 0) { 
$row2 = mysql_fetch_array($result2);
$displayid = $row2['displayid'];
$inventory_type = $row2['InventoryType'];
if ($eq == "") {
$eq = $inventory_type.','.$displayid;
} else {
$eq .= ','.$inventory_type.','.$displayid;
}

} else { // If not OK
echo '<p>The DisplayID could not be retrieved. We apologize for any inconvenience.</p>'; // Public message.
//echo '<p>' . mysql_error() . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
$errors++;
} 
}
}

} else { // If not OK
echo '<p>The Inventory could not be retrieved. We apologize for any inconvenience.</p>'; // Public message.
//echo '<p>' . mysql_error() . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
$errors++;
} 

} else { // If not OK
echo '<p>The Character could not be retrieved. We apologize for any inconvenience.</p>'; // Public message.
//echo '<p>' . mysql_error() . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
$errors++;
}

if ($errors == 0) {
?>
<div id="model_scene" align="center">
<object id="wowhead" type="application/x-shockwave-flash" data="http://static.wowhead.com/modelviewer/ModelView.swf" height="900px" width="900px">
<param name="quality" value="high">
<param name="allowscriptaccess" value="always">
<param name="menu" value="false">
<param value="transparent" name="wmode">
<param name="flashvars" value="model=<?php echo $rg ?>&amp;modelType=16&amp;ha=<?php echo $ha;?>&amp;hc=<?php echo $hc;?>&amp;fa=<?php echo $fa;?>&amp;sk=<?php echo $sk;?>&amp;fh=<?php echo $fh;?>&amp;fc=0&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=0&amp;equipList=<?php echo $eq ?>">
<param name="movie" value="http://static.wowhead.com/modelviewer/ModelView.swf">
</object>
</div> 
<?php
}

} // End of Submit Conditional

?>

</body>
</html>

<?php
mysql_close($dbc);
?> 