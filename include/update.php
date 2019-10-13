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
 * @param mixed      $module
 * @param null|mixed $prev_version
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 update.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
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
    if ($prev_version < 108) {
        $ret = update_wggallery_v108($module);
    }
    if ($prev_version < 109) {
        $ret = update_wggallery_v109($module);
    }
    if ($prev_version < 112) {
        $ret = update_wggallery_v112($module);
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
    $result = $xoopsDB->query('SELECT t1.tpl_id FROM '
                              . $xoopsDB->prefix('tplfile')
                              . ' t1, '
                              . $xoopsDB->prefix('tplfile')
                              . ' t2 WHERE t1.tpl_refid = t2.tpl_refid AND t1.tpl_module = t2.tpl_module AND t1.tpl_tplset=t2.tpl_tplset AND t1.tpl_file = t2.tpl_file AND t1.tpl_type = t2.tpl_type AND t1.tpl_id > t2.tpl_id');
    $tplids = [];
    while (false !== (list($tplid) = $xoopsDB->fetchRow($result))) {
        $tplids[] = $tplid;
    }
    if (count($tplids) > 0) {
        $tplfileHandler  = xoops_getHandler('tplfile');
        $duplicate_files = $tplfileHandler->getObjects(new \Criteria('tpl_id', '(' . implode(',', $tplids) . ')', 'IN'));

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
    $ret = [];
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[] = $myrow;
    }
    if (!empty($ret)) {
        $module->setErrors("'tpl_refid_module_set_file_type' unique index is exist. Note: check 'tplfile' table to be sure this index is UNIQUE because XOOPS CORE need it.");

        return true;
    }
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tplfile') . ' ADD UNIQUE tpl_refid_module_set_file_type ( tpl_refid, tpl_module, tpl_tplset, tpl_file, tpl_type )';
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br>' . $sql);
        $module->setErrors("'tpl_refid_module_set_file_type' unique index is not added to 'tplfile' table. Warning: do not use XOOPS until you add this unique index.");

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
function update_wggallery_v108(&$module)
{
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_images') . '` ADD `img_exif` TEXT NULL AFTER `img_state` ;';
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'img_exif' to table 'wggallery_images'.");

        return false;
    }

    return true;
}

/**
 * @param $module
 *
 * @return bool
 */
function update_wggallery_v109(&$module)
{
    // Making of temp images folder
    $indexFile = XOOPS_UPLOAD_PATH . '/index.html';
    $blankFile = XOOPS_UPLOAD_PATH . '/blank.gif';
    $specimage = XOOPS_UPLOAD_PATH . '/wggallery/images/temp';
    if (!is_dir($specimage)) {
        if (!mkdir($specimage, 0777) && !is_dir($specimage)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $specimage));
        }
        chmod($specimage, 0777);
    }
    copy($indexFile, $specimage . '/index.html');
    copy($blankFile, $specimage . '/blank.gif');

    return true;
}

/**
 * @param $module
 *
 * @return bool
 */
function update_wggallery_v112(&$module)
{
    $ret = true;
    // update table 'wggallery_images'
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_images') . '` ADD `img_cats` TEXT NULL AFTER `img_state` ;';
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'img_cats' to table 'wggallery_images'.");
        $ret = false;
    }
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_images') . '` ADD `img_tags` TEXT NULL AFTER `img_state` ;';
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'img_tags' to table 'wggallery_images'.");
        $ret = false;
    }
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_images') . "` ADD `img_views` INT(1) NOT NULL DEFAULT '0' AFTER `img_votes` ;";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'img_tags' to table 'wggallery_images'.");
        $ret = false;
    }
    
    // update table 'wggallery_albums'
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '` ADD `alb_cats` TEXT NULL AFTER `alb_state` ;';
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'alb_cats' to table 'wggallery_albums'.");
        $ret = false;
    }
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '` ADD `alb_tags` TEXT NULL AFTER `alb_state` ;';
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when adding 'alb_tags' to table 'wggallery_albums'.");
        $ret = false;
    }  
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . "` CHANGE `alb_iscat` `alb_iscoll` INT(1) NOT NULL DEFAULT '0'";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when changing 'alb_iscoll' into 'alb_iscoll' in table 'wggallery_albums'.");
        $ret = false;
    }
    $sql = 'ALTER TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . "` CHANGE `alb_imgcat` `alb_imgtype` INT(1) NOT NULL DEFAULT '0'";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when changing 'alb_iscoll' into 'alb_iscoll' in table 'wggallery_albums'.");
        $ret = false;
    }
    
    // create new table 'wggallery_categories'
    $sql = 'CREATE TABLE `' . $GLOBALS['xoopsDB']->prefix('wggallery_categories') . "` (
              `cat_id`        INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
              `cat_text`      VARCHAR(100)    NOT NULL DEFAULT '',
              `cat_album`     INT(1)          NOT NULL DEFAULT '0',
              `cat_image`     INT(1)          NOT NULL DEFAULT '0',
              `cat_search`    INT(1)          NOT NULL DEFAULT '0',
              `cat_weight`    INT(8)          NOT NULL DEFAULT '0',
              `cat_date`      INT(8)          NOT NULL DEFAULT '0',
              `cat_submitter` INT(8)          NOT NULL DEFAULT '0',
              PRIMARY KEY (`cat_id`)
            ) ENGINE=InnoDB;";
    if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
        xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
        $module->setErrors("Error when changing 'alb_iscoll' into 'alb_iscoll' in table 'wggallery_albums'.");
        $ret = false;
    }
     
    return $ret;
}
