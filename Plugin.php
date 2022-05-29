<?php

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Widget\Options;


if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

include 'function/header.php';
include 'function/footer.php';

/**
 * <strong style="color:#28B7FF;font-family: 楷体;">Handsome主题美化专用</strong>
 *<div class="prettyHandsome"><a style="width:fit-content" id="prettyHandsome">版本检测中..</div>&nbsp;</div><style>.prettyHandsome {    margin-top: 5px;}.prettyHandsome a {    background: #00BFFF;    padding: 5px;    color: #fff;}</style>
 * <script>var prettyHandsome="1.0.5";function update_detec(){var container=document.getElementById("prettyHandsome");if(!container){return}var ajax=new XMLHttpRequest();container.style.display="block";ajax.open("get","https://api.github.com/repos/isSuperman/Pretty_for_handsome/releases/latest");ajax.send();ajax.onreadystatechange=function(){if(ajax.readyState===4&&ajax.status===200){var obj=JSON.parse(ajax.responseText);var newest=obj.tag_name;if(newest>prettyHandsome){container.innerHTML="发现新主题版本："+obj.name+'。下载地址：<a href="'+obj.zipball_url+'">点击下载</a>'+"<br>当前版本:"+String(prettyHandsome)+'<a target="_blank" href="'+obj.html_url+'">👉查看新版亮点</a>'}else{container.innerHTML="当前版本:"+String(prettyHandsome)+"。"+"最新版"}}}};update_detec();</script>		
 * @package PrettyHandsome
 * @author <strong style="color:#28B7FF;font-family: 楷体;">isSuperman</strong>
 * @version 1.0.5
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
        $qrcodejsUrl = Helper::options() -> rootUrl . '/usr/plugins/PrettyHandsome/static/js/qrcode.min.js';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
        echo '<script src="https://cdn.staticfile.org/jquery/2.2.4/jquery.min.js"></script>';

        if(Helper::options()->plugin('PrettyHandsome')->postCopyrightTip==1){
            echo <<<HTML
            <style>
            .tt-license {font-size: 12px;font-weight: 600;padding: 1rem;background-color: #f3f5f7;border-left: 3px solid #dde6e9;margin-bottom: 20px;}
            .tt-license-icon {align-items: center;position: relative;float: left;margin: -10px -10px -10px 0;margin-right: 10px;overflow: hidden;text-align: center;display: flex;height: 40px;color: #ff5722;}
            .tt-license a {color: #337ab7;text-decoration: underline;margin: 0 5px;}
            html.theme-dark .tt-license {background-color: transparent;border-left: 3px solid #494949;}.tt-license p {line-height: 1.5em;margin: 5px 0!important;}
            </style>
            <script>
                function addCopyrightTip(){
                    let postLink = window.location.href;
                    $("#post-content > div.support-author").before('<div class="tt-license"><p><span class="tt-license-icon"><i data-feather="link"></i></span>本文链接：' + postLink + '</a></p><p><span class="tt-license-icon"><i data-feather="shield"></i></span>除非注明，本作品采用<a rel="license nofollow" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议</a></p><p><span class="tt-license-icon"><i data-feather="alert-circle"></i></span>声明：转载请注明文章来源</p></div>')
                }
                addCopyrightTip();
            </script>
HTML;
            Helper::options()->ChangeAction .= 'if($("#post-content > div.support-author").length){addCopyrightTip();}';
        }

        if(Helper::options()->plugin('PrettyHandsome')->siteBlackWhite==1){
            echo <<<CSS
            <style>
            html {-webkit-filter: grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(graysale=1);}
            html { filter:progidXImageTransform.Microsoft.BasicImage(grayscale=1); }
            html{ filter: grayscale(100%); -webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: url("data:image/svg+xml;utf8,#grayscale"); filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); -webkit-filter: grayscale(1);}
            </style>
CSS;
        }

        if(Helper::options()->plugin('PrettyHandsome')->baiduPush==1){
            echo <<<HTML
            <script>
                function addPushToBaiduBtn(){
                    $("#post-content > div.show-foot > div.notebook").after('<a style="padding-left:2px;font-size:12px;color:#9b9b9b;" rel="external nofollow" title="点击提交百度收录！" target="_blank" href="https://ziyuan.baidu.com/linksubmit/url?sitename='+window.location.href+'">提交百度</a>')
                }
                addPushToBaiduBtn()
            </script>
HTML;
            Helper::options()->ChangeAction .= 'if($("#post-content > div.show-foot > div.notebook").length){addPushToBaiduBtn();}';
        }

        if(Helper::options()->plugin('PrettyHandsome')->postQRcode==1){
            echo <<<CSS
            <style>
                #qrcodediv {
                    position: relative;
                    display: inline-block;
                }
                #qrcodediv #qrdiv{
                    display: none;
                    -webkit-appearance: none;
                    width: 0px;
                    background-color: #FFFFFF;
                    color: #000000;
                    text-align: center;
                    padding: 10px 10px 0;
                    box-shadow: 6px 6px 20px #cccccc;
                    border-radius: 12px;
                    font-size: 15px;
                    position: absolute;
                    z-index: 1;
                    top: 100%;
                    left: 50%;
                    margin-left: -60px;
                    
                }
                #qrdiv #qrtext{
                    padding-top: 8px;
                    padding-bottom: 8px;
                    font-size: 14px;
                    font-weight: bold;
                }
                #qrcodediv span svg {
                    fill: currentColor;
                }
                @media(any-hover:hover){
                    #qrcodediv:hover #qrdiv{
                        width:120px;
                        display: block;
                    }
                }
                html.theme-dark #qrcodediv #qrdiv{
                    box-shadow: 0 0 0 #cccccc;
                    
                }
            </style>
CSS;
            echo '<script src="'.$qrcodejsUrl.'"></script>';
            echo <<<HTML
            <script>
                function addQRCodeIcon(){
                    if($("#small_widgets > h1 > a:nth-child(3)").length){
                        $("#small_widgets > h1 > a:nth-child(3)").after('<a id="qrcodediv" href="javascript:void(0);" onclick="showQR()"><span id="qucodeicon" class="m-l-sm superscript" href="javascript:void(0);" target="_blank"><svg t="1653553296895" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5854" width="16" height="16"><path d="M85.312 85.312V384H384V85.312H85.312zM0 0h469.248v469.248H0V0z m170.624 170.624h128v128h-128v-128zM0 554.624h469.248v469.248H0V554.624z m85.312 85.312v298.624H384V639.936H85.312z m85.312 85.312h128v128h-128v-128zM554.624 0h469.248v469.248H554.624V0z m85.312 85.312V384h298.624V85.312H639.936z m383.936 682.56H1024v85.376h-298.752V639.936H639.936V1023.872H554.624V554.624h255.936v213.248h128V554.624h85.312v213.248z m-298.624-597.248h128v128h-128v-128z m298.624 853.248h-85.312v-85.312h85.312v85.312z m-213.312 0h-85.312v-85.312h85.312v85.312z" p-id="5855"></path></svg></span><div id="qrdiv"><div id="qrcode"></div><div id="qrtext">扫码阅读本文</div></div></a>')
                    }else{
                        $("#small_widgets > h1 > a:nth-child(2)").after('<a id="qrcodediv" href="javascript:void(0);" onclick="showQR()"><span id="qucodeicon" class="m-l-sm superscript" href="javascript:void(0);" target="_blank"><svg t="1653553296895" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5854" width="16" height="16"><path d="M85.312 85.312V384H384V85.312H85.312zM0 0h469.248v469.248H0V0z m170.624 170.624h128v128h-128v-128zM0 554.624h469.248v469.248H0V554.624z m85.312 85.312v298.624H384V639.936H85.312z m85.312 85.312h128v128h-128v-128zM554.624 0h469.248v469.248H554.624V0z m85.312 85.312V384h298.624V85.312H639.936z m383.936 682.56H1024v85.376h-298.752V639.936H639.936V1023.872H554.624V554.624h255.936v213.248h128V554.624h85.312v213.248z m-298.624-597.248h128v128h-128v-128z m298.624 853.248h-85.312v-85.312h85.312v85.312z m-213.312 0h-85.312v-85.312h85.312v85.312z" p-id="5855"></path></svg></span><div id="qrdiv"><div id="qrcode"></div><div id="qrtext">扫码阅读本文</div></div></a>')
                    }
                    
                }
                function generateQRCode(){
                    var qrcode = new QRCode("qrcode", {
                        text: window.location.href,
                        width: 100,
                        height: 100,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
                function showQR(){
                    if($("#qrdiv").css("display") === 'none'){
                        $("#qrdiv").css("width","120px")
                        $("#qrdiv").css("display","block")
                    }else{
                        $("#qrdiv").css("width","0px")
                        $("#qrdiv").css("display","none")
                    }
                }
                addQRCodeIcon();
            </script>
HTML;
            Helper::options()->ChangeAction .= 'addQRCodeIcon();if($("#qrcode").length){generateQRCode();}';
        }

        if(Helper::options()->plugin('PrettyHandsome')->postEndMark==1){
            echo <<<HTML
            <style>
            .tt-fenge-end{border-top: 2px dotted #eee;height: 0px;margin: 35px 0px;text-align: center;width: 100%;line-height: 1.6em;}
            .tt-fenge-end span{background-color: #23b7e5;color: #fff;padding: 2px 8px;position: relative;top: -14px;border-radius: 12px;font-size: 12px;}
            html.theme-dark .tt-fenge-end{border-top: 2px dotted #4f4f4f;}
            </style>
            <script>
            function addEndMark(){
                $("#post-content > div.show-foot").before('<div class="tt-fenge-end"><span>本文至此结束</span></div>')
            }
            addEndMark()
            </script>
HTML;
            Helper::options()->ChangeAction .= 'addEndMark();';
        }

        if(Helper::options()->plugin('PrettyHandsome')->indexPostWave==1){
            echo <<<CSS
            <style>
            @media (min-width:767px){.post-list .panel:not(article){transition:all 0.3s}
            .post-list .panel:not(article):hover{transform:translateY(-10px);box-shadow:0 8px 10px rgba(204,204,204,0.47)}
            html.theme-dark .post-list .panel:not(article):hover{transform:translateY(-10px);box-shadow:none}
            .post-list .panel-small:not(article){transition:all 0.3s}
            .post-list .panel-small:not(article):hover{transform:translateY(-10px);box-shadow:0 8px 10px rgba(204,204,204,0.47)}
            html.theme-dark .post-list .panel-small:not(article):hover{transform:translateY(-10px);box-shadow:none}
            .post-list .panel-picture:not(article){transition:all 0.3s}
            .post-list .panel-picture:not(article):hover{transform:translateY(-10px);box-shadow:0 8px 10px rgba(204,204,204,0.47)}
            }
            html.theme-dark .post-list .panel-picture:not(article):hover{transform:translateY(-10px);box-shadow:none}
            </style>
CSS;
        }
        if(Helper::options()->plugin('PrettyHandsome')->mobileHideInfo==1){
            echo <<<CSS
            <style>
            @media (max-width:767px) {#tabs-4,#tag_cloud-2 {display: none;}}
            @media (max-width:767px) {#blog_info {display: none;}}
            </style>
CSS;
        }

        if(Helper::options()->plugin('PrettyHandsome')->zanBump==1){
            echo <<<CSS
				<style>
				.btn-pay{animation:star 0.5s ease-in-out infinite alternate;}@keyframes star{from{transform:scale(1);}to{transform:scale(1.1);}}
				</style>
CSS;
        }

        if(Helper::options()->plugin('PrettyHandsome')->siteInfo==1){
            $color = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];
            $user = '<svg t=\"1595231685089\" class=\"icon\" viewBox=\"0 0 1024 1024\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" p-id=\"2613\" width=\"16\" height=\"16\"><path d=\"M656.79 499.92A241.63 241.63 0 0 0 754 306c0-133.65-108.35-242-242-242S270 172.35 270 306a241.63 241.63 0 0 0 97.21 193.92C190.84 560.12 64 727.25 64 924a36 36 0 0 0 72 0c0-207.66 168.34-376 376-376s376 168.34 376 376a36 36 0 0 0 72 0c0-196.75-126.84-363.88-303.21-424.08zM342 306a170 170 0 1 1 170 170 170 170 0 0 1-170-170z\" p-id=\"2614\" fill=\"#515151\"></path></svg>';
            $time = '<svg t=\"1595232641264\" class=\"icon\" viewBox=\"0 0 1024 1024\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" p-id=\"4026\" width=\"16\" height=\"16\"><path d=\"M511.98464 66.56c-118.97856 0-230.83008 46.35136-314.95168 130.4832C112.90624 281.15968 66.56 393.04192 66.56 511.99488c0 118.9632 46.34624 230.84544 130.47296 314.9568C281.15456 911.09376 393.00608 957.44 511.98464 957.44c118.98368 0 230.84032-46.34624 314.9824-130.48832C911.09376 742.84032 957.44 630.97856 957.44 511.99488c0-118.97856-46.34624-230.8352-130.47296-314.95168C742.82496 112.91136 630.96832 66.56 511.98464 66.56z m275.58912 721.02912c-73.61024 73.63584-171.47904 114.18624-275.58912 114.18624s-201.97376-40.5504-275.57888-114.18624c-73.63584-73.61024-114.16064-171.47904-114.16064-275.59424 0-104.11008 40.54528-201.97376 114.18112-275.58912 73.60512-73.63072 171.47392-114.176 275.584-114.176s201.97376 40.54528 275.584 114.176c73.63584 73.61536 114.18112 171.47904 114.18112 275.58912 0 104.1152-40.56576 201.984-114.2016 275.59424z\" fill=\"#515151\" p-id=\"4027\"></path><path d=\"M519.1168 555.79136V267.91936a27.8528 27.8528 0 0 0-27.84256-27.84768 27.8528 27.8528 0 0 0-27.84256 27.84768v306.23232a27.81184 27.81184 0 0 0 16.88064 25.58976\" fill=\"#515151\" p-id=\"4028\"></path><path d=\"M734.70464 574.15168a31.0784 31.0784 0 0 1-31.07328 31.0784H496.44544a31.08864 31.08864 0 0 1-31.07328-31.0784 31.09376 31.09376 0 0 1 31.07328-31.0784h207.18592a31.08864 31.08864 0 0 1 31.07328 31.0784z\" fill=\"#515151\" p-id=\"4029\"></path></svg>';
            echo '<script type="text/javascript">
                function TotalVisit(){
                    $(function(){
                    $("ul.list-group.box-shadow-wrap-normal").append("<li class=\"list-group-item text-second\"><span class=\"blog-info-icons\">'.$user.'</span><span class=\"badge pull-right\" style=\"background-color: '.$color[array_rand($color)].'\">'.STATIC::TotalVisit().'</span>访客总数</li>");
                    });
                }
            //TotalVisit();
            function AS_ResTime(){
                let ResTime = window.performance;
                function consume(time) {
                    return time + \'ms\';
                };
                let data = {
                    \'res\':consume(ResTime.timing.responseEnd - ResTime.timing.responseStart),
                };
                return data;
            }
            function ResponseTime(){
                $(function(){
                     let res = AS_ResTime().res;
                     function consume(time) {
                         return time + "ms";
                     };
                     $("ul.list-group.box-shadow-wrap-normal").append("<li class=\"list-group-item text-second\"><span class=\"blog-info-icons\">'.$time.'</span><span class=\"badge pull-right\" style=\"background-color: '.$color[array_rand($color)].'\">"+res+"</span>响应耗时</li>");
                 });
           }
           //ResponseTime();
            </script>';
            Helper::options()->ChangeAction .= "TotalVisit();ResponseTime();";
        }

        if(Helper::options()->plugin('PrettyHandsome')->timeinfo==1){
            echo '<style>
            .sidebar-count .content{padding:15px}.sidebar-count .content .item{margin-bottom:15px}.sidebar-count .content .item:last-child{margin-bottom:0}.sidebar-count .content .item .title{font-size:12px;color:var(--minor);margin-bottom:5px;display:flex;align-items:center}.sidebar-count .content .item .title span{color:var(--theme);font-weight:500;font-size:14px;margin:0 5px}.sidebar-count .content .item .progress{display:flex;align-items:center;background-color:transparent}.sidebar-count .content .item .progress .progress-bar{height:10px;border-radius:5px;overflow:hidden;background:#ebeef5;width:0;min-width:0;flex:1;margin-right:5px}html.theme-dark .sidebar-count .content .item .progress .progress-bar{background:#414243;}@keyframes progress{0%{background-position:0 0}100%{background-position:30px 0}}.sidebar-count .content .item .progress .progress-bar .progress-inner{width:0;height:100%;border-radius:5px;transition:width .35s;-webkit-animation:progress 750ms linear infinite;animation:progress 750ms linear infinite}.sidebar-count .content .item .progress .progress-bar .progress-inner-1{background:#bde6ff;background-image:linear-gradient(135deg,#50bfff 25%,transparent 25%,transparent 50%,#50bfff 50%,#50bfff 75%,transparent 75%,transparent 100%);background-size:30px 30px}.sidebar-count .content .item .progress .progress-bar .progress-inner-2{background:#ffd980;background-image:linear-gradient(135deg,#f7ba2a 25%,transparent 25%,transparent 50%,#f7ba2a 50%,#f7ba2a 75%,transparent 75%,transparent 100%);background-size:30px 30px}.sidebar-count .content .item .progress .progress-bar .progress-inner-3{background:#ffa9a9;background-image:linear-gradient(135deg,#ff4949 25%,transparent 25%,transparent 50%,#ff4949 50%,#ff4949 75%,transparent 75%,transparent 100%);background-size:30px 30px}.sidebar-count .content .item .progress .progress-bar .progress-inner-4{background:#67c23a;background-image:linear-gradient(135deg,#4f9e28 25%,transparent 25%,transparent 50%,#4f9e28 50%,#4f9e28 75%,transparent 75%,transparent 100%);background-size:30px 30px}.sidebar-count .content .item .progress .progress-percentage{color:var(--info)}#time_info{padding-bottom:0}
            </style>';
            echo '<script type="text/javascript">
            function AddTimeInfo() {
                $("#widget-tabs-4-hots").after(\'<section id="time_info"class="widget widget_categories wrapper-md clear"><h5 class="widget-title m-t-none text-md">时间流逝</h5><div class="sidebar sidebar-count"><div class="content"><div class="item"id="dayProgress"><div class="title">今日已经过去<span></span>小时</div><div class="progress"><div class="progress-bar"><div class="progress-inner progress-inner-1"></div></div><div class="progress-percentage"></div></div></div><div class="item"id="weekProgress"><div class="title">这周已经过去<span></span>天</div><div class="progress"><div class="progress-bar"><div class="progress-inner progress-inner-2"></div></div><div class="progress-percentage"></div></div></div><div class="item"id="monthProgress"><div class="title">本月已经过去<span></span>天</div><div class="progress"><div class="progress-bar"><div class="progress-inner progress-inner-3"></div></div><div class="progress-percentage"></div></div></div><div class="item"id="yearProgress"><div class="title">今年已经过去<span></span>个月</div><div class="progress"><div class="progress-bar"><div class="progress-inner progress-inner-4"></div></div><div class="progress-percentage"></div></div></div></div></div></section>\')
                function getAsideLifeTime() {
                    let nowDate = +new Date();
                    let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
                    let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
                    let todayPassHoursPercent = (todayPassHours / 24) * 100;
                    $(\'#dayProgress .title span\').html(parseInt(todayPassHours));
                    $(\'#dayProgress .progress .progress-inner\').css(\'width\', parseInt(todayPassHoursPercent) + \'%\');
                    $(\'#dayProgress .progress .progress-percentage\').html(parseInt(todayPassHoursPercent) + \'%\');
                    let weeks = {
                        0: 7,
                        1: 1,
                        2: 2,
                        3: 3,
                        4: 4,
                        5: 5,
                        6: 6
                    };
                    let weekDay = weeks[new Date().getDay()];
                    let weekDayPassPercent = (weekDay / 7) * 100;
                    $(\'#weekProgress .title span\').html(weekDay);
                    $(\'#weekProgress .progress .progress-inner\').css(\'width\', parseInt(weekDayPassPercent) + \'%\');
                    $(\'#weekProgress .progress .progress-percentage\').html(parseInt(weekDayPassPercent) + \'%\');
                    let year = new Date().getFullYear();
                    let date = new Date().getDate();
                    let month = new Date().getMonth() + 1;
                    let monthAll = new Date(year, month, 0).getDate();
                    let monthPassPercent = (date / monthAll) * 100;
                    $(\'#monthProgress .title span\').html(date);
                    $(\'#monthProgress .progress .progress-inner\').css(\'width\', parseInt(monthPassPercent) + \'%\');
                    $(\'#monthProgress .progress .progress-percentage\').html(parseInt(monthPassPercent) + \'%\');
                    let yearPass = (month / 12) * 100;
                    $(\'#yearProgress .title span\').html(month);
                    $(\'#yearProgress .progress .progress-inner\').css(\'width\', parseInt(yearPass) + \'%\');
                    $(\'#yearProgress .progress .progress-percentage\').html(parseInt(yearPass) + \'%\')
                }
                getAsideLifeTime();
                setInterval(() => {
                    getAsideLifeTime()
                }, 1000)
            };
            AddTimeInfo();
            </script>';
            Helper::options()->ChangeAction .= 'AddTimeInfo();';
        }

        if(Helper::options()->plugin('PrettyHandsome')->colorToc==1){
            $color = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];
            // 加入 PJAX 回调函数
            Helper::options()->ChangeAction .= 'let leftHeader=document.querySelectorAll("span.nav-icon>svg,span.nav-icon>i");let leftHeaderColorArr=["#7887EB","#ABDEF3", "#6CC3E8", "#86DEF3", "#7887EB", "#9BA8F5","#7988EC","#B3BCF5","#ABDEF3","#B3BCD7","#91D7F3","#7988EC","#9CD2E9","#9BA8F5","#B3BCF5"];leftHeader.forEach(tag=>{tagsColor=leftHeaderColorArr[Math.floor(Math.random()*leftHeaderColorArr.length)];tag.style.color=tagsColor});';
        }

        if(Helper::options()->plugin('PrettyHandsome')->colorTag==1){
            $color = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];
            // 加入 PJAX 回调函数
            Helper::options()->ChangeAction .= 'let tags = document.querySelectorAll("#tag_cloud-2 a,.list-group-item .pull-right");let colorArr = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];tags.forEach(tag =>{tagsColor = colorArr[Math.floor(Math.random() * colorArr.length)];tag.style.backgroundColor = tagsColor;tag.style.color = "#ffffff"});';
        }
        
        //鼠标经过头像旋转和放大
        if(Helper::options()->plugin('PrettyHandsome')->avatarCircle==1){
            echo '<style>
            .img-circle {border-radius: 50%;animation: light 4s ease-in-out infinite;transition: all 0.5s;}.img-circle:hover {transform: scale(1.15) rotate(720deg);
            }@keyframes light {0% {box-shadow: 0 0 4px #f00;}25% {box-shadow: 0 0 16px #0f0;}50% {box-shadow: 0 0 4px #00f;}75% {box-shadow: 0 0 16px #0f0;}100% {box-shadow: 0 0 4px #f00;}}
            </style>';
        }
        // 文章标题居中
        if(Helper::options()->plugin('PrettyHandsome')->titleCenter==1){
            echo '<style>
            header.bg-light.lter.wrapper-md {
                text-align: center;
            }
            </style>';
        }
        // LOGO扫光
        if(Helper::options()->plugin('PrettyHandsome')->logoScan==1){
            echo '<style>
            .navbar-brand{position:relative;overflow:hidden;margin: 0px 0 0 0px;}.navbar-brand:before{content:""; position: absolute; left: -665px; top: -460px; width: 200px; height: 15px; background-color: rgba(255,255,255,.5); -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); -ms-transform: rotate(-45deg); -o-transform: rotate(-45deg); transform: rotate(-45deg); -webkit-animation: searchLights 6s ease-in 0s infinite; -o-animation: searchLights 6s ease-in 0s infinite; animation: searchLights 6s ease-in 0s infinite;}@-moz-keyframes searchLights{50%{left: -100px; top: 0;} 65%{left: 120px; top: 100px;}}@keyframes searchLights{40%{left: -100px; top: 0;} 60%{left: 120px; top: 100px;} 80%{left: -100px; top: 0px;}}
            </style>';
        }
        // 标题背景颜色自定义
        if(Helper::options()->plugin('PrettyHandsome')->htitlebg){
            $htitlebg = Helper::options()->plugin('PrettyHandsome')->htitlebg;
            echo '<style>
            #post-content h1, #post-content h2 {
                background : linear-gradient(to bottom,transparent 60%,rgba('. $htitlebg . ',.38) 0) no-repeat !important
                }
            </style>';
        }
    }

    /**
     *为footer添加js文件
     *@access public
     *@return void
     */
    public static function footer() {

        if(Helper::options()->plugin('PrettyHandsome')->postCopyrightTip==1){
            echo <<<HTML
            <script>
            if($("#post-content > div.support-author").length){addCopyrightTip();}
            </script>
HTML;
        }

        if(Helper::options()->plugin('PrettyHandsome')->baiduPush==1){
            echo <<<HTML
            <script>
            if($("#post-content > div.show-foot > div.notebook").length){addPushToBaiduBtn();}
            </script>
HTML;
        }

        if(Helper::options()->plugin('PrettyHandsome')->postQRcode==1){
            echo <<<HTML
            <script>addQRCodeIcon();if($("#qrcode").length){generateQRCode();}
            </script>
HTML;
        }

        if(Helper::options()->plugin('PrettyHandsome')->postEndMark==1){
            echo <<<HTML
            <script>addEndMark()</script>
HTML;
        }

        if(Helper::options()->plugin('PrettyHandsome')->siteInfo==1){
            echo '<script>TotalVisit();ResponseTime();</script>';
        }

        if(Helper::options()->plugin('PrettyHandsome')->siteSpendTime==1 ){
            echo '<script>
            window.setInterval(function () {
            var times = new Date().getTime() - Date.parse("'.Helper::options()->plugin('PrettyHandsome')->siteBegin.'");
            times = Math.floor(times / 1000); 
            var days = Math.floor(times / (60 * 60 * 24)); 
            times %= 60 * 60 * 24; //subtract entire days
            var hours = Math.floor(times / (60 * 60)); 
            times %= 60 * 60; //subtract entire hours
            var minutes = Math.floor(times / 60);
            times %= 60; //subtract entire minutes
            var seconds = Math.floor(times / 1); 
            $(\'#uptime\').html(days + \' 天 \' + hours + \' 时 \' + minutes + \' 分 \' + seconds + \' 秒 \');
        }, 1000); 
            </script>';
        }
        if(Helper::options()->plugin('PrettyHandsome')->timeinfo==1){
            echo '<script>AddTimeInfo()</script>';
        }
        if(Helper::options()->plugin('PrettyHandsome')->weather==1 and Helper::options()->plugin('PrettyHandsome')->weatherUID and Helper::options()->plugin('PrettyHandsome')->weatherHash){
            echo <<<HTML
            <script>
                $("#header_right > ul").prepend('<div id="tp-weather-widget" class="navbar-form navbar-form-sm navbar-left shift"></div>')
            </script>
            <script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
HTML;
            echo '<script>tpwidget("init", {
                "flavor": "slim",
                "location": "WX4FBXXFKE4F",
                "geolocation": "enabled",
                "language": "auto",
                "unit": "c",
                "theme": "chameleon",
                "container": "tp-weather-widget",
                "bubble": "enabled",
                "alarmType": "badge",
                "color": "#C6C6C6",
                "uid": "'.Helper::options()->plugin('PrettyHandsome')->weatherUID.'",
                "hash": "'.Helper::options()->plugin('PrettyHandsome')->weatherHash.'"
               });
               tpwidget("show");</script>';
            
        }
        if(Helper::options()->plugin('PrettyHandsome')->colorToc==1){
            $color = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];
            echo '<script>
            let leftHeader=document.querySelectorAll("span.nav-icon>svg,span.nav-icon>i");let leftHeaderColorArr=["#7887EB","#ABDEF3", "#6CC3E8", "#86DEF3", "#7887EB", "#9BA8F5","#7988EC","#B3BCF5","#ABDEF3","#B3BCD7","#91D7F3","#7988EC","#9CD2E9","#9BA8F5","#B3BCF5"];leftHeader.forEach(tag=>{tagsColor=leftHeaderColorArr[Math.floor(Math.random()*leftHeaderColorArr.length)];tag.style.color=tagsColor});</script>';
        }
        if(Helper::options()->plugin('PrettyHandsome')->colorTag==1){
            $color = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];
            echo '<script>
            let tags = document.querySelectorAll("#tag_cloud-2 a,.list-group-item .pull-right");let colorArr = ["#428BCA", "#AEDCAE", "#ECA9A7", "#DA99FF", "#FFB380", "#D9B999"];tags.forEach(tag =>{tagsColor = colorArr[Math.floor(Math.random() * colorArr.length)];tag.style.backgroundColor = tagsColor;tag.style.color = "#ffffff"});</script>';
        }
        // 鼠标点击特效
        if(Helper::options()->plugin('PrettyHandsome')->clickWord==1){
            echo '<script type="text/javascript"> 
            var a_idx = 0; 
            jQuery(document).ready(function($) { 
                $("body").click(function(e) { 
                    var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正" ,"法治", "爱国", "敬业", "诚信", "友善"); 
                    var $i = $("<span/>").text(a[a_idx]); 
                    a_idx = (a_idx + 1) % a.length; 
                    var x = e.pageX, 
                    y = e.pageY; 
                    $i.css({ 
                        "z-index": 999999999999999999999999999999999999999999999999999999999999999999999, 
                        "top": y - 20, 
                        "left": x, 
                        "position": "absolute", 
                        "font-weight": "bold", 
                        "color": "#ff6651" 
                    }); 
                    $("body").append($i); 
                    $i.animate({ 
                        "top": y - 180, 
                        "opacity": 0 
                    }, 
                    1500, 
                    function() { 
                        $i.remove(); 
                    }); 
                }); 
            }); 
            </script>';
        }
        if(Helper::options()->plugin('PrettyHandsome')->copyTip==1){
            /* $author = Helper::options()->plugin('PrettyHandsome')->copyAuthor */
            echo '<script>
            kaygb_copy();function kaygb_copy(){$(document).ready(function(){$("body").bind("copy",function(e){hellolayer()})});var sitesurl=window.location.href;function hellolayer(){
            $.message({
                message: "尊重原创，转载请注明出处！<br>"+sitesurl,
                title: "复制成功",
                type: "success",
                autoHide: !1,
                time: "5000"
                })
            }}
            </script>';
        }
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
                    return '<iframe title="iframe" src="'. Helper::options()->plugin('PrettyHandsome')->dyapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                case "bilibili":
                    return '<iframe title="iframe" src="' . $text . '&as_wide=1&high_quality=1&danmaku=0" frameborder="no" framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
                default:
                    return '<iframe title="iframe" src="' . Helper::options()->plugin('PrettyHandsome')->videoapi . $text . '" frameborder="no"  framespacing="0" border="0" scrolling="no" allowfullscreen="true" class="iframe_video"></iframe>';
            }
		});
	}
    // 访问总数 		
	static function TotalVisit(){
	    
        $db = Typecho_Db::get();
        
	    $query = $db->select('SUM(views)')->from('table.contents'); 
	    
	    $result = $db->fetchAll($query);
	    
	    return number_format($result[0]['SUM(`views`)']);
    }

}