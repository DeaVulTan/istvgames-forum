<?php
/**
 * Monitoring for TeamSpeak3 servers.
 * Developed by petok & gotyaMeon.
  */
$config = array
(
    'tsShowIP' => 'istvgames.uz',
    'tsPort' => '9987',
    'tsSQLogin' => 'admin',
    'tsSQPassword' => 'BjtQkCuA',
    'tsSQPort' => '10011',
);

function set($need, $handle)
{
    global $template;
    $template = str_ireplace($need, $handle, $template);
}
//-------------------------------------------//
header('Content-Type: text/html; charset=utf-8');
$template = file_get_contents('main.tpl');

require_once('TeamSpeak3/TeamSpeak3.php');
try
{
    $ts3_connect = new TeamSpeak3;
    $ts3 = $ts3_connect->factory("serverquery://{$config['tsSQLogin']}:{$config['tsSQPassword']}@localhost:{$config['tsSQPort']}/?server_port={$config['tsPort']}");
    //$serverStarted = true; 
} catch(Exception $e)
{
    set('{ip}', $config['tsShowIP']);
    set('{status}', '<span class="off">Выключен</span>');
    set('{version}', '?');
    set('{online}', '?');
    die($template);
}
set('{ip}', $config['tsShowIP']);
set('{status}', '<span class="on">Включен</span>');
set('{version}', $ts3->version('version'));
set('{online}', "<span class=\"on\">".(count($ts3->clientList())-1)."</span>");

die($template);
