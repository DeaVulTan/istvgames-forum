<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sun, 27 Sep 2015 13:40:54 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_login_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['ajax__inlineLogInForm'] = array('registerUsingFb','twitterBox','haswindowslive','registerServices','anonymous','hasRedirect');
$this->_funcHooks['showLogInForm'] = array('extrafields','referer','facebook','twitterBox','haswindowslive','extraform','liveform','anonymous','privvy','toggleLive');


}

/* -- ajax__inlineLogInForm --*/
function ajax__inlineLogInForm() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_login', $this->_funcHooks['ajax__inlineLogInForm'] ) )
{
$count_a3dab2bda5f3121dc816ce5802671484 = is_array($this->functionData['ajax__inlineLogInForm']) ? count($this->functionData['ajax__inlineLogInForm']) : 0;
}
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- errors --*/
function errors($data="") {
$IPBHTML = "";
$IPBHTML .= "<!-- NoData -->";
return $IPBHTML;
}

/* -- showLogInForm --*/
function showLogInForm($message="",$referer="",$extra_form="", $login_methods=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_login', $this->_funcHooks['showLogInForm'] ) )
{
$count_b17e5c99f345135d11dffc581b50678c = is_array($this->functionData['showLogInForm']) ? count($this->functionData['showLogInForm']) : 0;
$this->functionData['showLogInForm'][$count_b17e5c99f345135d11dffc581b50678c]['message'] = $message;
$this->functionData['showLogInForm'][$count_b17e5c99f345135d11dffc581b50678c]['referer'] = $referer;
$this->functionData['showLogInForm'][$count_b17e5c99f345135d11dffc581b50678c]['extra_form'] = $extra_form;
$this->functionData['showLogInForm'][$count_b17e5c99f345135d11dffc581b50678c]['login_methods'] = $login_methods;
}
$IPBHTML .= "<template>LoginRequired</template>
<categories>
	<category>
		<id>180</id>
		<name>
		<![CDATA[ Registration Required ]]>
		</name>
		<forums>
			<forum>
				<id>1</id>
				<name>
					<![CDATA[ Please login or register ]]>
				</name>
				<url>
					<![CDATA[]]>
				</url>
				<description>
					<![CDATA[]]>
				</description>
				<isRead>1</isRead>
				<redirect>0</redirect>
				<type/>
				<topics>0</topics>
				<replies>0</replies>
				<lastpost>
					<date>14 May 2012</date>
					<name>
						<![CDATA[]]>
					</name>
					<id>362680</id>
					<url>
						<![CDATA[]]>
					</url>
					<user>
						<id>0</id>
						<name>
						<![CDATA[]]>
						</name>
						<url>
							<![CDATA[]]>
						</url>
					</user>
				</lastpost>
			</forum>
		</forums>
	</category>
</categories>";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>