<?php

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

include 'function/form.php';
include 'function/header.php';
include 'function/footer.php';

/**
 * <strong style="color:#28B7FF;font-family: 楷体;">Handsome主题美化专用</strong>
 *<div class="prettyHandsome"><a style="width:fit-content" id="prettyHandsome">版本检测中..</div>&nbsp;</div><style>.prettyHandsome {    margin-top: 5px;}.prettyHandsome a {    background: #00BFFF;    padding: 5px;    color: #fff;}</style>
 * <script>var prettyHandsome="1.0.8";function update_detec(){var container=document.getElementById("prettyHandsome");if(!container){return}var ajax=new XMLHttpRequest();container.style.display="block";ajax.open("get","https://api.github.com/repos/isSuperman/Pretty_for_handsome/releases/latest");ajax.send();ajax.onreadystatechange=function(){if(ajax.readyState===4&&ajax.status===200){var obj=JSON.parse(ajax.responseText);var newest=obj.tag_name;if(newest>prettyHandsome){container.innerHTML="发现新主题版本："+obj.name+'。下载地址：<a href="'+obj.zipball_url+'">点击下载</a>'+"<br>当前版本:"+String(prettyHandsome)+'<a target="_blank" href="'+obj.html_url+'">👉查看新版亮点</a>'}else{container.innerHTML="当前版本:"+String(prettyHandsome)+"。"+"最新版"}}}};update_detec();</script>		
 * @package PrettyHandsome
 * @author <strong style="color:#28B7FF;font-family: 楷体;">isSuperman</strong>
 * @version 1.0.8
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
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
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
        // 抖音解析API
        $form->addInput(PluginsForm::DouyinApi());

        // 其他视频解析API
        $form->addInput(PluginsForm::VideoApi());

        // 响应耗时和访客总数
        $form->addInput(PluginsForm::SiteInfo());

        // 时光流逝
        $form->addInput(PluginsForm::TimeInfo());

        // 顶部导航栏天气
        $form->addInput(PluginsForm::Weather());
        $form->addInput(PluginsForm::WeatherUID());
        $form->addInput(PluginsForm::WeatherHASH());

        // 彩色目录图标
        $form->addInput(PluginsForm::ColorToc());

        // 彩色标签云
        $form->addInput(PluginsForm::ColorTag());

        // 鼠标经过头像旋转放大
        $form->addInput(PluginsForm::AvatarCircle());

        // 鼠标点击特效
        $form->addInput(PluginsForm::ClickWord());

        // 文章标题居中
        $form->addInput(PluginsForm::TitleCenter());

        // LOGO扫光
        $form->addInput(PluginsForm::LogoScan());

        // 复制成功提示
        $form->addInput(PluginsForm::CopyTip());

        // H1/H2标题背景颜色
        $form->addInput(PluginsForm::HTitlebg());

        // 打赏按钮跳动
        $form->addInput(PluginsForm::ZanBump());

        // 移动端禁止显示标签云和博客信息
        $form->addInput(PluginsForm::MobileHideInfo());

        // 首页文章鼠标经过上浮
        $form->addInput(PluginsForm::IndexPostWave());

        // 文章页头图悬浮
        $form->addInput(PluginsForm::PostThumbImgWave());

        // 网站运行时间
        $form->addInput(PluginsForm::SiteSpendTime());

        // 网站开始时间
        $form->addInput(PluginsForm::SiteBegin());

        // 文章end标识
        $form->addInput(PluginsForm::PostEndMark());

        // 文章二维码
        $form->addInput(PluginsForm::PostQRCode());

        // 百度手动提交按钮
        $form->addInput(PluginsForm::BaiduPushBtn());

        // 全站黑白模式
        $form->addInput(PluginsForm::SiteBlackWhite());

        // 文章版权提示
        $form->addInput(PluginsForm::PostCopyrightTip());

        // 评论边框
        $form->addInput(PluginsForm::CommentBorder());

        // 评论边框颜色RGB
        $form->addInput(PluginsForm::CommentBorderRGB());

        // 首页轮播图样式优化
        $form->addInput(PluginsForm::IndexSwiperPicStyle());

        // 评论头像呼吸效果
        $form->addInput(PluginsForm::CommentAvatarBreath());
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

        // 初始化头部
        PluginsHead::init();

        // iframe视频样式
        PluginsHead::VideoIframe();

        // 配置头部
        PluginsHead::SettingHead();
    }

    /**
     *为footer添加js文件
     *@access public
     *@return void
     */
    public static function footer() {

        PluginsFooter::SettingFooter();

    }


    /**
     *为editor_header添加js文件
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
                    return '<iframe title="iframe" src="'. Helper::options()->plugin('PrettyHandsome')->dyapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                case "bilibili":
                    return '<iframe title="iframe" src="' . $text . '&as_wide=1&high_quality=1&danmaku=0" frameborder="no" framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                default:
                    return '<iframe title="iframe" src="' . Helper::options()->plugin('PrettyHandsome')->videoapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
            }
		});
	}

}