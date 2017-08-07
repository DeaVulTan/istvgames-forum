<?php
header("Cache-control: no-store");
header("Content-type: text/html; charset=utf-8");


define("ROOT", true);

require_once("classes/twmon.class.php");
require_once("classes/templates.class.php");

$id = trim($_GET['id']);
$action = trim($_GET['action']);
if($action != "players" AND $action != "block" AND $action != "onlyblock") $action = "block";
if(empty($id)) $id = 0;
if(!preg_match("#^([0-9]{1,3})$#i",$id)) die("Неверный id сервера.");

$tpl = new tpl;
$twmon = new twmon();

$data = $twmon->output($id,"block");
$data["port"] = trim($data["port"]);

if($action == "block")
{       
    $serversname = array();
    foreach($twmon->get_servers() as $key => $value)
    {
        $tempdata = $twmon->output($key,"block");
        $serversname[$key] = $tempdata['servername'];
    }
    
    $tpl->load_template("servers-block.tpl");
    $tpl->set("1", $serversname);
    $tpl->compile("servers", "servers");
    $tpl->clear();
    
    $tpl->load_template("info-block.tpl");
    $tpl->set("{address}", "{$data['address']}:{$data['port']}");
    $tpl->set("{servername}", $data['servername']);
    $tpl->set("{mode}", $data['mode']);
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
    $tpl->load_template("info-block.tpl");
    $tpl->set("{address}", "{$data['address']}:{$data['port']}");
    $tpl->set("{servername}", $data['servername']);
    $tpl->set("{mode}", $data['mode']);
    $tpl->set("{players}", "<span class=\"on\">{$data['players']}");
    $tpl->set("{maxplayers}", "{$data['maxplayers']}</span>");
    $tpl->compile("main");
    $tpl->clear();
}

echo $tpl->result["main"];