<?php

class ipsEditorThemes
{
  public function __construct()
  {
    $this->registry   =  ipsRegistry::instance();
    $this->memberData   = $this->registry->member()->fetchMemberData();
    $this->settings   = $this->registry->fetchSettings();
  }
  public function getOutput()
  {
    if ( strstr(  ",{$this->settings['ipsEditorThemes_group']},", ",{$this->memberData['member_group_id']}," ) && ipsRegistry::$settings['ipsEditorThemes_enabled'] !== '0')
    {
      $html = ipsRegistry::getClass('output')->getTemplate('ipsthemes')->ipsEditorThemes();
    }
    return $html;
  }
}