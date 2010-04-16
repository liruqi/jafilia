<?php
defined( '_JEXEC' ) or die( '=;)' );
JHTML::_('behavior.tooltip');
$ikonka = JHTML::_('tooltip', JText::_('JAF_TOOL_UPLOAD'), JText::_('JAF_INFO'), 'tooltip.png');
$ttitle = $this->Links->title;
$ttext = $this->Links->text;
$timg = $this->Links->image;
$tpub = $this->Links->published;
if ($tpub) $jspub = 'pu1.checked = true;'; else $jspub = 'pu2.checked = true;';  
?>
<script type="text/javascript">	
function filform(x) {
	var targetDiv = document.getElementById('titlediv');
	var targetDiv2 = document.getElementById('textdiv');
	var vv1 = document.getElementById('ver1');
	var vv2 = document.getElementById('ver2');	
	var pu1 = document.getElementById('pub1');
	var pu2 = document.getElementById('pub2');
	targetDiv.innerHTML = '';
	targetDiv2.innerHTML = '';
	switch (x) {
		case 1:
		vv1.checked = true;
		<?php echo $jspub; ?>
		targetDiv.innerHTML += '<input class="text_area" type="text" name="title" id="title1" size="52" maxlength="250" value="<?php echo $ttitle?>" />';
		targetDiv2.innerHTML += '<input class="text_area" type="text" name="text" id="text1" size="62" maxlength="250" value="<?php echo $ttext?>" />';
		break;	
		case 2:
		vv2.checked = true;
		<?php echo $jspub; ?>
		targetDiv.innerHTML += '<input class="text_area" type="text" name="title" id="title1" size="52" maxlength="250" value="<?php echo $ttitle; ?>" />';
		targetDiv2.innerHTML += '<label for="image">'
		+'<?=$ikonka?>'
		+'</label>'			
		+'<input class="text_area" id="image" name="image" type="file" size="30" /> '
		+'<input class="text_area" type="text" name="oldimage" readonly id="oldimage" size="32" maxlength="250" value="<?php echo $timg?>" />';
		break;	
		default:
		vv1.checked = true;
		pu1.checked = true;
		targetDiv.innerHTML += '<input class="text_area" type="text" name="title" id="title1" size="52" maxlength="250" value="" />';
		targetDiv2.innerHTML += '<input class="text_area" type="text" name="text" id="text1" size="62" maxlength="250" value="" />';	
		break;
	}
}
function klik(z) {
	filform(z);
}
</script>	
<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable" style="width:99%;border:1px solid #ddd;">
		<tr>
			<th align="right" class="key" style="width:100px;">		
				<?php echo JText::_( 'JAF_VERSION' ); ?><br /><i><?php echo JText::_( 'JAF_SELECT' ); ?></i>
			</th>			
			<th align="right" class="key" style="width:100px;">		
				<?php echo JText::_( 'Published' ); ?><br />
			</th>
			<th align="right" class="key">
				<?php echo JText::_( 'Title' ); ?>:
			</th>
			<th align="right" class="key">
				<?php /*echo JText::_( 'Text' );*/ ?><?php echo JText::_( 'Banner' ); ?>:
			</th>
		</tr>
		<tr>
			<td align="right" class="key">		
				 <?php echo JText::_( 'JAF_TLINK' ); ?> <input type="radio" name="version" id="ver1" value="text" onClick="javascript:klik(1)"><br />
				 <?php echo JText::_( 'JAF_BLINK' ); ?> <input type="radio" name="version" id="ver2" value="banner" onClick="javascript:klik(2)"> 
			</td>			
			<td align="right" class="key">		
				 <?php echo JText::_( 'YES' ); ?> <input type="radio" name="published" id="pub1" value="1" ><br />
				 <?php echo JText::_( 'NO' ); ?> <input type="radio" name="published" id="pub2" value="0" > 
			</td>
			<td align="right" class="key">
				<div id="titlediv"></div>
			</td>
			<td align="right" class="key">	
				<div id="textdiv"></div>
			</td>
		</tr>	
<?php
//echo $this->Links->version;
$affver = $this->Links->version;
switch ($affver) {
	case "text":
		echo'<script type="text/javascript">filform(1)</script>';	
	break;	
	case "banner":
		echo'<script type="text/javascript">filform(2)</script>';	
	break;	
	default:
		echo'<script type="text/javascript">filform(0)</script>';	
	break;
}
?>	
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="id" value="<?php echo $this->Links->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="links" />
</form>