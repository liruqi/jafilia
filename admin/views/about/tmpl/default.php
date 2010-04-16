<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
include( JPATH_COMPONENT.DS."helpers".DS."version.php" );
$JAFVERSION =& new jafVersion();
$shortversion = $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " " . $JAFVERSION->REVISION. " " . $JAFVERSION->BUILD;
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
	<tbody>
		<tr><td colspan="2"><?php echo JText::_('ABOUT'); ?></td></tr>
		<tr><th>Name:</th><td>Jafilia</td></tr>
		<tr><th>Version:</th><td><?php echo $shortversion; ?></td></tr>
		<tr><th>Coded by:</th><td>Arkadiusz Maniecki, Yosu Cadilla</td></tr>
		<tr><th>Contact:</th><td>contact@jafilia.com</td></tr>
		<tr><th>Support:</th><td><?php echo JHTML::_('link', 'http://www.jafilia.com/', 'Jafilia Homepage', 'target="_blank"'); 
		include( JPATH_COMPONENT.DS."helpers".DS."donations.php" ); 
		?></td></tr>
		<tr><th>Copyright:</th><td><?php echo $JAFVERSION->COPYRIGHT; 
		 echo '<br />'.$JAFVERSION->URL; 
		?></td></tr>
		<tr><th>License:</th><td>GNU LESSER GENERAL PUBLIC LICENSE</td></tr>
	</tbody>	
	</table>
	<input type="hidden" name="option" value="com_jafilia" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="controller" value="" />	
</form>	