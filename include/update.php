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
 * @version        $Id: 1.0 update.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */
function xoops_module_update_wggallery(&$module, $prev_version = null)
{
    // irmtfan bug fix: solve templates duplicate issue
    $ret = null;
    if ($prev_version < 10) {
        $ret = update_wggallery_v10($module);
    }
    if ($prev_version < 106) {
        $ret = update_wggallery_v105($module);
    }
    $errors = $module->getErrors();
    if (!empty($errors)) {
        print_r($errors);
    }

    return $ret;
    // irmtfan bug fix: solve templates duplicate issue
}
// irmtfan bug fix: solve templates duplicate issue
/**
 * @param $module
 *
 * @return bool
 */
function update_wggallery_v10(&$module)
{
    global $xoopsDB;
    $result = $xoopsDB->query(
        'SELECT t1.tpl_id FROM ' . $xoopsDB->prefix('tplfile') . ' t1, ' . $xoopsDB->prefix('tplfile')
        . ' t2 WHERE t1.tpl_refid = t2.tpl_refid AND t1.tpl_module = t2.tpl_module AND t1.tpl_tplset=t2.tpl_tplset AND t1.tpl_file = t2.tpl_file AND t1.tpl_type = t2.tpl_type AND t1.tpl_id > t2.tpl_id'
    );
    $tplids = array();
    while (list($tplid) = $xoopsDB->fetchRow($result)) {
        $tplids[] = $tplid;
    }
    if (count($tplids) > 0) {
        $tplfileHandler = xoops_getHandler('tplfile');
        $duplicate_files = $tplfileHandler->getObjects(
            new Criteria('tpl_id', '(' . implode(',', $tplids) . ')', 'IN')
        );

        if (count($duplicate_files) > 0) {
            foreach (array_keys($duplicate_files) as $i) {
                $tplfileHandler->delete($duplicate_files[$i]);
            }
        }
    }
    $sql = 'SHOW INDEX FROM ' . $xoopsDB->prefix('tplfile') . " WHERE KEY_NAME = 'tpl_refid_module_set_file_type'";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($this->db->error() . '<br>' . $sql);

        return false;
    }
    $ret = array();
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[] = $myrow;
    }
    if (!empty($ret)) {
        $module->setErrors(
            "'tpl_refid_module_set_file_type' unique index is exist. Note: check 'tplfile' table to be sure this index is UNIQUE because XOOPS CORE need it."
        );

        return true;
    }
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tplfile')
        . ' ADD UNIQUE tpl_refid_module_set_file_type ( tpl_refid, tpl_module, tpl_tplset, tpl_file, tpl_type )';
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br>' . $sql);
        $module->setErrors(
            "'tpl_refid_module_set_file_type' unique index is not added to 'tplfile' table. Warning: do not use XOOPS until you add this unique index."
        );

        return false;
    }

    return true;
}
// irmtfan bug fix: solve templates duplicate issue

/**
 * @param $module
 *
 * @return bool
 */
function update_wggallery_v105(&$module)
{
    // create folder watermarks in uploads
    $indexFile    = XOOPS_UPLOAD_PATH.'/index.html';
    $blankFile    = XOOPS_UPLOAD_PATH.'/blank.gif';
    $imgwatermark = XOOPS_ROOT_PATH.'/modules/wggallery/assets/images/wedega_logo.png';
    $specimage    = XOOPS_UPLOAD_PATH.'/wggallery/images/watermarks';
    if(!is_dir($specimage)) {
        mkdir($specimage, 0777);
        chmod($specimage, 0777);
    }
    copy($indexFile, $specimage.'/index.html');
    copy($blankFile, $specimage.'/blank.gif');
    copy($imgwatermark, $specimage.'/wedega_logo.png');
    $specimage    = XOOPS_UPLOAD_PATH.'/wggallery/images/watermarks-test';
    if(!is_dir($specimage)) {
        mkdir($specimage, 0777);
        chmod($specimage, 0777);
    }
    copy($indexFile, $specimage.'/index.html');
    
    // installing watermark fonts
    $specfonts = XOOPS_UPLOAD_PATH.'/wggallery/fonts';
    if(!is_dir($specfonts)) {
        mkdir($specfonts, 0777);
        chmod($specfonts, 0777);
    }
    copy($indexFile, $specfonts.'/index.html');

    $rep = XOOPS_ROOT_PATH . '/modules/wggallery/assets/fonts/';
    $dir = opendir($rep);
    while ($f = readdir($dir)) {
        if (is_file($rep . $f)) {
            if (preg_match('/.*ttf/', strtolower($f))) {
                copy($rep.$f, $specfonts.'/'.$f);
            }
        }
    }

    // create new field
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . "` ADD `alb_wmid` int(8) NOT NULL DEFAULT '0' AFTER `alb_state`;";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors('error when adding new field alb_wmid to table wggallery_albums');
        return false;
    }
    // create new table wggallery_watermarks
    $sql = 'CREATE TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks') . "` (
              `wm_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
              `wm_name` VARCHAR(100) NOT NULL DEFAULT '',
              `wm_type` INT(8) NOT NULL DEFAULT '0',
              `wm_position` INT(8) NOT NULL DEFAULT '0',
              `wm_marginlr` INT(8) NOT NULL DEFAULT '0',
              `wm_margintb` INT(8) NOT NULL DEFAULT '0',
              `wm_image` VARCHAR(255) NOT NULL DEFAULT '',
              `wm_text` VARCHAR(100) NOT NULL DEFAULT '',
              `wm_font` VARCHAR(255) NOT NULL DEFAULT '',
              `wm_fontsize` INT(8) NOT NULL DEFAULT '0',
              `wm_color` VARCHAR(10) NOT NULL DEFAULT '',
              `wm_usage` INT(1) NOT NULL DEFAULT '0',
              `wm_target` INT(1) NOT NULL DEFAULT '0',
              `wm_date` INT(8) NOT NULL DEFAULT '0',
              `wm_submitter` INT(8) NOT NULL DEFAULT '0',
              PRIMARY KEY (`wm_id`)
            ) ENGINE=InnoDB;";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors('error when creating new table wggallery_watermarks');
        return false;
    }    
    return true;
}