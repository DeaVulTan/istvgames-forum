<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			preview.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class public_promenu_preview_preview extends ipsCommand
{
	public function doExecute( ipsRegistry $registry )
	{

        		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->cache    = $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();
		$this->lang     = $this->registry->getClass('class_localization');
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();


		switch( $this->request['do'] )
		{
			default:
				$this->preview();
			break;
		}
	}
    
    public function preview(){
                //--starthtml--//
        $id = intval($this->request['menu_id']);
        $parent = intval($this->request['parent']);
        $groupID = intval($this->request['group_id']);
        $groupKey = $this->request['group_key'];

        $html = <<< HTML
        <script type="text/javascript"src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>         
        <script type='text/javascript' src='{$this->settings['public_dir']}js/promenu/promenu.js'></script>   
    
        <script type='text/javascript'>  
            ProjQ171 = jQuery.noConflict(true);  
            typeShow = "{$this->settings['animationShow']}";  
  
            typeHide = "{$this->settings['animationHiding']}";  
  
            dd = {$this->settings['ShowSpeed']};  
  
            du = {$this->settings['HideSpeed']};  
  
            click = {$this->settings['behavior']};  
  
            topOffset = {$this->settings['TopOffSet']}; 

           jQ(document).ready(function() {           
HTML;
            if ($groupKey == "header_menus") {
                $html .= <<< HTML
             jQ("#header_menus").find("a").attr('href', 'javascript:void(0)');
  	         jQ("#header_menus").ProMenu();
HTML;
            }
            if ($groupKey == "primary_menus") {
                $html .= <<< HTML
             jQ("#primary_menus").find("a").attr('href', 'javascript:void(0)');
  	         jQ("#primary_menus").ProMenu();
HTML;
            }
            if ($groupKey == "footer_menus") {
                $html .= <<< HTML
  	         jQ("#footer_menus").find("a").attr('href', 'javascript:void(0)');
HTML;
            }
            $html .= <<< HTML
            });
 
        </script>  
                 
          
HTML;
        
			if( !$this->registry->isClassLoaded( 'app_class_promenu' ) ) 
			{ 
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir('promenu') . '/app_class_promenu.php', 'app_class_promenu', 'promenu' ); 
				$this->registry->setClass( 'app_class_promenu', new $classToLoad( $this->registry ) ); 
			}	

			$menudata = $this->registry->getClass('class_functions')->get_menus($groupKey);

			
			if( is_array( $menudata ) && count( $menudata ) )
			{
				if ( $this->settings['promenu_group_perm_view'] == 1 ) 
				{ 
					$menudata = $this->registry->getClass('class_perms')->checkGroupView( $menudata ); 
				}
				else
				{
					$menudata = $this->registry->getClass('class_perms')->checkPermissions( $menudata );
				}
							
				$menudata = $this->registry->getClass('class_functions')->parseMenuURL( $menudata );
				
				$menudata = $this->registry->getClass('class_functions')->parseMenuActive( $menudata );


        if($groupKey == "header_menus")
          {
            $html .= $this->registry->getClass('output')->getTemplate('promenu')->header_menus($menudata);
          }
          else if($groupKey == "primary_menus")
          {
            $html .= <<< HTML
            	<div><div id="primary_nav" class="clearfix"><div class="main_width"><ul class="ipsList_inline" id="community_app_menu">
HTML;
            $html .= $this->registry->getClass('output')->getTemplate('promenu')->primary_menus($menudata);
            $html .= <<< HTML
            	</ul></div></div></div>
HTML;
          }
          else if($groupKey == "footer_menus")
          {
            $html .= $this->registry->getClass('output')->getTemplate('promenu')->footer_menus($menudata);
          }
            $html .= "<br /><div id='content'><h1 class='ipsType_pagetitle' style='text-align:center;'>PREVIEW</h1></div>"; 
       
		$this->registry->output->popUpWindow( $html );
        
	}
}	

	


}