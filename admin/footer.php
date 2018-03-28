<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 footer.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
if(isset($templateMain)) {
	$GLOBALS['xoopsTpl']->assign('maintainedby', $wggallery->getConfig('maintainedby'));
	$GLOBALS['xoopsTpl']->display("db:{$templateMain}");
}

xoops_cp_footer();
