<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");


define("TURON_CS_MON", true);

require_once("classes/csmon.class.php");
require_once("classes/templates.class.php");

$id = trim($_GET['id']);
$action = trim($_GET['action']);
if($action != "players" AND $action != "block" AND $action != "onlyblock") $action = "block";
if(empty($id)) $id = 0;
if(!preg_match("#^([0-9]{1,3})$#i",$id)) die("Неверный id сервера.");

$tpl = new tpl;
$csmon = new csmon();

$data = $csmon->output($id,"block");
$players = $csmon->output($id,"players");
$data["port"] = trim($data["port"]);

if($action == "block")
{
    $imglink = "mapimgs/{$data['mapname']}.jpg";
    if(!file_exists($imglink)) $imglink = "mapimgs/noimg.png";
   
    $serversname = array();
    foreach($csmon->get_servers() as $key => $value)
    {
        $tempdata = $csmon->output($key,"block");
        $serversname[$key] = $tempdata['hostname'];
    }
    
    $tpl->load_template("servers-block.tpl");
    $tpl->set("1", $serversname);
    $tpl->compile("servers", "servers");
    $tpl->clear();
    
    $tpl->load_template("info-block.tpl");
    $tpl->set("{imglink}", $imglink);
    $tpl->set("{address}", "{$data['ip']}:{$data['port']}");
    $tpl->set("{server}", $data['hostname']);
    $tpl->set("{map}", $data['mapname']);
    $tpl->set("{players}", "<span class=\"on\">{$data['players']}");
    $tpl->set("{maxplayers}", "{$data['maxplayers']}</span>");
    $tpl->compile("info-block");
    $tpl->clear();
        
    $tpl->load_template("main-block.tpl");
    $tpl->set("{server-info}", $tpl->result["info-block"]);
    $tpl->set("{servers}", $tpl->result["servers"]);
    $tpl->compile("main");
    $tpl->clear();
}
elseif($action == "players")
{
    print_r($players);
    $tpl->load_template("server-tr.tpl");
    $tpl->set("1", $players);
    $tpl->compile("players", "players");
    $tpl->clear();
    
    $tpl->load_template("server-list.tpl");
    $tpl->set("{players}", $tpl->result["players"]);
    $tpl->compile("server-list");
    $tpl->clear();
    
    $tpl->load_template("server-block.tpl");
    $tpl->set("{server}", $data['hostname']);
    $tpl->set("{players-list}", $tpl->result['server-list']);
    $tpl->compile("main");
    $tpl->clear();
}
elseif($action == "onlyblock")
{
    $imglink = "mapimgs/{$data['mapname']}.jpg";
    if(!file_exists($imglink)) $imglink = "mapimgs/noimg.png";
    
    $playerslink = "
    <a href=\"#\" onclick=\" window.open('status.php?action=players&id=$id', 'mywin', 'width=525, height=590, scrollbars=yes'); return false \">
    ";
    if($data['mapname'] == "?") $playerslink = "";
    
    $tpl->load_template("info-block.tpl");
    $tpl->set("{imglink}", $imglink);
    $tpl->set("{address}", "{$data['ip']}:{$data['port']}");
    $tpl->set("{server}", $data['hostname']);
    $tpl->set("{map}", $data['mapname']);
    $tpl->set("{players}", "<span class=\"on\">{$data['players']}");
    $tpl->set("{maxplayers}", "{$data['maxplayers']}</span>");
    $tpl->set("{playerslink}", $playerslink);
    $tpl->compile("main");
    $tpl->clear();
}

echo $tpl->result["main"];