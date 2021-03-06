<?php
defined( '_JEXEC' ) or die( '=;)' );
jimport( 'joomla.application.component.model' );
class JafiliaModelSales extends JModel
{
	var $_data;
	var $_total = null;
	var $_pagination = null;
	
	function __construct()	{
	 	parent::__construct();	
		global $mainframe, $option;	
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');	
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);	
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		//eee
		$array = JRequest::getVar('cid',  0, '', 'array');
        $this->setId((int)$array[0]);
	}//function
	function setId($id) { ///eeeeee
      // Set id and wipe data
      $this->_id     = $id;
      $this->_data   = null;
   }//function
   function &getData2() //eeeeeeeeeeeeeee
   {
      // Load the data
      if (empty( $this->_data )) {
         $query = ' SELECT * FROM #__jafilia_sales '.
               '  WHERE id = '.$this->_id;
         $this->_db->setQuery( $query );
         $this->_data = $this->_db->loadObject();
      }
      if (!$this->_data) {
         $this->_data = new stdClass();
         $this->_data->id = 0;
         $this->_data->uid = null;
         $this->_data->version = null;
         $this->_data->order = null;
		 $this->_data->sale = null;
		 $this->_data->status = null;		 
		 $this->_data->date = null;
		 $this->_data->paid = null;
         //$this->_data->image = null;
         //$this->_data->published = 0;
      }
      return $this->_data;
   }   
	function UpdVMStatus() {
		/*
			P  	Pending
			C 	Confirmed
			X 	Cancelled
			R 	Refunded
			S 	Shipped	
		*/
		$db = &JFactory::getDbo();
		$db2 = &JFactory::getDbo();
		$db3 = &JFactory::getDbo();
		$query="SELECT * FROM #__jafilia_sales WHERE version='sale'";
		$db->setQuery($query);						
		$rows = $db->loadObjectList();
		foreach ($rows as $row)	{
			$query2="SELECT order_status FROM #__vm_orders WHERE order_id=".$row->order." LIMIT 1";	//order_status
			$db2->setQuery($query2);						
			$rsta = $db2->loadResult();
			//echo"<hr>".$row->order." - ".$rsta." = ".$row->status;
			switch ($rsta) {
				case "P":
				if ($row->status!="open") {
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'open\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
				case "C":
				if ($row->status!="approved") {
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'approved\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
				case "X":
				if ($row->status!="canceled") {
				//$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'canceled\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//$sql = "UPDATE #__jafilia_sales SET status='canceled' WHERE 'order'=".$row->order.""; 
				$sql = 'UPDATE `#__jafilia_sales` SET `status` = \'canceled\' WHERE `order` = '.$row->order.' LIMIT 1;'; 
				//echo"<hr>".$sql;
				$db3->setQuery($sql);
					if (!$db3->query()) {
					//echo'nie zapisano zmiany';
					}
					//else echo 'zapisano';
				}
				break;
			}
		}
	}   
	function _buildQuery()	{
		$query = ' SELECT * FROM #__jafilia_sales ';			
		return $query;
	}
	function getData()	{
		if (empty( $this->_data ))	{
			$this->UpdVMStatus();
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_data;
	}//function
	function getTotal()	{
		if (empty($this->_total))	{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);	
		}
		return $this->_total;
	}//function
	function getPagination()  {
 	// Load the content if it doesn't already exist
 	if (empty($this->_pagination))
 	{
 	    jimport('joomla.html.pagination');
 	    $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
 	}
 	return $this->_pagination;
  }//function
   function store()   {      ///eeeeeeeeeeee
      $row =& $this->getTable();
      $data = JRequest::get( 'post' );
      if (!$row->bind($data)) {
         $this->setError($this->_db->stderr());
         return false;
      }
      if (!$row->check()) {
         $this->setError($this->_db->stderr());
         return false;
      }
      if (!$row->store()) {
         $this->setError( $row->getError() );
         return false;
      }
      return true;
   }//function  
/*   
   function delete()   {  ///eeeeeeeeeeee
      $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
      $row =& $this->getTable();
      if (count( $cids )) {
         foreach($cids as $cid) {
            if (!$row->delete( $cid )) {
               $this->setError( $row->getError() );
               return false;
            }
         }//foreach
      }
      return true;
   }//function  
*/   
/*   
   function payout()   {
		//global $user;
		$path = JPATH_COMPONENT.DS.'helpers'.DS.'jafilia.class.php';
		include($path);
		$id = intval($_GET['uid']);

		$user = new cluserdata($id);	
		$user->doPayOut($id);   
   
   }
*/
/*   
	function publish($cid = array(), $publish = 1) {   ///eeeeeeeeeeee
	      if (count( $cid )) {
	         JArrayHelper::toInteger($cid);
	         $cids = implode( ',', $cid );
	         $query = 'UPDATE #__jafilia_sales'
	            . ' SET published = '.(int) $publish
	            . ' WHERE id IN ( '.$cids.' )'
	         ;
	         $this->_db->setQuery( $query );
	         if (!$this->_db->query()) {
	            $this->setError($this->_db->getErrorMsg());
	            return false;
	         }
	      }
	      return true;
	}    
*/	
}// class
?>