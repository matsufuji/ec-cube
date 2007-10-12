<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */

$include_dir = realpath(dirname( __FILE__));
require_once($include_dir . "/define.php");
if (!defined("CLASS_PATH")) {
    /** クラスパス */
    define("CLASS_PATH", $include_dir . HTML2DATA_DIR . "class/");
}

if (!defined("CLASS_EX_PATH")) {
    /** クラスパス */
    define("CLASS_EX_PATH", $include_dir . HTML2DATA_DIR . "class_extends/");
}

require_once($include_dir . HTML2DATA_DIR. "conf/conf.php");
require_once($include_dir . HTML2DATA_DIR . "include/module.inc");
require_once(CLASS_EX_PATH . "util_extends/GC_Utils_Ex.php");
require_once(CLASS_EX_PATH . "util_extends/SC_Utils_Ex.php");
require_once(CLASS_EX_PATH . "db_extends/SC_DB_MasterData_Ex.php");
require_once(CLASS_EX_PATH . "db_extends/SC_DB_DBFactory_Ex.php");
require_once(CLASS_PATH . "SC_View.php");
require_once(CLASS_PATH . "SC_DbConn.php");
require_once(CLASS_PATH . "SC_Session.php");
require_once(CLASS_PATH . "SC_Query.php");
require_once(CLASS_PATH . "SC_SelectSql.php");
require_once(CLASS_PATH . "SC_CheckError.php");
require_once(CLASS_PATH . "SC_PageNavi.php");
require_once(CLASS_PATH . "SC_Date.php");
require_once(CLASS_PATH . "SC_Image.php");
require_once(CLASS_PATH . "SC_UploadFile.php");
require_once(CLASS_PATH . "SC_SiteInfo.php");
require_once(CLASS_PATH . "SC_SendMail.php");
require_once(CLASS_PATH . "SC_FormParam.php");
require_once(CLASS_PATH . "SC_CartSession.php");
require_once(CLASS_PATH . "SC_SiteSession.php");
require_once(CLASS_PATH . "SC_CampaignSession.php");
require_once(CLASS_PATH . "SC_Customer.php");
require_once(CLASS_PATH . "SC_CustomerList.php");
require_once(CLASS_PATH . "SC_Cookie.php");
require_once(CLASS_PATH . "SC_Pdf.php");
require_once(CLASS_PATH . "SC_MobileUserAgent.php");
require_once(CLASS_PATH . "SC_MobileEmoji.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_PageLayout_Ex.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_DB_Ex.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_Session_Ex.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_Mail_Ex.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_Mobile_Ex.php");
include_once($include_dir . "/require_plugin.php");

// インストールチェック
SC_Utils_Ex::sfInitInstall();

// 携帯端末の場合は mobile 以下へリダイレクトする。
if (SC_MobileUserAgent::isMobile()) {
    if (preg_match('|^' . URL_DIR . '(.*)$|', $_SERVER['REQUEST_URI'], $matches)) {
        $path = $matches[1];
    } else {
        $path = '';
    }

    $url = "";
    if (SC_Utils_Ex::sfIsHTTPS()) {
        $url = SSL_URL;
    } else {
        $url = SITE_URL;
    }
    header("Location: "
           .  SC_Utils_Ex::sfRmDupSlash($url . URL_DIR . "mobile/" . $path));
    exit;
}

// 絵文字変換 (除去) フィルターを組み込む。
ob_start(array('SC_MobileEmoji', 'handler'));

// アップデートで取得したPHPを読み出す
SC_Utils_Ex::sfLoadUpdateModule();
?>
