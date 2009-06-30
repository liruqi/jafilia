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
 * Main installer
 */

   $errors = FALSE;
   $BR = '<br />';

   //--install...
   $db = & JFactory::getDBO();
   
//insert default or/and example data

   $query = "INSERT INTO `#__jafilia_banner` (`title`,`version`,`text`,`published`)
VALUES
('Text link example', 'text', 'Your first Jafilia affiliate link :)',1);";

   $db->setQuery($query);
   if( ! $db->query() )
   {
      echo $img_ERROR.JText::_('Unable to insert samples').$BR;
      echo $db->getErrorMsg();
      return FALSE;
   }
   
?>