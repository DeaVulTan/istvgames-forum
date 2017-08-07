<?php

/**
 * (CSN-IPB34) Snowstorm
 *
 * @author    (CSN) Tails <yuri@dunaev.org>
 * @copyright (c) 2013 CYBER-SYSTEMS Network
 * @link      http://cyber-systems.net/
 */

class csnIPB3_snowStorm
{
  /**
   * Registry object
   *
   * @var object
   */
  protected $registry;
  protected $settings;
  protected $lang;
  protected $memberData;
  protected $cache;

  /**
   * Constructor
   *
   * @return @e void
   */
  public function __construct()
  {
    $this->registry = ipsRegistry::instance();
    $this->settings =& $this->registry->fetchSettings();
    $this->lang = $this->registry->getClass('class_localization');
    $this->memberData =& $this->registry->member()->fetchMemberData();
    $this->cache = $this->registry->cache();
  }

  /**
   * Get the output
   *
   * @return mixed
   */
  public function getOutput()
  {
    /* INIT */
    $setInclude = $this->settings['csnIPB3_snowStorm_include'];
    $setUserGroups = IPSMember::isInGroup($this->memberData, explode(',', $this->settings['csnIPB3_snowStorm_userGroups']));

    $output = $this->registry->output->getTemplate('global_other')->hookSnowstorm();

    if (!$setInclude || $setUserGroups) {
      return;
    }

    if ($this->settings['csnIPB3_snowStorm_sectionIdx']) {
      // idx shortcut not used?
      if ($this->request['act'] == 'idx' || (IPS_APP_COMPONENT == 'forums' && ipsRegistry::$current_module == 'forums' && ipsRegistry::$current_section == 'boards')) {
        // Go on!
      } else {
        return;
      }
    }

    return $output;
  }
}