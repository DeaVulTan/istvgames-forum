//<?php
class shoutboxGlobalJs extends pipsAndTeamIcons
{
public function globalTemplate( $html, $documentHeadItems, $css, $jsModules, $metaTags, array $header_items, $items=array(), $footer_items=array(), $stats=array())
	{
$output = preg_replace( "#<!--hook\.([^\>]+?)-->#", '', ipsRegistry::getClass('output')->templateHooks(parent::globalTemplate( $html, $documentHeadItems, $css, $jsModules, $metaTags, $header_items, $items, $footer_items, $stats)));
if(IPSLib::appIsInstalled('shoutbox') && strpos($output, '<!--- ShoutBoxJsLoader --->')!==false )
{
$output = preg_replace( "#</head>#", ipsRegistry::getClass('output')->getTemplate('shoutbox_hooks')->shoutboxJavascript() . "</head>\r\n", $output, 1 );
}
return $output;
}
}
