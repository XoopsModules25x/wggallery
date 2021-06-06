<?php

namespace XoopsModules\Wggallery;

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
 * @license      GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

//\defined('\XOOPS_ROOT_PATH') || die('Restricted access';

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
    const STATE_OFFLINE_VAL = 0;
    const STATE_ONLINE_VAL = 1;
    const STATE_APPROVAL_VAL = 2;
    // constants for perms
    const PERM_SUBMITNONE = 0;
    const PERM_SUBMITALL = 1;
    const PERM_SUBMITOWN = 2;
    const PERM_SUBMITAPPR = 3;
    // constants for image size
    const IMAGE_THUMB = 0;
    const IMAGE_MEDIUM = 1;
    const IMAGE_LARGE = 2;
    const IMAGE_ALL = 3;
    // constants for album image cat
    const ALBUM_IMGCAT_USE_EXIST_VAL = 1;
    const ALBUM_IMGCAT_USE_UPLOADED_VAL = 2;
    // const ALBUM_IMGCAT_USE_GRID =      3;
    //constants for jssor
    const OPTION_GT_SLIDERTYPE_1_VAL = 1;
    const OPTION_GT_SLIDERTYPE_2_VAL = 2;
    // const OPTION_GT_SLIDERTYPE_3_VAL = 3;
    // constants for watermarks
    const WATERMARK_TYPETEXT = 1;
    const WATERMARK_TYPEIMAGE = 2;
    const WATERMARK_POSTOPLEFT = 1;
    const WATERMARK_POSTOPRIGHT = 2;
    const WATERMARK_POSTOPCENTER = 3;
    const WATERMARK_POSMIDDLELEFT = 4;
    const WATERMARK_POSMIDDLERIGHT = 5;
    const WATERMARK_POSMIDDLECENTER = 6;
    const WATERMARK_POSBOTTOMLEFT = 7;
    const WATERMARK_POSBOTTOMRIGHT = 8;
    const WATERMARK_POSBOTTOMCENTER = 9;
    const WATERMARK_USAGENONE = 0;
    const WATERMARK_USAGEALL = 1;
    const WATERMARK_USAGESINGLE = 2;
    const WATERMARK_TARGET_A = 0;
    const WATERMARK_TARGET_M = 1;
    const WATERMARK_TARGET_L = 2;
    // constants for rating
    const RATING_NONE = 0;
    const RATING_5STARS = 1;
    const RATING_10STARS = 2;
    const RATING_LIKES = 3;
    const RATING_10NUM = 4;
    // constants for upload
    const UPLOADER_NONE = 0;
    const UPLOADER_MULTI = 1;
    const UPLOADER_SINGLE = 2;
    const UPLOADER_BOTHMULTI = 3;
    const UPLOADER_BOTHSINGLE = 4;
    // constants for search
    const SEARCH_ACT_DOWNLOADS = 1;
    const SEARCH_ACT_VIEWS = 2;
    const SEARCH_ACT_RATINGS = 3;
    const SEARCH_ACT_VOTES = 4;

}
