<?php
include_once("conf.php");
include_once("include/functions.php");
include_once("include/player_data.php");

$guid = intval(@$_REQUEST['player']);
$tab  = @$_REQUEST['tab'];
$char = getCharacter($guid);
$char_stats = getCharacterStats($guid);

if (!$char)
{
}
else
{
 $char_data2 = explode(' ',$char['equipmentCache']);
 $char_data = explode(' ',$char_stats['data']);
 //$powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
 $genderId  = $char['gender'];
 $class     = $char['class'];
 $race      = $char['race'];
 
 if (!$ajaxmode){
 echo '
 <ul class=my_tabs><center>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'></a></li>';
 echo '</ul></center>
 <div id=reportContainer>';
 };
  
 if (!$ajaxmode)
   echo '</div>';

 if ($config['show_player_fields'])
 {
  //include("show_char_data.php");
  //showPlayerData($char_data);
 }

 include ("show_char_equip.php");
 showPlayerEquip($guid, $char, $char_data, $char_stats);

 if ($config['show_player_skill'])
 {
  include("show_char_talents.php");
  showPlayerTalents($guid, $class, $char['level'], $char['activeSpec']);
  echo "<br>";

  include("show_char_skill.php");
  showPlayerSkills($guid);
  echo "<br>";

  include("show_char_achievements.php");
  showPlayerAchievements($guid, getPlayerFaction($race));
  echo "<br>";

  include("show_char_reputation.php");
  showPlayerReputation($guid, $class, $race);
  echo "<br>";

  
  include("show_char_quest.php");
  showPlayerQuests($guid, $char_data);
  echo "<br>";

  include ("show_char_inventory.php");
  showPlayerInventory($guid, $char_data);
  echo "<br>";

  include("show_char_guild.php");
  $guildid = 0;
  showPlayerGuild($guid, $char_data);
  echo "<br>";
  
  //include("show_char_3d.php");
  //showPlayer3d($char, $char_data);
  
  include("show_char_data.php");
  showPlayerData($char_data);
  
  echo "<br>";
 } 
}
?>
