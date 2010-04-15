<?php
defined( '_JEXEC' ) or die( '=;)' );
global $mainframe; 
?>
<div id="main">
	<div id="cpanel" style="width:60%; float: left;">
		<?php echo $this->cpanel_images->config; ?>
		<?php /*echo $this->cpanel_images->campaigns;*/ ?>		
		<?php echo $this->cpanel_images->links; ?>		
		<?php echo $this->cpanel_images->user; ?>		
		<?php echo $this->cpanel_images->clicks; ?>			
		<br class="clear" style="clear:both;" />				
		<?php echo $this->cpanel_images->sales; ?>		
		<?php echo $this->cpanel_images->charts; ?>
		<?php echo $this->cpanel_images->about; ?>
		<?php echo $this->cpanel_images->help; ?>
	</div>
	<div id="jpmodules" style="width:40%; float: left;">
		<?php
			jimport('joomla.html.pane');
			JHTML::_('behavior.mootools');
			$pane =& JPane::getInstance('Sliders');			
			echo $pane->startPane('jpsliders')."\n";			
//////////////
				echo $pane->startPanel(jtext::_('JAF_PAYOUT_REACHED'),'jafpayoutreached')."\n";				
				if(!isset($this->rows))  {
					echo '<p align="center">Payout limit: '. $this->payoutlimit.'<br>'.jtext::_('JAF_NO_PAYOUTS') . '</p>';
				} else {
					foreach($this->rows as $row)  {
					$payoutlnk = 'index.php?option=com_jafilia&controller=user&task=payout&uid='.$row->uid;
						echo '<p align="center">'. $row->firstname . ' ' . $row->lastname . ' :  <a href="'.$payoutlnk.'"><img src="../administrator/components/com_jafilia/images/payout.jpg" height="20" width="20" style="border: none"></a></p>';
					}
				}
				echo $pane->endPanel()."\n";
				/***/
				echo $pane->startPanel(jtext::_('JAF_CHARTS'),'statistics')."\n";
	$db = & JFactory::getDBO();
	/****/
	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_user`'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_user` WHERE published = 1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statu = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statu2 = $db->loadResult(); 

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="text"'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="text" AND published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statb = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statb2 = $db->loadResult(); 

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="banner"'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="banner" AND published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statc = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statc2 = $db->loadResult(); 	

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_campaigns`'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_campaigns` WHERE published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statg = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statg2 = $db->loadResult();
	
echo'<div style="padding:0px 10px;">
<p>
Users: '.$statu2.' / '.$statu.'<br>
Campaigns: '.$statg2.' / '.$statg.' (to do)<br>
Banners: '.$statc2.' / '.$statc.'<br>
Links: '.$statb2.' / '.$statb.'
</p>
</div>
';

				echo $pane->endPanel()."\n";
				/***/
				echo $pane->startPanel(jtext::_('JAF_TRANSLATION_CREDITS'),'translationcredits')."\n";
		?>		
		<p style="text-align:center;">
		<strong><?php echo JText::_('JAF_TRANSLATION_LANGUAGE') ?></strong><br/>
		<a href="<?php echo JText::_('JAF_TRANSLATION_AUTHOR_URL') ?>" target="_blank"><?php echo JText::_('JAF_TRANSLATION_AUTHOR') ?></a>
		</p>
		<?php 
				echo $pane->endPanel()."\n";	
///////////////			
			echo $pane->endPane()."\n";
		?>
	</div>	
</div>
<div style="clear: both;"></div>
<div style="text-align:center;">
<?php
$lang =& JFactory::getLanguage();
$langTag = $lang->getTag();
switch ($langTag) {
	case "pl-PL" :
?>
	<table width="350" border="0" cellspacing="1" cellpadding="1">
	<tr>
	<td align="center">
	Wspomóż rozwój polskiej społeczności Jafilia. <br>Ułatwi nam to pracę nad rozwojem komponentu oraz nieodpłatne zapewnienie wsparcia technicznego.	<br>
	Dziękujemy Jafilia.webwizard.pl.
	<br><br> 
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
	">
	<input type="image" src="https://www.paypal.com/pl_PL/PL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - Wygodne i bezpieczne płatności internetowe!">
	<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
	</form>
	</td>
	</tr>
	</table>
<?php	
	break;	
	default:
?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_donations">
	<input type="hidden" name="business" value="yc@bizboost.es">
	<input type="hidden" name="item_name" value="Donate to Jafilia">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="cn" value="Notes">
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="tax" value="0">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="bn" value="PP-DonationsBF">
	<input type="image" src="https://www.paypal.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
	</form>
<?php	
	break;
}
?>
</div>
<br style="clear:both;" />
