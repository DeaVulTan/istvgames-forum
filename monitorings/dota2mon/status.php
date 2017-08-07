<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");
$vars = array
(
    "name" => "ISTVGames Dota 2 Server",
    "status" => "<span class=\"off\">Выключен</span>",
    "players" =>  "?",
	"ingame_players" => "?",
    "max_players" => "?"
);

try
{
	$filePath = "http://31.135.208.99:9999/online";
	//$filePath = "D:\dota\online";
	$data = file_get_contents($filePath);
	list($lastupdate, $online, $max_online, $ingame_online) = explode("|", $data);
	if(mktime() - (int)$lastupdate <= 7)
	{
		$vars["status"] = "<span class=\"on\">Включен</span>";
		$vars["players"] = "<span class=\"on\">$online";
		$vars["ingame_players"] = $ingame_online;
		$vars["max_players"] = "$max_online</span>";
	}
}
catch (Exception $e)
{
}

$tpl = file_get_contents("main.tpl");
$tpl = str_replace("{name}", $vars["name"], $tpl);
$tpl = str_replace("{status}", $vars["status"], $tpl);
$tpl = str_replace("{players}", $vars["players"], $tpl);
$tpl = str_replace("{ingame_players}", $vars["ingame_players"], $tpl);
$tpl = str_replace("{max_players}", $vars["max_players"], $tpl);
echo $tpl;