<?php

 	/**
	 * Show Forums Moderators 3.1.2
	 */	

class modipb2_function
{
	protected $registry;
	protected $DB;
	protected $request;
	protected $lang;
	
	public function __construct()
	{
		$this->registry	  = ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->request	  =& $this->registry->fetchRequest();
		$this->cache	  =  $this->registry->cache();
		$this->caches	  =& $this->registry->cache()->fetchCaches();
		$this->lang		  =  $this->registry->getClass('class_localization');
		$this->DB         =  $this->registry->DB();
	}
	
	public function getOutput()
	{
	}
	
	public function replaceOutput( $output, $key )
	{
		$this->registry->getClass( 'class_localization')->loadLanguageFile( array( 'public_forums' ), 'forums' );

		$data	= $this->registry->output->getTemplate('boards')->functionData['boardIndexTemplate'][0];
		$tag	= '<!--hook.'.$key.'-->';
		$last	= 0;

		foreach( $data['cat_data'] as $_data )
		{
			if( !$this->registry->output->getAsMobileSkin() AND is_array( $_data['forum_data'] ) AND count( $_data['forum_data'] ) )
			{
				foreach( $_data['forum_data'] as $forum_id => $forum_data )
				{
					$url = $this->registry->getClass("output")->buildSEOUrl( "showforum={$forum_data['id']}", "public", $forum_data['name_seo'], 'showforum' );
					$tag1 = "<a href=\"{$url}\" title='{$forum_data['name']}'>{$forum_data['name']}</a>";
	 				$tag2 = "<p class='desc __forum_desc ipsType_small'>{$forum_data['description']}</p>";

	 				$pos = strpos( $output, $tag1 );
	 				$pos = strpos( $output, $tag2, $pos );
	 				$pos += strlen( $tag2 );
	 	
	 				$string = $this->output = $this->registry->getClass('output')->getTemplate('forum')->moderators_index_forums( $forum_data['id'] );
	 											
	 				if( $pos )
	 				{
	 					$output = substr_replace( $output, $string, $pos, 0 );
	 					$last = $pos + strlen( $tag . $string );
	 				}
				}
			}
		}

		return $output;
	}
}