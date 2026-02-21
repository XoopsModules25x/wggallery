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
    const int STATE_OFFLINE_VAL = 0;
    const int STATE_ONLINE_VAL = 1;
    const int STATE_APPROVAL_VAL = 2;
    // constants for perms
    const int PERM_SUBMITNONE = 0;
    const int PERM_SUBMITALL = 1;
    const int PERM_SUBMITOWN = 2;
    const int PERM_SUBMITAPPR = 3;
    // constants for image size
    const int IMAGE_THUMB = 0;
    const int IMAGE_MEDIUM = 1;
    const int IMAGE_LARGE = 2;
    const int IMAGE_ALL = 3;
    // constants for album image cat
    const int ALBUM_IMGCAT_USE_EXIST_VAL = 1;
    const int ALBUM_IMGCAT_USE_UPLOADED_VAL = 2;
    // const ALBUM_IMGCAT_USE_GRID =      3;
    //constants for jssor
    const int OPTION_GT_SLIDERTYPE_1_VAL = 1;
    const int OPTION_GT_SLIDERTYPE_2_VAL = 2;
    // const OPTION_GT_SLIDERTYPE_3_VAL = 3;
    // constants for watermarks
    const int WATERMARK_TYPETEXT = 1;
    const int WATERMARK_TYPEIMAGE = 2;
    const int WATERMARK_POSTOPLEFT = 1;
    const int WATERMARK_POSTOPRIGHT = 2;
    const int WATERMARK_POSTOPCENTER = 3;
    const int WATERMARK_POSMIDDLELEFT = 4;
    const int WATERMARK_POSMIDDLERIGHT = 5;
    const int WATERMARK_POSMIDDLECENTER = 6;
    const int WATERMARK_POSBOTTOMLEFT = 7;
    const int WATERMARK_POSBOTTOMRIGHT = 8;
    const int WATERMARK_POSBOTTOMCENTER = 9;
    const int WATERMARK_USAGENONE = 0;
    const int WATERMARK_USAGEALL = 1;
    const int WATERMARK_USAGESINGLE = 2;
    const int WATERMARK_TARGET_A = 0;
    const int WATERMARK_TARGET_M = 1;
    const int WATERMARK_TARGET_L = 2;
    // constants for rating
    const int RATING_NONE = 0;
    const int RATING_5STARS = 1;
    const int RATING_10STARS = 2;
    const int RATING_LIKES = 3;
    const int RATING_10NUM = 4;
    // constants for upload
    const int UPLOADER_NONE = 0;
    const int UPLOADER_MULTI = 1;
    const int UPLOADER_SINGLE = 2;
    const int UPLOADER_BOTHMULTI = 3;
    const int UPLOADER_BOTHSINGLE = 4;
    // constants for search
    const int SEARCH_ACT_DOWNLOADS = 1;
    const int SEARCH_ACT_VIEWS = 2;
    const int SEARCH_ACT_RATINGS = 3;
    const int SEARCH_ACT_VOTES = 4;
    // constants for image name at upload
    const int IMAGENAME_UNIQUE   = 0;
    const int IMAGENAME_ORIGINAL = 1;
    // constants for sorting
    const int SORT_BY_NAME       = 1;
    const int SORT_BY_DATEUPLOAD = 2;
}
