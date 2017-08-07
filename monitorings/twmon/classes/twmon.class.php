<?php

class twmon 
{
    public function tw_block($ip, $port) 
    {
		$data = $this->getServerInfo("$ip:$port");
		
		$info = array
		(
			"servername" => "<span class=\"off\">Выключен</span>",
			"address" => $ip,
			"port" => $port,
			"mode" => "?",
			"players" => "?",
			"maxplayers" => "?"
		);

		if($data != 0)
		{
			$info["servername"] = $data["name"];
			$info["mode"] = $data["type"];
			$info["players"] = $data["player_count_ingame"];
			$info["maxplayers"] = $data["max_players_ingame"];
		}
		
		return $info;
    }
    
    public function get_servers()
    {
       $servers = file("servers.txt");
        foreach($servers as $key => $server)
        {
            $servers[$key] = explode(":",$server);
        }
       return $servers;
    }
    
    public function output($id, $action)
    {
        $servers = $this->get_servers();
        if(!isset($servers[$id])) die("Сервер с подобным id не найден.");
        if($action == "block")
            return $this->tw_block($servers[$id][0],$servers[$id][1]);
		/*
        elseif($action == "players")
        {
            return $this->cs_players($servers[$id][0],$servers[$id][1], "", "players");
        }*/
    }
	
	public function getServerInfo($server) {
  $socket = stream_socket_client('udp://'.$server , $errno, $errstr, 0.01);
  if(empty($socket))
	return 0;
  fwrite($socket, "\xff\xff\xff\xff\xff\xff\xff\xff\xff\xff\x67\x69\x65\x33\x05");
  $response = fread($socket, 2048);
  
  if ($response){
    $info = explode("\x00",$response);
 
    $players = array();
    for ($i = 0; $i <= $info[8]*5-5 ; $i += 5) {
   
      $teams = Array("Наблюдает","В игре");
      $team = $teams[$info[$i+14]];
   
      $flags = Array();
   
      $flags[] = Array("default", "-1");
      $flags[] = Array("XEN", "901");
      $flags[] = Array("XNI", "902");
      $flags[] = Array("XSC", "903");
      $flags[] = Array("XWA", "904");
      $flags[] = Array("AR", "32");
      $flags[] = Array("AU", "36");
      $flags[] = Array("AT", "40");
      $flags[] = Array("BY", "112");
      $flags[] = Array("BE", "56");
      $flags[] = Array("BR", "76");
      $flags[] = Array("BG", "100");
      $flags[] = Array("CA", "124");
      $flags[] = Array("CL", "152");
      $flags[] = Array("CN", "156");
      $flags[] = Array("CO", "170");
      $flags[] = Array("HR", "191");
      $flags[] = Array("CZ", "203");
      $flags[] = Array("DK", "208");
      $flags[] = Array("EG", "818");
      $flags[] = Array("SV", "222");
      $flags[] = Array("EE", "233");
      $flags[] = Array("FI", "246");
      $flags[] = Array("FR", "250");
      $flags[] = Array("DE", "276");
      $flags[] = Array("GR", "300");
      $flags[] = Array("HU", "348");
      $flags[] = Array("IN", "356");
      $flags[] = Array("ID", "360");
      $flags[] = Array("IR", "364");
      $flags[] = Array("IL", "376");
      $flags[] = Array("IT", "380");
      $flags[] = Array("KZ", "398");
      $flags[] = Array("LV", "428");
      $flags[] = Array("LT", "440");
      $flags[] = Array("LU", "442");
      $flags[] = Array("MX", "484");
      $flags[] = Array("NL", "528");
      $flags[] = Array("NO", "578");
      $flags[] = Array("PK", "586");
      $flags[] = Array("PH", "608");
      $flags[] = Array("PL", "616");
      $flags[] = Array("PT", "620");
      $flags[] = Array("RO", "642");
      $flags[] = Array("RU", "643");
      $flags[] = Array("SA", "682");
      $flags[] = Array("RS", "688");
      $flags[] = Array("SK", "703");
      $flags[] = Array("ZA", "710");
      $flags[] = Array("ES", "724");
      $flags[] = Array("SE", "752");
      $flags[] = Array("CH", "756");
      $flags[] = Array("TR", "792");
      $flags[] = Array("UA", "804");
      $flags[] = Array("GB", "826");
      $flags[] = Array("US", "840");
 
      $flag = "";
   
      foreach ($flags as $flag_tmp)
      {
        if($flag_tmp[1] == $info[$i+12])
        {
          $flag = $flag_tmp[0];
        }
      }
   
 
      $players[] = array(
            "name" => htmlentities($info[$i+10], ENT_QUOTES, "UTF-8"),
            "clan" => htmlentities($info[$i+11], ENT_QUOTES, "UTF-8"),
            "flag" => $flag,
            "score" => $info[$i+13],
            "team" => $team);
    }
 
    if($info[9] == $info[7])
    {
      $specslots = $info[9];
    }else{
      $specslots = $info[9] - $info[7];
    }
    $tmp = array(
    "name" => $info[2],
    "map" => $info[3],
    "type" => $info[4],
    "flags" => $info[5],
    "player_count_ingame" => $info[6],
    "max_players_ingame" => $info[7],
    "player_count_spectator" => $info[8] - $info[6],
    "max_players_spectator" => $specslots,
    "player_count_all" => $info[8],
    "max_players_all" => $info[9],
    "players" => $players);
 
    return $tmp;
 
  } else {
    return FALSE;
  }
}
}