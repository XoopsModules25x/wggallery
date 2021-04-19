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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 rss.php 1 Mon 2018-03-19 10:04:55Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

$cid = Request::getInt('cid', 0, 'GET');
require_once \XOOPS_ROOT_PATH . '/class/template.php';
if (\function_exists('mb_http_output')) {
    mb_http_output('pass');
}
//header ('Content-Type:text/xml; charset=UTF-8');
//$helper->getConfig('utf8') = false;
$xoopsModuleConfig['utf8'] = false;

$tpl          = new \XoopsTpl();
$tpl->caching = 2; //1 = Cache global, 2 = Cache individual (for template)
$tpl->xoops_setCacheTime($helper->geConfig('timecacherss') * 60); // Time of the cache on seconds
$categories = wggalleryMyGetItemIds('wggallery_view', 'wggallery');
$criteria   = new \CriteriaCompo();

$criteria->add(new \Criteria('cat_status', 0, '!='));
$criteria->add(new \Criteria('cid', '(' . \implode(',', $categories) . ')', 'IN'));
if (0 != $cid) {
    $criteria->add(new \Criteria('cid', $cid));
    $images = $imagesHandler->get($cid);
    $title  = $xoopsConfig['sitename'] . ' - ' . $xoopsModule->getVar('name') . ' - ' . $images->getVar('img_ip');
} else {
    $title = $xoopsConfig['sitename'] . ' - ' . $xoopsModule->getVar('name');
}
$criteria->setLimit($helper->geConfig('perpagerss'));
$criteria->setSort('date');
$criteria->setOrder('DESC');
$imagesArr = $imagesHandler->getAll($criteria);
unset($criteria);

if (!$tpl->is_cached('db:wggallery_rss.tpl', $cid)) {
    $tpl->assign('channel_title', htmlspecialchars($title, ENT_QUOTES));
    $tpl->assign('channel_link', \XOOPS_URL . '/');
    $tpl->assign('channel_desc', htmlspecialchars($xoopsConfig['slogan'], ENT_QUOTES));
    $tpl->assign('channel_lastbuild', \formatTimestamp(\time(), 'rss'));
    $tpl->assign('channel_webmaster', $xoopsConfig['adminmail']);
    $tpl->assign('channel_editor', $xoopsConfig['adminmail']);
    $tpl->assign('channel_category', 'Event');
    $tpl->assign('channel_generator', 'XOOPS - ' . htmlspecialchars($xoopsModule->getVar('img_ip'), ENT_QUOTES));
    $tpl->assign('channel_language', _LANGCODE);
    if (_LANGCODE === 'fr') {
        $tpl->assign('docs', 'http://www.scriptol.fr/rss/RSS-2.0.html');
    } else {
        $tpl->assign('docs', 'http://cyber.law.harvard.edu/rss/rss.html');
    }
    $tpl->assign('image_url', \XOOPS_URL . $xoopsModuleConfig['logorss']);
    $dimention = \getimagesize(\XOOPS_ROOT_PATH . $xoopsModuleConfig['logorss']);
    if (empty($dimention[0])) {
        $width = 88;
    } else {
        $width = ($dimention[0] > 144) ? 144 : $dimention[0];
    }
    if (empty($dimention[1])) {
        $height = 31;
    } else {
        $height = ($dimention[1] > 400) ? 400 : $dimention[1];
    }
    $tpl->assign('image_width', $width);
    $tpl->assign('image_height', $height);
    foreach (\array_keys($imagesArr) as $i) {
        $description = $imagesArr[$i]->getVar('description');
        //permet d'afficher uniquement la description courte
        if (false === mb_strpos($description, '[pagebreak]')) {
            $description_short = $description;
        } else {
            $description_short = mb_substr($description, 0, mb_strpos($description, '[pagebreak]'));
        }
        $tpl->append('items', [
                'title'       => htmlspecialchars($imagesArr[$i]->getVar('img_ip'), ENT_QUOTES),
                'link'        => \XOOPS_URL . '/modules/wggallery/single.php?cid=' . $imagesArr[$i]->getVar('cid') . '&amp;img_id=' . $imagesArr[$i]->getVar('img_id'),
                'guid'        => \XOOPS_URL . '/modules/wggallery/single.php?cid=' . $imagesArr[$i]->getVar('cid') . '&amp;img_id=' . $imagesArr[$i]->getVar('img_id'),
                'pubdate'     => \formatTimestamp($imagesArr[$i]->getVar('date'), 'rss'),
                'description' => htmlspecialchars($description_short, ENT_QUOTES),
        ]);
    }
}
header('Content-Type:text/xml; charset=' . _CHARSET);
$tpl->display('db:wggallery_rss.tpl', $cid);
