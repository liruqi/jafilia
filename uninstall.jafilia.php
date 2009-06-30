<?php
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */

//--No direct access
defined( '_JEXEC' ) or die( '=;)' );

/**
 * The main uninstaller function
 */
function com_uninstall()
{
	$errors = FALSE;
	
	//-- common images
	$img_OK = '<img src="images/publish_g.png" />';
	$img_WARN = '<img src="images/publish_y.png" />';
	$img_ERROR = '<img src="images/publish_r.png" />';
	$BR = '<br />';

	//--uninstall...

	$db = & JFactory::getDBO();

	$query = "DROP TABLE IF EXISTS `#__jafilia`;";
	$db->setQuery($query);
	if( ! $db->query() )
	{
		echo $img_ERROR.JText::_('Unable to delete table').$BR;
		echo $db->getErrorMsg();
		return FALSE;
	}

	if( $errors )
	{
		return FALSE;
	}
	
	return TRUE;
}// function
