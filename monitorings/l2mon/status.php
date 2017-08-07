<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/

define("LOCK", true);

$mysqlConfig = array
(
    "host" => "localhost",
    "port" => "3306",
    "login" => "l2",
    "password" => "pzZXGfK2GbyXBwfz"
);

$mainblock = file_get_contents("tpls/main-block.tpl");
$serverinfo = "";
$commonPlayers = 0;

foreach(get_servers() as $each)
{
    list($servername, $ip, $port, $dbname) = $each;
    $infoblock = file_get_contents("tpls/info-block.tpl");
    
    $info = array
    (
        "servername" => $servername,
        "status" => "<span class=\"off\">Выключен</span>",
        "players" => "?"
    );
    
    $monitor = @fsockopen($ip, $port, $errno, $errstr, 1);
    
    if($monitor)
    {
        $info["status"] = "<span class=\"on\">Включен</span>";
        
        $mysql = @mysql_connect("{$mysqlConfig["host"]}:{$mysqlConfig["port"]}", $mysqlConfig["login"], $mysqlConfig["password"]) or die("Ошибка подключение к базе данных.");
        mysql_select_db($dbname) or die("Ошибка работы с базой данных.");
        mysql_query("SET NAMES 'utf8'", $mysql);
        $result = mysql_query("SELECT * FROM `characters` where `online`=1", $mysql);
        $players = mysql_num_rows($result);
        mysql_close($mysql);
        
        $commonPlayers += $players;
        $info["players"] = "<span class=\"on\">$players</span>";
    }
    
    $infoblock = str_replace("{servername}", $info["servername"], $infoblock);
    $infoblock = str_replace("{status}", $info["status"], $infoblock);
    $infoblock = str_replace("{players}", $info["players"], $infoblock);
    $serverinfo .= $infoblock;
}

$mainblock = str_replace("{common-players}", $commonPlayers, $mainblock);
$mainblock = str_replace("{servers-info}", $serverinfo, $mainblock);
echo $mainblock;


function get_servers()
{
	$servers = file("servers.txt");
	foreach($servers as $key => $server)
	{
        $server = trim($server);
		$servers[$key] = explode("~|~",$server);
	}
	return $servers;
}