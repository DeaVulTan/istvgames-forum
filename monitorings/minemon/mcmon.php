<?php
function GetServerOnline($host, $port) {

$socket = @fsockopen($host, $port , $errno , $errstr, 0.5);

if (!$socket) {
	return $socket;
}
@fwrite($socket, "\xfe");
$data = "";
$data = @fread($socket, 256);
@fclose($socket);

$data = str_replace("\x00",'',$data);
$server = explode("\xa7",$data);

if(sizeof($server) == 3) {
    $playersOnline = $server[1];
    $playersMax = $server[2];
} else if(sizeof($server) > 3) {
    for($i = 0; $i < sizeof($server) - 2; $i++) {
        $temp .= ($i > 0 ? '§' : '').$server[$i];
    }
    $playersOnline = (int)$server[sizeof($server) - 2];
    $playersMax = (int)$server[sizeof($server) - 1];
}

return "$playersOnline|$playersMax";
}