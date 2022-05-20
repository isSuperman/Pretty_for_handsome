<?php

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Widget\Options;


if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * <strong style="color:#28B7FF;font-family: 楷体;">Handsome主题美化专用</strong>
 *<div class="prettyHandsome"><a style="width:fit-content" id="prettyHandsome">版本检测中..</div>&nbsp;</div><style>.prettyHandsome {    margin-top: 5px;}.prettyHandsome a {    background: #00BFFF;    padding: 5px;    color: #fff;}</style>
 * <script>var prettyHandsome="1.0.0";function update_detec(){var container=document.getElementById("prettyHandsome");if(!container){return}var ajax=new XMLHttpRequest();container.style.display="block";ajax.open("get","https://api.github.com/repos/isSuperman/Pretty_for_handsome/releases/latest");ajax.send();ajax.onreadystatechange=function(){if(ajax.readyState===4&&ajax.status===200){var obj=JSON.parse(ajax.responseText);var newest=obj.tag_name;if(newest>prettyHandsome){container.innerHTML="发现新主题版本："+obj.name+'。下载地址：<a href="'+obj.zipball_url+'">点击下载</a>'+"<br>当前版本:"+String(prettyHandsome)+'<a target="_blank" href="'+obj.html_url+'">👉查看新版亮点</a>'}else{container.innerHTML="当前版本:"+String(prettyHandsome)+"。"+"最新版"}}}};update_detec();</script>		
 * @package PrettyHandsome
 * @author <strong style="color:#28B7FF;font-family: 楷体;">isSuperman</strong>
 * @version 1.0.0
 * @link https://github.com/isSuperman/Pretty_for_handsome
 */
class PrettyHandsome_Plugin implements PluginInterface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate()
    {
		Typecho_Plugin::factory('admin/common.php')->begin = [__Class__, 'parseShortCode'];
		Typecho_Plugin::factory('Widget_Archive')->handleInit = [__Class__, 'parseShortCode'];
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array(__CLASS__, 'insertHeader');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array(__CLASS__, 'insertHeader');

    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @param Form $form 配置面板
     */
    public static function config(Form $form)
    {
        /** 抖音解析API */
        $dyapi = new Text('dyapi', null, 'http://example.com/?url=', _t('抖音解析API'));
        $form->addInput($dyapi);
        /** 抖音解析API */
        $videoapi = new Text('videoapi', null, 'http://example.com/?url=', _t('其他视频云解析API'));
        $form->addInput($videoapi);
        $timeinfo = new Typecho_Widget_Helper_Form_Element_Radio('timeinfo', array(0 => '关闭', 1 => '开启'), 0, _t('右侧边栏时光流逝模块'), '');
        $form->addInput($timeinfo);
        $weather = new Typecho_Widget_Helper_Form_Element_Radio('weather', array(0 => '关闭', 1 => '开启'), 0, _t('顶部导航栏天气'), '');
        $form->addInput($timeinfo);
        $weatherUID = new Text('weatherUID', null, 'http://example.com/?url=', _t('心知天气公钥'));
        $form->addInput($weatherUID);
        $weatherHash = new Text('weatherHash', null, 'http://example.com/?url=', _t('心知天气私钥'));
        $form->addInput($weatherHash);
        $typefire = new Typecho_Widget_Helper_Form_Element_Radio('typefire', array(0 => '关闭', 1 => '开启'), 0, _t('打字烟花效果'), '');
        $form->addInput($typefire);
        $clickWord = new Typecho_Widget_Helper_Form_Element_Radio('clickWord', array(0 => '关闭', 1 => '开启'), 0, _t('鼠标点击特效'), '');
        $form->addInput($clickWord);
        $siteInfo = new Typecho_Widget_Helper_Form_Element_Radio('siteInfo', array(0 => '关闭', 1 => '开启'), 0, _t('显示全站字数、在线人数、响应耗时和访客总数'), '');
        $form->addInput($siteInfo);
        $titleCenter = new Typecho_Widget_Helper_Form_Element_Radio('titleCenter', array(0 => '关闭', 1 => '开启'), 0, _t('文章标题居中'), '');
        $form->addInput($titleCenter);
        $logoScan = new Typecho_Widget_Helper_Form_Element_Radio('logoScan', array(0 => '关闭', 1 => '开启'), 0, _t('LOGO扫光'), '');
        $form->addInput($logoScan);
        $copyTip = new Typecho_Widget_Helper_Form_Element_Radio('copyTip', array(0 => '关闭', 1 => '开启'), 0, _t('复制成功提示'), '');
        $form->addInput($copyTip);
        $htitlebg = new Text('htitlebg', null, '0,191,255', _t('H1/H2标题背景颜色'),'RGB颜色代码');
        $form->addInput($htitlebg);
    }
    }

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render(){}

    /**
     *为header添加css文件
     *@access public
     *@return void
     */
    public static function header() {
        $cssUrl = Helper::options() -> rootUrl . '/usr/plugins/PrettyHandsome/static/css/style.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
    }

    /**
     *为header添加css文件
     *@access public
     *@return void
    **/
    
    public static function insertHeader()
    {
        echo "<script src='" . Helper::options() -> rootUrl . '/usr/plugins/PrettyHandsome/static/js/extend.js' . "'></script>";
        echo "<script src='" . Helper::options() -> rootUrl . '/usr/plugins/PrettyHandsome/static/js/edit.js' . "'></script>";
    }

    /**
     *短代码解析
     *@access public
     *@return void
    **/
    public static function parseShortCode(){
		require_once 'ShortCode.php';
		ShortCode::set('videoiframe',function($name,$attr,$text,$code){
            $host = explode('.',$text, -1)[1];

            switch ($host){
                case "douyin":
                    return '<iframe title="iframe" src="'. Helper::options()->plugin('VideoIframe')->dyapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                case "bilibili":
                    return '<iframe title="iframe" src="' . $text . '&as_wide=1&high_quality=1&danmaku=0" frameborder="no" framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                default:
                    return '<iframe title="iframe" src="' . Helper::options()->plugin('VideoIframe')->videoapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
            }
		});
	}

}