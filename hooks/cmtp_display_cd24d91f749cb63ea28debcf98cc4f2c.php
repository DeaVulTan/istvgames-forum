<?php
/**
 * @ Application : 		Custom Moderator Team Page v2.0.0
 * @ Last Updated : 	June 13th, 2012 
 * @ Author :			Michael S. Edwards
 * @ Copyright :		(c) 2011 Coding Jungle
 * @ Link	 :			http://www.codingjungle.com/
 */    	
class cmtp_display extends public_forums_extras_stats {
	public function _showLeaders() {
		if (!IPSLib::appIsInstalled('cmtp') && $this -> caches['app_cache']['cmtp']['app_enabled'] == 0) {
			parent::_showLeaders();
		} else {

			if (!$this -> registry -> isClassLoaded('cmtp')) {

				$classToLoad = IPSLib::loadLibrary(IPSLib::getAppDir('cmtp') . '/sources/cmtp.php', 'cmtp', 'cmtp');

				$this -> registry -> setClass('cmtp', new $classToLoad($registry));
			}

			if ($this -> settings['cmtp_layout_new'] == 0) {	                            								$this -> registry -> getClass('cmtp') -> CustomModTeam();

				if (strlen($this -> registry -> getClass('cmtp') -> CustomModTeam()) <= 0) {
					parent::_showLeaders();
				}
			} else if ($this -> settings['cmtp_layout_new'] == 1) {
				$this -> registry -> getClass('cmtp') -> CustomModTeamNew();

				if (strlen($this -> registry -> getClass('cmtp') -> CustomModTeam()) <= 0) {
					parent::_showLeaders();
				}
			}
		}
	}
}