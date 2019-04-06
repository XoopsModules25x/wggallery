<?php

namespace XoopsModules\Wggallery;

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
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 watermarks.php 1 Thu 2018-11-01 08:54:56Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler Watermarks
 */
class WatermarksHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wggallery_watermarks', Watermarks::class, 'wm_id', 'wm_name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int   $i field id
     * @param array $fields
     * @return mixed reference to the {@link Get} object
     */
    public function get($i = null, $fields = null)
    {
        return parent::get($i, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Watermarks in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountWatermarks($start = 0, $limit = 0, $sort = 'wm_id ASC, wm_name', $order = 'ASC')
    {
        $crCountWatermarks = new \CriteriaCompo();
        $crCountWatermarks = $this->getWatermarksCriteria($crCountWatermarks, $start, $limit, $sort, $order);

        return parent::getCount($crCountWatermarks);
    }

    /**
     * Get All Watermarks in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllWatermarks($start = 0, $limit = 0, $sort = 'wm_id ASC, wm_name', $order = 'ASC')
    {
        $crAllWatermarks = new \CriteriaCompo();
        $crAllWatermarks = $this->getWatermarksCriteria($crAllWatermarks, $start, $limit, $sort, $order);

        return parent::getAll($crAllWatermarks);
    }

    /**
     * Get Criteria Watermarks
     * @param        $crWatermarks
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getWatermarksCriteria($crWatermarks, $start, $limit, $sort, $order)
    {
        $crWatermarks->setStart($start);
        $crWatermarks->setLimit($limit);
        $crWatermarks->setSort($sort);
        $crWatermarks->setOrder($order);

        return $crWatermarks;
    }

    /**
     * @param $wmId
     * @param $SourceFile
     * @param $DestinationFile
     * @return bool|string
     */
    public function watermarkImage($wmId, $SourceFile, $DestinationFile)
    {
        // check file exists
        if (!file_exists($SourceFile)) {
            return 'File not found!';
        }
        // get source image
        $mimetypeSource = mime_content_type($SourceFile);
        switch ($mimetypeSource) {
            case'image/png':
                $imgToBeStamped = imagecreatefrompng($SourceFile);
                break;
            case'image/jpeg':
                $imgToBeStamped = imagecreatefromjpeg($SourceFile);
                break;
            case'image/gif':
                $imgToBeStamped = imagecreatefromgif($SourceFile);
                break;
            default:
                return 'Unsupported format sourcefile';
        }
        $sxFinal = imagesx($imgToBeStamped);
        $syFinal = imagesy($imgToBeStamped);
        // get watermark object
        $watermarksObj = $this->get($wmId);
        $wm_type       = $watermarksObj->getVar('wm_type');
        $marginLR      = $watermarksObj->getVar('wm_marginlr');
        $marginTB      = $watermarksObj->getVar('wm_margintb');
        $position      = $watermarksObj->getVar('wm_position');
        switch ($wm_type) {
            case Constants::WATERMARK_TYPEIMAGE:
                $imgStamp       = WGGALLERY_UPLOAD_IMAGE_PATH . '/watermarks/' . $watermarksObj->getVar('wm_image');
                $mimetype_stamp = mime_content_type($imgStamp);
                // create stamp
                switch ($mimetype_stamp) {
                    case'image/png':
                        $stamp = imagecreatefrompng($imgStamp);
                        break;
                    case'image/jpeg':
                        $stamp = imagecreatefromjpeg($imgStamp);
                        break;
                    case'image/gif':
                        $stamp = imagecreatefromgif($imgStamp);
                        break;
                    default:
                        return 'Unsupported format watermark image';
                }

                // calculate position of stamp
                switch ($position) {
                    case Constants::WATERMARK_POSTOPLEFT:
                        $posStampX = $marginLR;
                        $posStampY = $marginTB;
                        break;
                    case Constants::WATERMARK_POSTOPRIGHT:
                        $posStampX = $sxFinal - imagesx($stamp) - $marginLR;
                        $posStampY = $marginTB;
                        break;
                    case Constants::WATERMARK_POSTOPCENTER:
                        $posStampX = ($sxFinal - imagesx($stamp)) / 2;
                        $posStampY = $marginTB;
                        break;
                    case Constants::WATERMARK_POSMIDDLELEFT:
                        $posStampX = $marginLR;
                        $posStampY = ($syFinal - imagesy($stamp)) / 2;
                        break;
                    case Constants::WATERMARK_POSMIDDLERIGHT:
                        $posStampX = $sxFinal - imagesx($stamp) - $marginLR;
                        $posStampY = ($syFinal - imagesy($stamp)) / 2;
                        break;
                    case Constants::WATERMARK_POSMIDDLECENTER:
                        $posStampX = ($sxFinal - imagesx($stamp)) / 2;
                        $posStampY = ($syFinal - imagesy($stamp)) / 2;
                        break;
                    case Constants::WATERMARK_POSBOTTOMLEFT:
                        $posStampX = $marginLR;
                        $posStampY = $syFinal - imagesy($stamp) - $marginTB;
                        break;
                    case Constants::WATERMARK_POSBOTTOMRIGHT:
                        $posStampX = $sxFinal - imagesx($stamp) - $marginLR;
                        $posStampY = $syFinal - imagesy($stamp) - $marginTB;
                        break;
                    case Constants::WATERMARK_POSBOTTOMCENTER:
                        $posStampX = ($sxFinal - imagesx($stamp)) / 2;
                        $posStampY = $syFinal - imagesy($stamp) - $marginTB;
                        break;
                    case 'else':
                    default:
                        return 'wrong wm_position';
                        break;
                }

                // create new image
                imagecopy($imgToBeStamped, $stamp, $posStampX, $posStampY, 0, 0, imagesx($stamp), imagesy($stamp));
                $imgFinal = $imgToBeStamped;
                break;
            case Constants::WATERMARK_TYPETEXT:
                $wmText = $watermarksObj->getVar('wm_text');
                $stamp  = imagecreatetruecolor($sxFinal, $syFinal);
                imagecopyresampled($stamp, $imgToBeStamped, 0, 0, 0, 0, $sxFinal, $syFinal, $sxFinal, $syFinal);
                // convert hex to rgb
                $Hex        = mb_substr($watermarksObj->getVar('wm_color'), 1);
                $R          = hexdec(mb_substr($Hex, 0, 2));
                $G          = hexdec(mb_substr($Hex, 2, 2));
                $B          = hexdec(mb_substr($Hex, 4, 2));
                $fontColor  = imagecolorallocate($stamp, $R, $G, $B);
                $fontFamily = WGGALLERY_UPLOAD_FONTS_PATH . '/' . $watermarksObj->getVar('wm_font');
                $fontSize   = $watermarksObj->getVar('wm_fontsize');

                $fontSizePoints = $fontSize * 72 / 96;
                // Get your Text Width and Height
                $text_box   = imagettfbbox($fontSizePoints, 0, $fontFamily, $wmText);
                $text_width = $text_box[2] - $text_box[0];
                // $text_height = $text_box[7]-$text_box[1];
                // calculate position of stamp
                switch ($position) {
                    case Constants::WATERMARK_POSTOPLEFT:
                        $posStampX = $marginLR;
                        $posStampY = ($fontSize / 2) + $marginTB;
                        break;
                    case Constants::WATERMARK_POSTOPRIGHT:
                        $posStampX = $sxFinal - $text_width - $marginLR;
                        $posStampY = ($fontSize / 2) + $marginTB;
                        break;
                    case Constants::WATERMARK_POSTOPCENTER:
                        $posStampX = ($sxFinal - $text_width) / 2;
                        $posStampY = ($fontSize / 2) + $marginTB;
                        break;
                    case Constants::WATERMARK_POSMIDDLELEFT:
                        $posStampX = $marginLR;
                        $posStampY = $syFinal / 2;
                        break;
                    case Constants::WATERMARK_POSMIDDLERIGHT:
                        $posStampX = $sxFinal - $text_width - $marginLR;
                        $posStampY = $syFinal / 2;
                        break;
                    case Constants::WATERMARK_POSMIDDLECENTER:
                        $posStampX = ($sxFinal - $text_width) / 2;
                        $posStampY = $syFinal / 2;
                        break;
                    case Constants::WATERMARK_POSBOTTOMLEFT:
                        $posStampX = $marginLR;
                        $posStampY = $syFinal - $marginTB;
                        break;
                    case Constants::WATERMARK_POSBOTTOMRIGHT:
                        $posStampX = $sxFinal - $text_width - $marginLR;
                        $posStampY = $syFinal - $marginTB;
                        break;
                    case Constants::WATERMARK_POSBOTTOMCENTER:
                        $posStampX = ($sxFinal - $text_width) / 2;
                        $posStampY = $syFinal - $marginTB;
                        break;
                    case 'else':
                    default:
                        return 'wrong wm_position';
                        break;
                }
                imagettftext($stamp, $fontSizePoints, 0, $posStampX, $posStampY, $fontColor, $fontFamily, $wmText);
                $imgFinal = $stamp;
                break;
            case 'default':
            default:
                return 'wrong wm_type';
                break;
        }

        // save marked image
        switch ($mimetypeSource) {
            case'image/png':
                imagepng($imgFinal, $DestinationFile);
                break;
            case'image/jpeg':
                imagejpeg($imgFinal, $DestinationFile, 100);
                break;
            case'image/gif':
                imagegif($imgFinal, $DestinationFile);
                break;
            default:
                return 'Unsupported format sourcefile';
        }

        imagedestroy($imgToBeStamped);
        imagedestroy($stamp);

        return true;
    }
}
