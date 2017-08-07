<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_register_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['completePartialLogin'] = array('reqCfieldDescSpan','custom_required','optCfieldDescSpan','custom_optional','hasAName','partialLoginErrors','fbDNInner','fbDisplayName','partialAllowDnames','partialNoEmail','reqCfields','optCfields','partialCustomFields');
$this->_funcHooks['lostPasswordForm'] = array('lostPasswordErrors');
$this->_funcHooks['registerCoppaForm'] = array('coppaConsentExtra');
$this->_funcHooks['registerCoppaStart'] = array('coppaMRange','coppaDRange','coppaYRange');
$this->_funcHooks['registerForm'] = array('general_errors','statesJs','isCountrySelect','isCountryWords','options','states','statesCountries','isAddressOrPhone','isAddress2','isAddress1','textRequired','textErrorMessage','isText','dropdownRequired','isCountry','dropdownErrorMessage','isDropdown','specialRequired','specialErrorMessage','isSpecial','fields','reqCfieldDescSpan','custom_required','optCfieldDescSpan','custom_optional','registerHasErrors','registerUsingFb','twitterBox','registerServices','registerHasInlineErrors','ieDnameClass','ieDname','ieEmailClass','ieEmail','iePasswordClass','iePassword','hasNexusFields','reqCfields','optCfields','hasCfields','defaultAAE','checkedTOS','ieDnameClass','ieTOS','privvy','useCoppa');
$this->_funcHooks['showLostpassForm'] = array('lostpassFormErrors','lpFormMethodChoose');
$this->_funcHooks['showRevalidateForm'] = array('revalidateError');


}

/* -- completePartialLogin --*/
function completePartialLogin($mid="",$key="",$custom_fields="",$errors="", $reg="", $userFromService=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['completePartialLogin'] ) )
{
$count_7b8a297330b43231630e70ac561ceb1b = is_array($this->functionData['completePartialLogin']) ? count($this->functionData['completePartialLogin']) : 0;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['mid'] = $mid;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['key'] = $key;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['custom_fields'] = $custom_fields;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['errors'] = $errors;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['reg'] = $reg;
$this->functionData['completePartialLogin'][$count_7b8a297330b43231630e70ac561ceb1b]['userFromService'] = $userFromService;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- lostPasswordForm --*/
function lostPasswordForm($errors="") {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['lostPasswordForm'] ) )
{
$count_c12f644afdd3e0ead5866fee88680db5 = is_array($this->functionData['lostPasswordForm']) ? count($this->functionData['lostPasswordForm']) : 0;
$this->functionData['lostPasswordForm'][$count_c12f644afdd3e0ead5866fee88680db5]['errors'] = $errors;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- lostPasswordWait --*/
function lostPasswordWait($member="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- registerCoppaForm --*/
function registerCoppaForm() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['registerCoppaForm'] ) )
{
$count_299737c6996ce324713897a4ee1b86d9 = is_array($this->functionData['registerCoppaForm']) ? count($this->functionData['registerCoppaForm']) : 0;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- registerCoppaStart --*/
function registerCoppaStart() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['registerCoppaStart'] ) )
{
$count_1b0cf50921f4335922f17d61d5306157 = is_array($this->functionData['registerCoppaStart']) ? count($this->functionData['registerCoppaStart']) : 0;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- registerCoppaTwo --*/
function registerCoppaTwo() {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- registerForm --*/
function registerForm($general_errors=array(), $data=array(), $inline_errors=array(), $time_select=array(), $custom_fields=array(), $nexusFields=array(), $nexusStates=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['registerForm'] ) )
{
$count_e65a3ccbb18548640bc8776c4633e2fe = is_array($this->functionData['registerForm']) ? count($this->functionData['registerForm']) : 0;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['general_errors'] = $general_errors;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['data'] = $data;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['inline_errors'] = $inline_errors;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['time_select'] = $time_select;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['custom_fields'] = $custom_fields;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['nexusFields'] = $nexusFields;
$this->functionData['registerForm'][$count_e65a3ccbb18548640bc8776c4633e2fe]['nexusStates'] = $nexusStates;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- registerStepBar --*/
function registerStepBar($step) {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- show_lostpass_form_auto --*/
function show_lostpass_form_auto($aid="",$uid="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- show_lostpass_form_manual --*/
function show_lostpass_form_manual() {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showAuthorize --*/
function showAuthorize($member="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showLostpassForm --*/
function showLostpassForm($error) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['showLostpassForm'] ) )
{
$count_e58248858f31758bb89d2ed79740051a = is_array($this->functionData['showLostpassForm']) ? count($this->functionData['showLostpassForm']) : 0;
$this->functionData['showLostpassForm'][$count_e58248858f31758bb89d2ed79740051a]['error'] = $error;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showLostPassWaitRandom --*/
function showLostPassWaitRandom($member="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showManualForm --*/
function showManualForm($type="reg") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showPreview --*/
function showPreview($member="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showRevalidated --*/
function showRevalidated() {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showRevalidateForm --*/
function showRevalidateForm($name="",$error="") {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_register', $this->_funcHooks['showRevalidateForm'] ) )
{
$count_2509b35d057f7eade9e69e67c5ac1301 = is_array($this->functionData['showRevalidateForm']) ? count($this->functionData['showRevalidateForm']) : 0;
$this->functionData['showRevalidateForm'][$count_2509b35d057f7eade9e69e67c5ac1301]['name'] = $name;
$this->functionData['showRevalidateForm'][$count_2509b35d057f7eade9e69e67c5ac1301]['error'] = $error;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>