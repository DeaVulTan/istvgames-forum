<?php
function ShowServer($name = 'none', $host, $port) {

$socket = @fsockopen($host, $port , $errno , $errstr, 0.5);

if ($socket == false) {
return '
<div class="server-info-holder">
	<div class="server-info-name">'.$name.'</div>
	<div class="server-info-state">
		<div class="redbar">
			<div class="progressbar_meter" style="width:100%"><div class="progressbar_overlay">Сервер выключен</div></div>
		</div>

	</div>
</div>';
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
        $temp .= ($i > 0 ? 'В§' : '').$server[$i];
    }
    $playersOnline = (int)$server[sizeof($server) - 2];
    $playersMax = (int)$server[sizeof($server) - 1];
}

return '
<div class="server-info-holder">
	<div class="server-info-name">'.$name.'</div>
	<div class="server-info-state">
		<div class="greenbar">
			<div class="progressbar_meter" style="width:'.round(($playersOnline/$playersMax)*100).'%">
			'.$playersOnline.' / '.$playersMax.'
            </div>
		</div>
	</div>
</div>';}