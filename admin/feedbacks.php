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
 * feedback plugin for xoops modules
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        general
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         XOOPS - Website:<https://xoops.org>
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
include dirname (__DIR__) . '/class/feedbacks.php';

$adminObject = \Xmf\Module\Admin::getInstance();

$feedback = new ModuleFeedbacks;

// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');
xoops_loadLanguage('feedback', $moduleDirName);

switch($op) {
	case 'list':
	default:
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('feedbacks.php'));
		$feedback->name = $GLOBALS['xoopsUser']->getVar('name');
		$feedback->email = $GLOBALS['xoopsUser']->getVar('email');
		$feedback->site = XOOPS_URL;
		$form = $feedback->getFormFeedback();
        echo $form->display();
	break;

	case 'send':
        // Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('index.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('feedbacks.php'));
		
		$your_name  = Request::getString('your_name', '');
		$your_site  = Request::getString('your_site', '');
		$your_mail  = Request::getString('your_mail', '');
		$fb_type    = Request::getString('fb_type', '');
		$fb_content = Request::getString('fb_content', '');

        $title = $GLOBALS['xoopsModule']->getVar('name') . ' - ' . _FB_SEND_FROM . $your_site;
        $body  = _FB_YOUR_NAME . ': ' . $your_name . ' (' . $your_mail . ')<br>';
		$body .= _FB_YOUR_SITE . ': ' . $your_site . '<br>';
        $body .= _FB_TYPE . ': ' . $fb_type . '<br><br>';
		$body .= _FB_TYPE_CONTENT . ':<br>';
        $body .= $fb_content;
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setToEmails($GLOBALS['xoopsModule']->getVar('author_mail'));
        $xoopsMailer->setFromEmail($your_mail);
        $xoopsMailer->setFromName($your_name);
        $xoopsMailer->setSubject($title);
        $xoopsMailer->multimailer->isHTML(true);
        $xoopsMailer->setBody($body);
        $ret = $xoopsMailer->send();
		if ( $ret ) {
			redirect_header('index.php', 3, _FB_SEND_SUCCESS);
		}
		
		// show form with content again
		$feedback->name = $your_name;
		$feedback->email = $your_mail;
		$feedback->site = $your_site;
		$feedback->type = $fb_type;
		$feedback->content = $fb_content;
		echo '<div align="center" style="width: 80%; padding: 10px; border: 2px solid #ff0000; color: #ff0000; margin-right:auto;margin-left:auto;">
            <h3>' . _FB_SEND_ERROR . '</h3>
            </div>';
		$form = $feedback->getFormFeedback();
        echo $form->display();
			
	break;
}
include __DIR__ . '/footer.php';
