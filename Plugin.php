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
        /** 抖音解析API */
        // $dyapi = new Text('dyapi', null, 'http://example.com/?url=', _t('抖音解析API'));
        $dyapi = new Text('dyapi', null, 'https://jx.parwix.com:4433/player/?url=', _t('抖音解析API'));
        $form->addInput($dyapi);
        /** 抖音解析API */
        // $videoapi = new Text('videoapi', null, 'http://example.com/?url=', _t('其他视频云解析API'));
        $videoapi = new Text('videoapi', null, 'https://jx.parwix.com:4433/player/?url=', _t('其他视频云解析API'));
        $form->addInput($videoapi);
        $timeinfo = new Typecho_Widget_Helper_Form_Element_Radio('timeinfo', array(0 => '关闭', 1 => '开启'), 0, _t('右侧边栏时光流逝模块'), '');
        $form->addInput($timeinfo);
        $weather = new Typecho_Widget_Helper_Form_Element_Radio('weather', array(0 => '关闭', 1 => '开启'), 0, _t('顶部导航栏天气'), '登录<a href="https://www.seniverse.com">心知天气官网</a>注册申请免费API 密钥');
        $form->addInput($weather);
        $weatherUID = new Text('weatherUID', null, '', _t('心知天气公钥'));
        $form->addInput($weatherUID);
        $weatherHash = new Text('weatherHash', null, '', _t('心知天气私钥'));
        $form->addInput($weatherHash);
        $typefire = new Typecho_Widget_Helper_Form_Element_Radio('typefire', array(0 => '关闭', 1 => '开启'), 0, _t('打字烟花效果'), '');
        $form->addInput($typefire);
        $siteInfo = new Typecho_Widget_Helper_Form_Element_Radio('siteInfo', array(0 => '关闭', 1 => '开启'), 0, _t('显示全站字数、在线人数、响应耗时和访客总数'), '');
        $form->addInput($siteInfo);
        $colorToc = new Typecho_Widget_Helper_Form_Element_Radio('colorToc', array(0 => '关闭', 1 => '开启'), 0, _t('彩色目录图标'), '');
        $form->addInput($colorToc);
        // complete
        $colorTag = new Typecho_Widget_Helper_Form_Element_Radio('colorTag', array(0 => '关闭', 1 => '开启'), 0, _t('彩色标签'), '');
        $form->addInput($colorTag);
        $avatarCircle = new Typecho_Widget_Helper_Form_Element_Radio('avatarCircle', array(0 => '关闭', 1 => '开启'), 0, _t('鼠标经过头像旋转和放大'), '');
        $form->addInput($avatarCircle);
        $clickWord = new Typecho_Widget_Helper_Form_Element_Radio('clickWord', array(0 => '关闭', 1 => '开启'), 0, _t('鼠标点击特效'), '');
        $form->addInput($clickWord);
        $titleCenter = new Typecho_Widget_Helper_Form_Element_Radio('titleCenter', array(0 => '关闭', 1 => '开启'), 0, _t('文章标题居中'), '');
        $form->addInput($titleCenter);
        $logoScan = new Typecho_Widget_Helper_Form_Element_Radio('logoScan', array(0 => '关闭', 1 => '开启'), 0, _t('LOGO扫光'), '');
        $form->addInput($logoScan);
        $copyTip = new Typecho_Widget_Helper_Form_Element_Radio('copyTip', array(0 => '关闭', 1 => '开启'), 0, _t('复制成功提示'), '');
        $form->addInput($copyTip);
        $htitlebg = new Text('htitlebg', null, '0,191,255', _t('H1/H2标题背景颜色'),'RGB颜色代码');
        $form->addInput($htitlebg);

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
            echo '<script>
            kaygb_copy();function kaygb_copy(){$(document).ready(function(){$("body").bind("copy",function(e){hellolayer()})});var sitesurl=window.location.href;function hellolayer(){
            $.message({
                message: "尊重原创，转载请注明出处！<br> 本文作者：苏为歌<br>原文链接：<br>"+sitesurl,
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

}