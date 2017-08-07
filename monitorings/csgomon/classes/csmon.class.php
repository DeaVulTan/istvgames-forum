<?php

class csmon 
{    
    public function csgo_block($ip, $port) 
    {
        $fp = @fsockopen('udp://'.$ip, $port, $errno, $errstr);
        if ($config['timeout'] = intval($config['timeout'])) 
        {
            @stream_set_timeout($fp, $config['timeout']);
        } 
        else
        {
            @stream_set_timeout($fp, 0, 500000);
        }

        @stream_set_blocking($fp, TRUE);
        if (!$fp)
        {
            unset($data);
            $data['ip'] = $ip;
            $data['port'] = $port;
            $data['hostname'] = "<span class=\"off\">Выключен</span>";
            $data['mapname'] = "?";
            $data['players'] = "?";
            $data['maxplayers'] = "?";
            return $data;
        } 
        else
        {
            $final = false;
            fwrite($fp,"\xFF\xFF\xFF\xFFTSource Engine Query\x00");
            $buffer = fread($fp, 4096);

            if (!$buffer) 
            {
                fclose($fp);
                unset($data);
                $data['ip'] = $ip;
                $data['port'] = $port;
                $data['hostname'] = "<span class=\"off\">Выключен</span>";
                $data['mapname'] = "?";
                $data['players'] = "?";
                $data['maxplayers'] = "?";
                return $data;
            }
            $second_packet = $buffer;

            if (strlen($second_packet) > 0) 
            {
                $reverse_check = dechex(ord($buffer[8]));    
                if ($reverse_check[0] == "1") 
                {
                    $tmp           = $buffer;                
                    $buffer        = $second_packet;
                    $second_packet = $tmp;
                }
     
                $buffer        = substr($buffer, 6);         
                $second_packet = substr($second_packet, 5);    
                $buffer        = trim($buffer.$second_packet); 

                if (!trim($buffer)) 
                {
                    unset($data);
                    $data['ip'] = $ip;
                    $data['port'] = $port;
                    $data['hostname'] = "<span class=\"off\">Выключен</span>";
                    $data['mapname'] = "?";
                    $data['players'] = "?";
                    $data['maxplayers'] = "?";
                    return $data;
                }
            }
        }

        fclose($fp);
        unset($data);
        $tmp = substr($buffer, 0); 
        $tmp = explode("\x00", $tmp);
        $place = strlen($tmp[0].$tmp[1].$tmp[2].$tmp[3]) + 6;
        $data['gamemod']       = $tmp[2];
        $data['hostname']      = $tmp[0];
        $data['mapname']       = $tmp[1];
        $data['players']       = ord($buffer[$place]);
        $data['maxplayers']    = ord($buffer[$place + 1]);
 
        if (substr_count($data['hostname'],"banned") == 1) 
        {
            $data['hostname'] = "Вас забанили на этом сервере";
            $data['mapname'] = "-";
            $data['password'] = "-";
        }

        if ($data == "Server offline") 
        { 
            unset($data);
            $data['ip'] = $ip;
            $data['port'] = $port;
            $data['hostname'] = "<span class=\"off\">Выключен</span>";
            $data['mapname'] = "?";
            $data['players'] = "?";
            $data['maxplayers'] = "?";
            return $data;
        }

        if($data['players'] > $data['maxplayers'])
        {
            $temp=$data['players'];
            $data['players']=$data['maxplayers'];
            $data['maxplayers']=$temp;
        }
        $data['ip'] = $ip;
        $data['port'] = $port;
        return $data;
    }
        
    public function csgo_players($ip, $port, $game, $request) 
    {
        $fp = @fsockopen('udp://'.$ip, $port, $errno, $errstr, 1);
        if (!$fp) { return FALSE; } 
        stream_set_timeout($fp, 1, 0); stream_set_blocking($fp, true); 
        if ($request == "settings" || $request == "players") 
        {
            if ($request == "settings") $challenge_code = "\xFF\xFF\xFF\xFF\x56\x00\x00\x00\x00";
            elseif ($request == "players") $challenge_code = "\xFF\xFF\xFF\xFF\x55\x00\x00\x00\x00"; 
            fwrite($fp, $challenge_code);
            $buffer = fread($fp, 4096);
            if (!trim($buffer)) { fclose($fp); return FALSE; }
            $challenge_code = substr($buffer, 5, 4);
        }
        if ($request == "players")  { $challenge = "\xFF\xFF\xFF\xFFU".$challenge_code; }
        if ($request == "settings") { $challenge = "\xFF\xFF\xFF\xFFV".$challenge_code; }
        fwrite($fp, $challenge);
        $buffer = fread($fp, 4096);
        if (!$buffer) { fclose($fp); return FALSE; }
    
        if ($request == "settings")
        {
            $second_packet = fread($fp, 4096);
            if (strlen($second_packet) > 0)
            {
                $reverse_check = dechex(ord($buffer[8]));    
                if ($reverse_check[0] == "1")
                {
                    $tmp           = $buffer;                
                    $buffer        = $second_packet;
                    $second_packet = $tmp;
                }                 

                $buffer        = substr($buffer, 13);         
                $second_packet = substr($second_packet, 9);    
                $buffer        = trim($buffer.$second_packet); 
            }
            else
            {
                $buffer = trim(substr($buffer, 4));
            }
        }
        else
        {
            $buffer = trim(substr($buffer, 4)); 
        }
        fclose($fp);
        if (!trim($buffer)) { return FALSE; }
        if ($request == "players")
        {
            $player_number = 0;
            $position = 2;
            do
            { 
                $player_number++;                                        
                $player[$player_number]['id'] = ord($buffer[$position]);
                $position ++;                                           
                while($buffer[$position] != "\x00" && $position < 4000)  
                {
                    $player[$player_number]['name'] .= $buffer[$position]; 
                    $position ++;
                }
                $player[$player_number]['score'] = (ord($buffer[$position + 1]))
                                         + (ord($buffer[$position + 2]) * 256)
                                         + (ord($buffer[$position + 3]) * 65536)
                                         + (ord($buffer[$position + 4]) * 16777216);
                if ($player[$player_number]['score'] > 2147483648) { $player[$player_number]['score'] -= 4294967296; }  
                $time = substr($buffer, $position + 5, 4);               
                if (strlen($time) < 4) { return FALSE; }                 
                list(,$time) = unpack("f", $time);                     
                $time = mktime(0, 0, $time);                            
                $player[$player_number]['time'] = date("H:i:s", $time); 
                $position += 9;
            }
            while ($position < strlen($buffer));
            return $player;
        }

        if ($request == "settings")
        {
            $tmp     = substr($buffer, 2);
            $rawdata = explode("\x00", $tmp);
            for ($i=1; $i<count($rawdata); $i=$i+2)
            {
                $rawdata[$i] = strtolower($rawdata[$i]);  
                $setting[$rawdata[$i]] = $rawdata[$i+1];
            }
            return $setting;
        }
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
        //$servers = csmon::get_servers();
        $servers = $this->get_servers();
        if(!isset($servers[$id])) die("Сервер с подобным id не найден.");
        if($action == "block")
        {
            return $this->csgo_block($servers[$id][0],$servers[$id][1]);
        }
        elseif($action == "players")
        {
            return $this->csgo_players($servers[$id][0],$servers[$id][1], "", "players");
        }
    }
}