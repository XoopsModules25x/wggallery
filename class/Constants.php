<?php namespace XoopsModules\Wggallery;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

//defined('XOOPS_ROOT_PATH') || die('Restricted access';

/**
 * class Constants
 */
class Constants
{
    /**#@+
     * Constant definition
     */

    // common constants
    // constants for state
    const WGGALLERY_STATE_OFFLINE_VAL  = 0;
    const WGGALLERY_STATE_ONLINE_VAL   = 1;
    const WGGALLERY_STATE_APPROVAL_VAL = 2;
    // constants for image size
    const WGGALLERY_IMAGE_THUMB  = 0;
    const WGGALLERY_IMAGE_MEDIUM = 1;
    const WGGALLERY_IMAGE_LARGE  = 2;
    // constants for album image cat
    const WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL = 1;
    const WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED  = 2;
    // const WGGALLERY_ALBUM_IMGCAT_USE_GRID =      3;
    //constants for jssor
    const WGGALLERY_OPTION_GT_SLIDERTYPE_1_VAL = 1;
    const WGGALLERY_OPTION_GT_SLIDERTYPE_2_VAL = 2;
    // const WGGALLERY_OPTION_GT_SLIDERTYPE_3_VAL = 3;
    // constants for watermarks
    const WGGALLERY_WATERMARK_TYPETEXT        = 1;
    const WGGALLERY_WATERMARK_TYPEIMAGE       = 2;
    const WGGALLERY_WATERMARK_POSTOPLEFT      = 1;
    const WGGALLERY_WATERMARK_POSTOPRIGHT     = 2;
    const WGGALLERY_WATERMARK_POSTOPCENTER    = 3;
    const WGGALLERY_WATERMARK_POSMIDDLELEFT   = 4;
    const WGGALLERY_WATERMARK_POSMIDDLERIGHT  = 5;
    const WGGALLERY_WATERMARK_POSMIDDLECENTER = 6;
    const WGGALLERY_WATERMARK_POSBOTTOMLEFT   = 7;
    const WGGALLERY_WATERMARK_POSBOTTOMRIGHT  = 8;
    const WGGALLERY_WATERMARK_POSBOTTOMCENTER = 9;
    const WGGALLERY_WATERMARK_USAGENONE       = 0;
    const WGGALLERY_WATERMARK_USAGEALL        = 1;
    const WGGALLERY_WATERMARK_USAGESINGLE     = 2;
    const WGGALLERY_WATERMARK_TARGET_A        = 0;
    const WGGALLERY_WATERMARK_TARGET_M        = 1;
    const WGGALLERY_WATERMARK_TARGET_L        = 2;

    /**#@-*/
}

