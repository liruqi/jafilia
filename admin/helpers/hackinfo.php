<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
?>
<style>
pre {
color:#333;

font-family:Tahoma,  Arial, Courier;
font-size:11px;
}
.codeform {
color:#000;
font-family:Courier, Tahoma, Arial;
font-size:11px;
margin:10px 0px;
padding:0px 10px 5px 10px;
background:#ffffce;
border:1px solid #777;
}
#jflogo {
background: url(../media/com_jafilia/images/jafilia-logo48x48.png) no-repeat;
background-position:left 20px;
padding-left:60px;
}
</style>	
<table width="99%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>
	<pre>
<div id="jflogo">
<strong>Jafilia 1.5 BETA. Affiliate networking component for Joomla 1.5.x</strong>

Hi fellow marketeer, thank you for testing Jafilia. <br>With your help we will make it stable and reliable, but for now, <br>remember this is first beta and DO NOT use this release in production sites ;-)
</div>	

First of all: <br>Thank you and congratulations to Arkadiusz Maniecki and QuarkBit Software <a target="_blank" href="http://www.webwizard.pl/en/" >http://www.webwizard.pl/en/</a> <br>for this great piece of software, we where all waiting this release with much expectation. <br>We will make our best untill everyone is happy with this new version.

Whatever bug, opinion or ideas you have about it please post it in the Jafilia.com forums <br>under the newly created post for this beta release:
<a target="_blank" href="http://www.jafilia.com/index.php/forum?func=showcat&catid=2" >http://www.jafilia.com/index.php/forum?func=showcat&catid=2</a>

-------------------------------------------------------------------
READ THIS BEFORE YOU CONTINUE
-------------------------------------------------------------------

Installation was succesful, but to get Jafilia working, <br>you must complete a couple easy hacks to your Joomla / Virtuemart installation.


-------------------------------------------------------------------
First hack
-------------------------------------------------------------------

open the file ps_checkout.php, located at:
<strong>/your_site_root/administrator/components/com_virtuemart/classes/ps_checkout.php</strong>

Go to line 998 and search for the following code:

<div class="codeform">
<code>
$d["order_id"] = $order_id = $db->last_insert_id();
if( $result === false || empty( $order_id )) {
$vmLogger->crit( 'Adding the Order into the Database failed! User ID: '.$auth["user_id"] );
return false;
}
</code>
</div>
Insert the following code rigth after it:
<div class="codeform">
<code>
###### Jafilia 1.5 Hack ######

$dbj = &JFactory::getDbo();
$path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jafilia'.DS.'config.jafilia.php';
include($path); 

if(isset($_COOKIE['cook_jaffiliate']) && $jafversion == 'sale' || $jafversion == 'lead') {
$aff = $_COOKIE['cook_jaffiliate'];

if($jafversion == 'sale') $sale = round(($order_subtotal/100)*$jafsale,2);
if($jafversion == 'lead') $sale = $jaflead;

$date = date('Y-m-d H:i:s');

$affiliate = array(
'uid' => $aff,
'version' => $jafversion,
'order' => $order_id,
'sale' => $sale,
'status' => 'open',
'date' => $date
);

$dbj->buildQuery( 'INSERT', '#__jafilia_sales', $affiliate );
$affisale = $dbj->query();

if(!$affisale) echo "<br>ERROR Saving _jafilia_sales!<br>";

}

###### End Jafilia 1.5 Hack ######
</code>
</div>

-------------------------------------------------------------------
Second hack
-------------------------------------------------------------------

Open the index.php of your Joomla! template probably located at:

<strong>/your_site_root/templates/your_default_template/index.php</strong>
for example: /myweb/templates/ja_purity/index.php, that is, if purity is your default template.

Now you have to look for the following line in your index.php file:
<div class="codeform">
<code>
&lt;?php defined( '_JEXEC' ) or die( 'Restricted access' );
</code>
</div>

And finally, rigth after this line, insert the following piece of code:
<div class="codeform">
<code>
###### Jafilia 1.5 Hack ######

//include the affiliate handler
include('components'.DS.'com_jafilia'.DS.'jafilia.inc.php');

###### End Jafilia 1.5 Hack ######
</code>
</div>
<strong>That`s it!. Jafilia beta is now ready for testing.</strong> <br>We are looking forward to remoove the need for these manual hacks

If you have any problems, ideas or questions, please post it in the Jafilia.com site forums, <br>we just created a new "Jafilia 1.5 BETA test" forum at:
<a target="_blank" href="http://www.jafilia.com/index.php/forum?func=showcat&catid=2">http://www.jafilia.com/index.php/forum?func=showcat&catid=2</a>

Thank you for testing, and enjoy!	
</pre>	
	</td>
  </tr>
</table>	
