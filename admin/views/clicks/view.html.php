<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.view');
class JafiliaViewClicks extends JView {
   function display($tpl = null) {
		JToolBarHelper::title( JText::_('JAF_COM_TITLE').': '.JText::_('JAF_CLICKS'), 'clicks48.jpg' );		
		JToolBarHelper::back();		
		$this->ClicksList();
		parent::display($tpl);
		include_once(JPATH_COMPONENT.DS.'helpers'.DS.'footer.php');		
	}	   
	function ClicksList() {
		global $mainframe, $option;		
		$items =& $this->get('Data'); 
		$pagination =& $this->get('Pagination');
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
	}   
}
?>