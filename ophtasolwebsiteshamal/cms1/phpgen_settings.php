<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Asia/Kuwait');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => 'localhost',
          'port' => '3306',
          'username' => 'ophtasol_ibin_sina_user',
          'password' => 'ibin_sina@1825;',
          'database' => 'ophtasol_ibinsinadb',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return true;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => 'Default', 'description' => '');
    $result[] = array('caption' => 'Settings', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Slideshow', 'short_caption' => 'Slideshow', 'filename' => 'slideshow.php', 'name' => 'slideshow', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'About Us', 'short_caption' => 'About Us', 'filename' => 'about_us.php', 'name' => 'about_us', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Doctor', 'short_caption' => 'Doctor', 'filename' => 'doctor.php', 'name' => 'doctor', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Service', 'short_caption' => 'Service', 'filename' => 'service.php', 'name' => 'service', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Surgery', 'short_caption' => 'Surgery', 'filename' => 'surgery.php', 'name' => 'surgery', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Your Visit', 'short_caption' => 'Your Visit', 'filename' => 'your_visit.php', 'name' => 'your_visit', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'General Information', 'short_caption' => 'General Information', 'filename' => 'general_information.php', 'name' => 'general_information', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'News Activities', 'short_caption' => 'News Activities', 'filename' => 'news_activities.php', 'name' => 'news_activities', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Homepage Activities', 'short_caption' => 'Homepage Activities', 'filename' => 'homepage_activities.php', 'name' => 'homepage_activities', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Faq', 'short_caption' => 'Faq', 'filename' => 'faq.php', 'name' => 'faq', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Contact Us', 'short_caption' => 'Contact Us', 'filename' => 'contact_us.php', 'name' => 'contact_us', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Contact Form', 'short_caption' => 'Contact Form', 'filename' => 'contact_form.php', 'name' => 'contact_form', 'group_name' => 'Default', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Contact Cat', 'short_caption' => 'Contact Cat', 'filename' => 'contact_cat.php', 'name' => 'contact_cat', 'group_name' => 'Settings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Doctor Cat', 'short_caption' => 'Doctor Cat', 'filename' => 'doctor_cat.php', 'name' => 'doctor_cat', 'group_name' => 'Settings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Employment Category', 'short_caption' => 'Employment Category', 'filename' => 'employment_category.php', 'name' => 'employment_category', 'group_name' => 'Settings', 'add_separator' => true, 'description' => '');
    $result[] = array('caption' => 'Job Title', 'short_caption' => 'Job Title', 'filename' => 'job_title.php', 'name' => 'job_title', 'group_name' => 'Settings', 'add_separator' => true, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        '';
}

function GetPagesFooter()
{
    return
        '<p align="right">(C) <span><script type="text/javascript">document.write(new Date().getFullYear().toString())</script></span> <a href="http://www.chwarsoft.com" target=\'_blank\'>www.chwarsoft.com</a>

<span class="navbar-brand">

    <span>';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_OnGetCustomPagePermissionsHandler(Page $page, PermissionSet &$permissions, &$handled)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{

}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{

}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{

}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function GetDefaultDateFormat()
{
    return 'd M y';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_MENU;
}

function GetNullLabel()
{
    return null;
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 0;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, '', '');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}
