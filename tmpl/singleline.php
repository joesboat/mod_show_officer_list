<?php
/**
 * @package		mod_show_officer_list for Standard Squadron Site Project 
 * @subpackage	default.php  Original view module for displaying the officer list.  
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
<h4 class='text-center'> Squadron Officers </h4>
<!--Contact Information-->
<dl class="dl-horizontal">
<!--
	Each Officer record includes the job description (in 'desc') and member (in 'mbr') record
-->
<?php
	if (! isset($officers['35610']))
		$no_public_officer = true;
	$no_public_officer = ! isset($officers['35610']);
	// Add squadron officers to the list first 
	foreach($officers as $jobcode=>$officer){
		if (substr($jobcode,2,2)!='00') continue;
		if ($jobcode == '34000' and isset($officers['34500'])) continue;
		if ($jobcode == '35000' and isset($officers['35610'])) continue;
		if ($jobcode == '36000') continue;
		$list[] = $officer;
	}
	// Then the squadron committee chairman 
	foreach($officers as $jobcode=>$officer){
		if ($officer['jobcode']=='35610' or
			//$j['jobcode']=='34100' or
			$officer['jobcode']=='34500'
			//$j['jobcode']=='35300' or
			//$j['jobcode']=='32700' 
			)
			$list[] = $officer;
	}
	foreach($list as $officer){
		$is_public_officer = $officer['jobcode'] == '35610';
		$show_this_one = ($no_public_officer or $is_public_officer);
		$jdesc = $officer['desc']['jdesc'];
		if ($show_this_one){
			$name = build_link($officer['mbr_name'],$officer['email'] );
		} else 
			$name = $officer['mbr_name'];	
		$phone = '';
		if ($show_this_one) 
			$phone = $officer['telephone'];
?>
		<dt> <?php echo "<b>$jdesc</b>"; ?></dd>
		<dd> <?php echo "$name <em>$phone</em>"; ?></dd>
		<br/>
<?php 
	} 
?>
	</dl>
</form>