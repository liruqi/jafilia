<?php defined( '_JEXEC' ) or die( '=;)' ); 
include( JPATH_ADMINISTRATOR.DS."components".DS."com_jafilia".DS."helpers".DS."version.php" );
$JAFVERSION =& new jafVersion();
$shortversion = $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. "" . $JAFVERSION->REVISION;
?>
<!--- NAME: footer.tpl --->

<center><div id="jaf_footer">
Copyright &copy; 2008-<?php echo date("Y"); ?> <a href="http://www.jafilia.com" target="_blank" title="Free Affiliate Component for Joomla! and VirtueMart"><?php echo JText::_('JAF_COM_TITLE'); ?></a> - Version: <?php echo $shortversion; ?>. All Rights Reserved. 
</div></center>

<!--- END: footer.tpl --->