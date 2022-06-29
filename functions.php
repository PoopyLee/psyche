<?php
/**
 * Created by LVWEI.
 * User: lilvwei
 * Date: 2022/6/15
 * Time: 12:07
 * Description:
 */
error_reporting(0);
define(TEMPLATEPATH, get_theme_file_path());    //获取目录路径
define(NOWTHEMEPATH, get_template_directory_uri());//获取主题模板目录
load_theme_textdomain( 'psyche' );

include TEMPLATEPATH.'/functions/assets.php';
include TEMPLATEPATH.'/functions/optimization.php';
include TEMPLATEPATH.'/functions/functions.php';
include TEMPLATEPATH.'/admin/codestar-framework/codestar-framework.php';
include TEMPLATEPATH.'/vendor/autoload.php';
