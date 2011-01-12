<?php
//==================================================================
// Here are the modules and their settings are
//==================================================================

//==================================================================
// Upload ajax tooltips to things, spells, ènčhantments, talents
//==================================================================
$ajax_modules['tip'] = "include/ajax_tooltip.php";

//==================================================================
// Live search - advance search
//==================================================================
$ajax_modules['ls'] = "module/livesearch/live_search.php";
$ajax_modules['os'] = "module/livesearch/live_search.php";
$config['ls_limit'] = 15; // Выводить резальтатов по умолчанию

//==================================================================
// Ajax upload maps
//==================================================================
$ajax_modules['jsarea'] = "include/ajax_area_data.php";

//==================================================================
// Default plug-in module
//==================================================================
$modules['default'] = "module/online/online.php";

//==================================================================
// Search for things, spellov, nes, PTS, quests, players
//==================================================================
$modules['s'] = "module/search/search.php";
$config['redirect_time']             = 2;
$config['fade_limit']                = 30; // Display default rezal′tatov
$config['show_item_in_search']       =  1; // Show Mini images of things in search_quest
//==================================================================
// Shows information on veŝâh, spell, npc, PTS, quests, zones ect ect
//==================================================================
$modules['npc']     = "module/show/show_npc.php";
$modules['quest']   = "module/show/show_quest.php";
$modules['item']    = "module/show/show_item.php";
$modules['spell']   = "module/show/show_spell.php";
$modules['enchant'] = "module/show/show_enchant.php";
$modules['faction'] = "module/show/show_faction.php";
$modules['itemset'] = "module/show/show_set.php";
$modules['zone']    = "module/show/show_zone.php";

$modules['object']  = "module/show/show_go.php";
$config['show_go_details'] = 1;

//==================================================================
// Add module Open Search in browsers
//==================================================================
$modules['open_search'] = "module/livesearch/open_search.php";

//==================================================================
//  Finding skills (profession including) 
//==================================================================
$modules['skill'] = "module/skills/show_prof_spells.php";
$config['skill_fade_limit'] = 30;

//==================================================================
// Data on instances
//==================================================================
$modules['instance'] = "module/instance/instance.php";

//==================================================================
// Information about maps
//==================================================================
$modules['map']  = "module/maps/map.php";
$modules['area'] = "module/maps/map.php";
$modules['location'] = "module/maps/show_location.php";

//==================================================================
// Talent calculator
//==================================================================
$modules['talent'] = "module/talent_calc/talent.php";
$config['talent_calc_max_level'] = 80;

//==================================================================
// Mini armory
//==================================================================
$modules['player'] = "module/armory/show_character.php";
$config['show_player_skill']  = 1;         // Finding skills during show player (so far test mode)
$config['show_player_fields'] = 1;         // Output table field data during show player
$config['show_player_3d'] = 1;             // Output 3d character

//==================================================================
// Finding things on auction
//==================================================================
$modules['auction'] = "module/auction/auctionhouse.php";

//==================================================================
// Finding owners things
//==================================================================
$modules['itemOwner'] = "module/owners/item_owner.php";

//==================================================================
// Output to validate data in tables
//==================================================================
$modules['debug'] = "module/show/show_debug.php";

//==================================================================
// Output of guilds
//==================================================================
$modules['guild'] = "module/guilds/guilds.php";

//==================================================================
// Information about arena Teams
//==================================================================
$modules['arenateam'] = "module/arenateam/teams.php";

//==================================================================
// Finding online
//==================================================================
$modules['online'] = "module/online/online.php";
$config['show_map_ptr']=1;                 // Links in the map of location
$config['online_limit']=40;                // Limit output online page

//==================================================================
// Finding top money, honor, anena 2,3,5
//==================================================================
$modules['top'] = "module/top/top_100.php";
$config['top_money_limit']=100;            // Limit the number of list
$config['top_honor_limit']=100;            // Limit the number of list
$config['top_arena_limit']=20;             // Limit the number of list

//==================================================================
// Show achievements
//==================================================================
$modules['achievement'] = "module/achievement/achievement.php";
$config['achievement_last']=10;             // Number of recent advances in statistics

//==================================================================
// A little background information
//==================================================================
$modules['faq'] = "module/faq/show_faq.php";

//==================================================================
//  Registration accounts 
//==================================================================
$modules['register'] = "module/registration/script.php";
$config['limit_account_from_one_ip'] = 0;  // Prohibit the registration of more than one account per IP

//==================================================================
// Input/output user personal area
//==================================================================
//$modules['user'] = "module/userpage/user.php";

//==================================================================
// Stats by players
//==================================================================
$modules['stat'] = "module/stat/stat.php";

//==================================================================
// Built-in config plugin change the language and skin
//==================================================================

//==================================================================
//  Request for changing the language 
//==================================================================
if (isset($_REQUEST['lang']))
{
    $_SESSION['lang'] = @$_REQUEST['lang'];        // Remember language
    // Restore the old homepage
    if (isset($_SESSION['last_page']))
        @header('Location: ?'.$_SESSION['last_page']);
}
//==================================================================
// Received a request to change the skin
//==================================================================
else if (isset($_REQUEST['skin']))
{
    $_SESSION['skin'] = @$_REQUEST['skin'];
    //  Restore the old homepage 
    if (isset($_SESSION['last_page']))
        @header('Location: ?'.$_SESSION['last_page']);
}

if (isset($_SESSION['lang']))
{
    switch($_SESSION['lang'])
    {
        case "ru":
        $config['lang'] = "ru";
        $config['locales_lang']=8;
        break;
        case "en":
        $config['lang'] = "en";
        $config['locales_lang']=0;
        break;
        default:
        unset($_SESSION['lang']);
        break;
    }
}

//==================================================================
// Choose a collection of letters to determine the input locale
//==================================================================
switch ($config['locales_lang'])
{
    // For Russian client
    case 8: $config['locales_charset'] = '/[(а-я)|(А-Я)]/'; break;
}

if (isset($_SESSION['skin']))
    $config['skin_type'] = $_SESSION['skin'];
?>
