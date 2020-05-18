<?php
/**
 * @package		mod_show_event_list for Standard Squadron Site Project 
 * @subpackage	Helper Module - Obtains Event Records  
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('USPS.tableAccess');
jimport('USPS.tableVHQAB');
jimport('USPS.includes.routines');
class mod_show_officer_helper
{
	static function getOfficerData($squad_no = ''){
	$vhqab = JoeFactory::getLibrary("USPSd5tableVHQAB");
	$squad_no = sprintf("%04d",$squad_no);
	$search = "(jobcode like '3_000' ";
	//$search .= "or jobcode = '32700' ";		// Vessel Examiner Chair
	//$search .= "or jobcode = '34100' ";		// Chair Boating Activities
	$search .= "or jobcode = '34500' ";
	//$search .= "or jobcode = '35300' ";
	//$search .= "or jobcode = '35500' ";
	//$search .= "or jobcode = '35650' ";
	//$search .= "or jobcode = '35700' ";
	$search .= "or jobcode = '35610' ";
	//$search .= "or jobcode = '31610' ";		// Imediate Past Commander
	$search .= ") ";
	$search .= "and account = $squad_no ";
	// $search .= "and year = '$year' ";
	$list = $vhqab->sjftp->search_records_in_order($search,'jobcode');
	foreach ($list as $job){
		$job['desc'] = $vhqab->sjdesc->get_record('jobcode',$job['jobcode']);
		$job['mbr_name'] = $vhqab->getMemberNameAndRank($job['certno'],false);
		//$job['mbr_address'] = $vhqab->getMemberAddress($job['certno']);
		$job['email']=$vhqab->getMemberEmail($job['certno']);
		$job['telephone']=$vhqab->getMemberTelephone($job['certno']);
		$jobs[$job['jobcode']] = $job;	
		
	}
	$vhqab->close();
	return $jobs;
	/*		
		$vhqab = JoeFactory::getLibrary("USPSd5tableVHQAB");
		$query = 'start_date >= curdate() and "squad_no='$squad_no'";
		$evts = $vhqab->events->search_records_in_order($query,'start_date'); 
		foreach($evts as &$evt){
			$evt['location'] = $vhqab->get_location_data($evt['location_id']);
			$evt['full_name'] = $vhqab->getMemberNameAndRank($evt['poc_id']);
		}	
		return $evts;
	*/	
	}
}
