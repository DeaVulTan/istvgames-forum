<?php
header("Content-type: text/html; charset=windows-1251");
require_once('SampQueryAPI.php');

$address = array("istvgames.uz","7777");
$samp = new SampQueryAPI($address[0],$address[1]);

$sampinfo = array
(
    "hostname" => "<span class=\"off\">Выключен</span>",
    "mapname" => "?",
    "players" => "?",
    "maxplayers" => "?"
);

if($samp->sOnline)
{
    $sampinfo = $samp->getInfo();
}

$template = file_get_contents("main_samp.tpl");

$template = str_ireplace("{address}",implode(":",$address),$template);
$template = str_ireplace("{hostname}",$sampinfo['hostname'],$template);
$template = str_ireplace("{mapname}",$sampinfo['mapname'],$template);
$template = str_ireplace("{players}", "<span class=\"on\">{$sampinfo['players']}",$template);
$template = str_ireplace("{maxplayers}", "{$sampinfo['maxplayers']}</span>",$template);

echo $template;
