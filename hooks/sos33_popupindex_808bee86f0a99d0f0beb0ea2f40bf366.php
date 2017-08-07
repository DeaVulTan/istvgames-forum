<?php 
 class sos33_popupindex
 {
     public $registry;
     
     public function __construct()
     {
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();

     }
 
public function getOutput()
{
        if ( !$this->settings['sos33_popupindex_ativado'] )
        {
                return false;
        }
        if ( !$this->settings['sos33_popupindex_cookies'] == '0' )
        {
			switch( $this->request['do'] )
			{	
				default:
					return $this->getOutput1();
				break;
			}
        }
        if ( !$this->settings['sos33_popupindex_cookies'] == '1' )
        {
			switch( $this->request['do'] )
			{	
				default:
					return $this->getOutput2();
				break;
			}
        }
}


public function getOutput1()
{
        if ( IPSMember::isInGroup( $this->memberData, explode( ',', $this->settings['sos33_popupindex_grupos'] ) ) )
        {

                $sos33popup = IPSCookie::get('sos33_popup_cookie');

                if (!$sos33popup )
                {
                        $mostrarPopUp = 1;
                        IPSCookie::set('sos33_popup_cookie', 'sos33_popup_cookie', 1, $this->settings['sos33_popupindex_cookie'] );
                }
                else
                {
                        $mostrarPopUp = 0;
                }

                if ( $mostrarPopUp == 1 )
                {
                        IPSText::getTextClass('bbcode')->parse_html = $this->settings['sos33_popupindex_html'];
                        $text = IPSText::getTextClass( 'bbcode' )->preDisplayParse( IPSText::getTextClass( 'bbcode' )->preDbParse(  $this->settings['sos33_popupindex_texto'] ) );
                        return $this->registry->output->getTemplate( 'boards' )->sos33popupindex( $text );
                }
        }
        else
        {
                return false;
        }
}

public function getOutput2()
{
        if ( IPSMember::isInGroup( $this->memberData, explode( ',', $this->settings['sos33_popupindex_grupos'] ) ) )
        {
                        IPSText::getTextClass('bbcode')->parse_html = $this->settings['sos33_popupindex_html'];
                        $text = IPSText::getTextClass( 'bbcode' )->preDisplayParse( IPSText::getTextClass( 'bbcode' )->preDbParse(  $this->settings['sos33_popupindex_texto'] ) );
                        return $this->registry->output->getTemplate( 'boards' )->sos33popupindex( $text );
        }
    }
}