<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * @version $Id: header.php 789 2009-01-26 15:56:03Z elkuku $
 * @package    Jafilia
 * @subpackage
 * @author     EasyJoomla {@link http://www.easy-joomla.org Easy-Joomla.org}
 * @author     Arkadiusz Maniecki {@link http://www.jafilia.pl}
 * @author     Created on 08-Apr-2009
 */
//--No direct access
/**
 * Main installer
 Update Log

    * Frontend files successfully extracted.
    * Frontend archive file successfully deleted.
    * Backend files successfully extracted.
    * Backend archive file successfully deleted.
    * The sample data was installed successfully.
 */
function com_install() {
	$errors = FALSE;
	//global $mosConfig_absolute_path, $mosConfig_dbprefix, $database;
	global $mosConfig_absolute_path, $mosConfig_dbprefix, $database, 
		$JAFVERSION, $myVersion, $shortversion, $version_info;
	include( "helpers/version.php" );
	if( !isset( $shortversion )) {
		$shortversion = $JAFVERSION->PRODUCT . " " . $JAFVERSION->RELEASE . " " . $JAFVERSION->DEV_STATUS. " ";
		$myVersion = $shortversion . " [".$JAFVERSION->CODENAME ."] <br />" . $JAFVERSION->RELDATE . " "
					. $JAFVERSION->RELTIME . " " . $JAFVERSION->RELTZ;
	}
	// Check for old Tables. When they exist, offer an Upgrade
	if( is_null( $database ) && class_exists('jfactory')) {
		$database = JFactory::getDBO();
	}
	$database->setQuery( "SHOW TABLES LIKE 'jos_jafilia_%'" ); //to do
	$pshop_tables = $database->loadObjectList();
	
	if( !empty( $pshop_tables )) {	//istnieja tablice
		//echo 'sa tablice';
		$installation = "wantnewornot";
	}
	else {	//nie ma tablic
		//echo 'nie ma tablic';
		$installation = "newtables";
		//include_once( $admin_dir."/sql/sql.new.jafilia.1.5.0.php" );
		include_once( "sql/sql.new.jafilia.1.5.0.php" );
	}
	?>
	<link rel="stylesheet" href="components/com_jafilia/install.css" type="text/css" />
	<div align="center">
		<table width="100%" border="0">
			<tr>
				<td valign="middle" align="center">
					<div id="ctr" align="center">
						<div class="install">
							<div id="right">
								<div id="step">Welcome to <?php echo $shortversion; ?></div>			
								<div class="clr"></div>
								<pre></pre>
								<h1>The first step of the Installation was <font color="green">SUCCESSFUL</font></h1>
								<table>
								<?php
								if( $installation == "newtables" ) { ?>
									<tr>
										<td colspan="3" class="error">Installation was succesful, but to get Jafilia working, <br>you must complete a couple easy hacks to your Joomla / Virtuemart installation described below.
										You can find the hack instructions also on <a href="index.php?option=com_jafilia&controller=help">Jafilia->Help</a> page.
										</td>
									</tr>
									<tr>
										<td width="40%">You can use Jafilia clicked on a link below.<br/></td>
										<td width="20%">&nbsp;</td>
										<td width="40%">You can install some Sample Data now.
										</td>
									</tr>
									<tr>
										<td width="40%">
											<a title="Go directly to the Jafilia &gt;&gt;" class="button" href="index.php?option=com_jafilia">Go directly to the Jafilia &gt;&gt;</a>
										</td>
										<td width="20%">&nbsp;</td>
										<td width="40%">
											<a class="button" title="Install SAMPLE DATA &gt;&gt;" href="index.php?option=com_jafilia&install_type=3">Install SAMPLE DATA &gt;&gt;</a>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><br /><br /><hr /><br /></td>
									</tr>
									<?php 
								}
								elseif( $installation == 'wantnewornot' ) { 
								?>
										<td colspan="3" class="error">The Installation script has found out that you've already installed Jafilia Tables, so let's decide what to do:</td>
									<tr>
									</tr>
									<tr>
										<td align="left" colspan="3">
											<div align="center">
												<a title="Delete old and create new Tables" onclick="return window.confirm('We suggest to make backup before drop the tables.\nDelete old and create new Tables?');" name="Button2" class="button" href="index.php?option=com_jafilia&install_type=2">Delete old and create new Tables &gt;&gt;</a><br /><br />
												<a title="Delete old and create new Tables with Samples" onclick="return window.confirm('We suggest to make backup before drop the tables.\nDelete old and create new Tables?');" name="Button2" class="button" href="index.php?option=com_jafilia&install_type=1">Delete old and create new Tables with Samples &gt;&gt;</a><br /><br />
												<a title="Finish" class="button" href="index.php?option=com_jafilia">Proceed mantaining actual data tables &gt;&gt;</a><br />
											</div><br />											
										</td>
									</tr>
								<?php
								}
								?>
								</table>
							</div>
							<div class="clr"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<?php
	include( "helpers/hackinfo.php" );
	
   if( $errors ) {
      return FALSE;
   }   
   return TRUE;	
}
?>