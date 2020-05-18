<?php
/**
 * @package		mod_show_event_list for Standard Squadron Site Project 
 * @subpackage	trainingonly.php View option for ues on courses and seminars page. 
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
$year = 0;
?>
<form action="
<?php 
	echo JRoute::_('index.php', true, $params->get('usesecure')); 
?>
" method="post" id="login-form">
<!--Rank, Name, Grade-->
<!--<h3 class='text-center'> <?php echo "Events"; ?> </h3>-->
<!--Contact Information-->
<ul class='list-unstyled'>
	<?php
		foreach($events as $event){
			$s_date = $event['start_date'];
			if (substr($s_date,0,4) > $year){
				$year = substr($s_date,0,4);
				echo "<div align='center'><span>$year Events</span></div>";
			}
		$date = get_2_line_date_times($event);
		$name = get_event_name($event);
		$loc = get_event_location($event);
		$contact = $event['full_name'];
	?>
		<li> <?php echo $date; ?></li>
		<li> <?php echo $name; ?></li>
		<ul class='list-unstyled'>
			<li> <?php echo $loc; ?> </li>
			<li> <?php echo $contact; ?> </li>
		</ul>
	<?php } ?>
</ul>
</form>