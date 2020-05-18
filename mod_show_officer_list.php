<?php
/**
 * @package		mod_show_event_list for Standard Squadron Site Project 
 * @subpackage	Main mod_show_event_list Module 
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('USPS.includes.routines');
$session = JFactory::getSession();
$squad_no = $session->get("squad_no");
// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';
$params->def('greeting', 1);
$officers = mod_show_officer_helper::getOfficerData($squad_no);
require JModuleHelper::getLayoutPath('mod_show_officer_list', $params->get('layout', 'default'));
