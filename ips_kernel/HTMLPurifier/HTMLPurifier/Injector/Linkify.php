<?php

/**
 * Injector that converts http, https and ftp text URLs to actual links.
 */
class HTMLPurifier_Injector_Linkify extends HTMLPurifier_Injector
{

    public $name = 'Linkify';
    public $needed = array('a' => array('href'));

    public function handleText(&$token) {
        if (!$this->allowsElement('a')) return;
        
        //var_dump( $token->data ); exit;

        if (strpos($token->data, '://') === false) {
            // our really quick heuristic failed, abort
            // this may not work so well if we want to match things like
            // "google.com", but then again, most people don't
            return;
        }
//print $token->data;
        // there is/are URL(s). Let's split the string:
        // Note: this regex is extremely permissive
        //$bits = preg_split('#((?:https?|ftp)://[^\s\'"<>()]+)#S', $token->data, -1, PREG_SPLIT_DELIM_CAPTURE);
        /* MODIFIED April 26, 2013
            @link http://community.invisionpower.com/resources/bugs.html/_/ip-board/links-being-corrupted-or-malformed-in-board-and-nexus-r41993
            Test case:
http://invisionpower.com,
http://invisionpower.com.
http://invisionpower.com
https://invisionpower.com
https://blah.gov/blah-blah.as
http://en.wikipedia.org/wiki/Chi_(mythology)
http://en.wikipedia.org/wiki/Assassin's_Creed
(http://google.com)
             */
        $uni=(IPS_DOC_CHAR_SET=="UTF-8")?"u":"";
        preg_match_all( "#(.*?)(\()?((?:http|ftp|https):\/\/[\p{L}\d\-_]+(?:\.[\p{L}\d\-_]+)?(?:[_\p{L}\d\-\.,\'\(\)@?^=%&;:/~\+\#]*[\p{L}\d\-_\@?^=%&/~\+\#]))(.*)(?(?=\S+)\S+)(.*)$#ims" . $uni, $token->data, $matches );
        
        //$token = array();

        // $i = index
        // $c = count
        // $l = is link
        /*for ($i = 0, $c = count($bits), $l = false; $i < $c; $i++, $l = !$l) {
            if (!$l) {
                if ($bits[$i] === '') continue;
                $token[] = new HTMLPurifier_Token_Text($bits[$i]);
            } else {
                $token[] = new HTMLPurifier_Token_Start('a', array('href' => $bits[$i]));
                $token[] = new HTMLPurifier_Token_Text($bits[$i]);
                $token[] = new HTMLPurifier_Token_End('a');
            }
        }*/
        if( is_array($matches[0]) AND count($matches[0]) )
        {
            $tokenold=$token;//by denchu 06062013
            $token = array();//by denchu 06062013

            foreach( $matches[0] as $k => $match )
            {
                if( !$matches[3][$k] )
                {
                    $token[]   = new HTMLPurifier_Token_Text($tokenold->data);
                }
                else
                {
                    if( $matches[1][$k] )
                    {
                        $token[] = new HTMLPurifier_Token_Text($matches[1][$k]);
                    }

                    if( $matches[2][$k] )
                    {
                        $token[] = new HTMLPurifier_Token_Text($matches[2][$k]);
                    }

                    if( !$matches[2][$k] AND !in_array( $matches[4][$k], array( '!', '.', ',' ) ) AND strpos( $matches[4][$k], ' ' ) === false AND ! preg_match( "#(\r|\n|\r\n)#i", $matches[4][$k] ) )
                    {
                        $matches[3][$k] .= $matches[4][$k];
                        unset($matches[4][$k]);
                    }
                    
                    $token[] = new HTMLPurifier_Token_Start('a', array('href' => str_replace( '\'', '%27', $matches[3][$k] )));
                    $token[] = new HTMLPurifier_Token_Text($matches[3][$k]);
                    $token[] = new HTMLPurifier_Token_End('a');

                    if( $matches[4][$k] )
                    {
                  		// Let's do some testing. We may need to recurse in on this line for extra links.
                  		$test = explode( ' ', $matches[4][$k] );
                  		foreach( $test AS $v )
                  		{
                  			if ( strpos( $v, 'http' ) !== false OR strpos( $v, 'https' ) !== false OR strpos( $v, 'ftp' ) !== false )
                  			{
                  				$token[] = new HTMLPurifier_Token_Start('a', array('href' => str_replace( '\'', '%27', $v )));
                  				$token[] = new HTMLPurifier_Token_Text($v);
                  				$token[] = new HTMLPurifier_Token_End('a');
                  				$token[] = new HTMLPurifier_Token_Text(' '); // Because we exploded the text, spaces were lost. Re-add them.
                  			}
                  			else
                  			{
                  				$token[] = new HTMLPurifier_Token_Text($v);
                  				$token[] = new HTMLPurifier_Token_Text(' '); // Because we exploded the text, spaces were lost. Re-add them.
                  			}
                  		}
                        //$token[] = new HTMLPurifier_Token_Text($matches[4][$k]);
                    }
                    
                    if( $matches[5][$k] )
                    {
                    	$token[] = new HTMLPurifier_Token_Text( $matches[5][$k] );
                    }
                }
            }
            unset($tokenold);
        }
    }

}

// vim: et sw=4 sts=4
