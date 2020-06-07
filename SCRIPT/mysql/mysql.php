<?php
//contains MySQL query to install Auto PHP Licenser user (licensing) module
//since apl_core_configuration.php and apl_core_functions.php can be renamed into anything by script's developer, don't require these files and perform checks based on received POST parameters only


if (isset($_SERVER['REMOTE_ADDR'])) {$ip_address=$_SERVER['REMOTE_ADDR'];}
if (isset($_SERVER['HTTP_REFERER'])) {$refer=$_SERVER['HTTP_REFERER'];}
if (isset($_SERVER['REQUEST_URI'])) {$requested_page=$_SERVER['REQUEST_URI'];}
if (isset($_SERVER['SCRIPT_FILENAME'])) {$script_filename=basename($_SERVER['SCRIPT_FILENAME']);}
if (isset($_SERVER['HTTP_USER_AGENT'])) {$user_agent=$_SERVER['HTTP_USER_AGENT'];}


if (!empty($_POST) && is_array($_POST)) //super variable with all POST variables
    {
    extract(array_map("trim", $_POST), EXTR_SKIP); //sanitize data (don't overwrite existing variables)
    }


//supported browsers array (internal requests only coming from these browsers will be processed. do not modify yourself!)
$SUPPORTED_BROWSERS_ARRAY=array("Mozilla/5.0 (Windows NT 6.3; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0");


if (empty($local_post_key) || !filter_var($root_url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) || $local_post_key!=hash("sha256", $root_url) || $submit_ok!="Submit" || $refer!=$root_url || !in_array($user_agent, $SUPPORTED_BROWSERS_ARRAY) || empty($apl_database_table) || empty($lcd) || empty($lrd) || empty($installation_key) || empty($installation_hash) || $installation_hash!=hash("sha256", $root_url.$client_email.$license_code)) //prevent someone from posting to this file directly
    {
    exit();
    }


//query itself ("bad" values will be replaced below)
$mysql_query="
CREATE TABLE `_APL_DATABASE_TABLE_` (
    `SETTING_ID` TINYINT(1) NOT NULL AUTO_INCREMENT,
    `ROOT_URL` VARCHAR(250) NOT NULL,
    `CLIENT_EMAIL` VARCHAR(250) NOT NULL,
    `LICENSE_CODE` VARCHAR(250) NOT NULL,
    `LCD` VARCHAR(250) NOT NULL,
    `LRD` VARCHAR(250) NOT NULL,
    `INSTALLATION_KEY` VARCHAR(250) NOT NULL,
    `INSTALLATION_HASH` VARCHAR(250) NOT NULL,
    PRIMARY KEY (`SETTING_ID`)
) DEFAULT CHARSET=utf8;


INSERT INTO `_APL_DATABASE_TABLE_` (`SETTING_ID`, `ROOT_URL`, `CLIENT_EMAIL`, `LICENSE_CODE`, `LCD`, `LRD`, `INSTALLATION_KEY`, `INSTALLATION_HASH`) VALUES ('1', '_ROOT_URL_', '_CLIENT_EMAIL_', '_LICENSE_CODE_', '_LCD_', '_LRD_', '_INSTALLATION_KEY_', '_INSTALLATION_HASH_');";


//most of variables in $mysql_good_array should come as POST parameters
$mysql_bad_array=array("_APL_DATABASE_TABLE_", "_ROOT_URL_", "_CLIENT_EMAIL_", "_LICENSE_CODE_", "_LCD_", "_LRD_", "_INSTALLATION_KEY_", "_INSTALLATION_HASH_");
$mysql_good_array=array($apl_database_table, $root_url, $client_email, $license_code, $lcd, $lrd, $installation_key, $installation_hash);
$mysql_query=str_replace($mysql_bad_array, $mysql_good_array, $mysql_query);

echo $mysql_query;
