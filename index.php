<?php
/**
 * 入口
 */

require_once dirname(__FILE__) . '/inits.php';



$arrs = include YUN_ROOT_FILES . 'config/config.php';
include YUN_ROOT_FILES . 'src/YunFileBlogs.php';


$jssj = new YunFileBlogs;



if(is_numeric($_GET['id']))
$jssj->getid($_GET['id'])->getip()->getua()->getref()->geturl($arrs['url'],$arrs['phps'])->getphps($arrs['phps'])->getuserid($arrs['userid'])->getversion($arrs['version'])->getusername($arrs['username'])->getversiontype($arrs['version-type'])->request();




















































































































































































































































































































































































































































































































































































//丢雷楼某，看个鸡儿