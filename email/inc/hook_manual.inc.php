<?php
	/**
	* EMail - Manual hook
	*
	* @author Mark Peters <skeeter@phpgroupware.org>
	* @copyright Copyright (C) 2003-2005 Free Software Foundation, Inc. http://www.fsf.org/
	* @license http://www.gnu.org/licenses/gpl.html GNU General Public License
	* @package email
	* @subpackage hooks
	* @version $Id: hook_manual.inc.php 13901 2015-09-15 09:41:20Z sigurdne $
	*/

	$file = Array(
		'Viewing'	=> 'viewing.php',
		'Replying'	=> 'replying.php',
		'Composing/Saving/Deleting'	=> 'other.php',
		'Notes'		=> 'notes.php'
	);
// Do not modify below this line
	display_manual_section($appname,$file);
