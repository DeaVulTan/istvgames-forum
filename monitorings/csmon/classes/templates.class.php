<?php

class tpl
{
    var $template = null;
    var $template_copy = null;
    var $data = array();
    var $data_block = array();
    var $result = array();
    
    function load_template($tplname)
    {
        if(!file_exists("tpls/$tplname")) die("Файл с названием \"$tplname\" не найден.");
        else $this->template_copy = file_get_contents("tpls/$tplname");
    }
    
    function set($from, $to)
    {
        $this->data[$from] = $to;
    }
    
    function set_block($from, $to)
    {
        $this->data_block[$from] = $to;
    }
        
    function clear()
    {
        $this->template_copy = null;
        $this->data = array();
    }
    
    function clear_full()
    {
        $this->template = null;
        $this->template_copy = null;
        $this->data = array();
    }
    
    function compile($name, $method = "block")
    {
        if($method == "block")
        {
            foreach($this->data as $key => $value)
            {
                $this->template_copy = str_ireplace($key, $value, $this->template_copy);
            }
            $this->template = $this->template_copy;
            $this->result[$name] = $this->template;
        }
        elseif($method == "players")
        {
            if(!empty($this->data[1]))
            {
                foreach($this->data[1] as $value)
                {
                    $this->set_block("{name}", $value['name']);
                    $this->set_block("{score}", $value['score']);
                    $this->set_block("{time}", $value['time']);
                    $buffer = $this->template_copy;
                    foreach($this->data_block as $key1 => $value1)
                    {
                        $buffer = "\n".str_ireplace($key1, $value1, $buffer);
                    }
                    $this->template .= "\n".$buffer;
                }
                $this->result[$name] = $this->template;
            }
        }
        elseif($method == "servers")
        {
            foreach($this->data[1] as $key => $value)
            {
                //$this->set_block("{address}", "$value[0]:$value[1]");
                $this->set_block("{name}", $value);
                $this->set_block("{id}", $key);
                $buffer = $this->template_copy;
                foreach($this->data_block as $key1 => $value1)
                {
                    $buffer = "\n".str_ireplace($key1, $value1, $buffer);
                }
                $this->template .= "\n".$buffer;
            }
            $this->result[$name] = $this->template;
        }
    }
        
}