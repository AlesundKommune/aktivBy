<?php
  /**************************************************************************\
  * phpGroupWare - User manual                                               *
  * http://www.phpgroupware.org                                              *
  * --------------------------------------------                             *
  *  This program is free software; you can redistribute it and/or modify it *
  *  under the terms of the GNU General Public License as published by the   *
  *  Free Software Foundation; either version 2 of the License, or (at your  *
  *  option) any later version.                                              *
  \**************************************************************************/

	/* $Id: index.php 690 2008-02-02 10:11:33Z dave $ */

	$phpgw_flags = Array(
		'currentapp'	=> 'manual',
		'admin_header'	=> True
	);
	$phpgw_info['flags'] = $phpgw_flags;
	include('../../header.inc.php');
	$appname = 'admin';
	include(PHPGW_SERVER_ROOT.'/'.$appname.'/setup/setup.inc.php');
?>
<img src="<?php echo $phpgw->common->image($appname,'navbar.gif'); ?>" border="0"><p/>
<font face="<?php echo $phpgw_info['theme']['font']; ?>" size="2">
Version: <b><?php echo $setup_info[$appname]['version']; ?></b>
</font>
