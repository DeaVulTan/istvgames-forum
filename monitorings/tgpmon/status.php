<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
$vars = array
(
    "name" => "ISTVGames Telegram",
    "status" => "<span class=\"off\">Выключен</span>",
    "connections" =>  "?"
);

try
{
	//$filePath = "http://31.135.208.99:9999/online";
	$filePath = "online";
	$data = file_get_contents($filePath);
	list($lastupdate, $connections) = explode("|", $data);
	if(mktime() - (int)$lastupdate <= 7)
	{
		$vars["status"] = "<span class=\"on\">Включен</span>";
		$vars["connections"] = "<span class=\"on\">$connections</span>";
	}
}
catch (Exception $e)
{
}

$tpl = file_get_contents("main.tpl");
$tpl = str_replace("{name}", $vars["name"], $tpl);
$tpl = str_replace("{status}", $vars["status"], $tpl);
$tpl = str_replace("{connections}", $vars["connections"], $tpl);
echo $tpl;