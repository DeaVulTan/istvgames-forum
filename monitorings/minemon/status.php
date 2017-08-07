<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");
include("mcmon.php");
$vars = array
(
    "name" => "ISTVGames Minecraft",
    "status" => "<span class=\"off\">Выключен</span>",
    "players" =>  "?",
    "max_players" => "?"
);

$data = GetServerOnline("31.135.208.98", 25566);
if(!empty($data))
{
	list($online, $max_online) = explode("|", $data);
	$vars["status"] = "<span class=\"on\">Включен</span>";
	$vars["players"] = "<span class=\"on\">$online";
	$vars["max_players"] = "$max_online</span>";
}

$tpl = file_get_contents("main.tpl");
$tpl = str_replace("{name}", $vars["name"], $tpl);
$tpl = str_replace("{status}", $vars["status"], $tpl);
$tpl = str_replace("{players}", $vars["players"], $tpl);
$tpl = str_replace("{max_players}", $vars["max_players"], $tpl);
echo $tpl;