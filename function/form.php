<?php

use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Widget\Options;

/*
 * 作者：isSuperman
 * 地址：https://github.com/isSuperman/Pretty_for_handsome
 */

class PluginsForm{

    // 抖音解析API
    static function DouyinApi(){
        $dyapi = new Text('dyapi', null, 'http://example.com/?url=', _t('抖音解析API'));

        return $dyapi;
    }

    // 其他视频解析API
    static function VideoApi(){
        $videoapi = new Text('videoapi', null, 'http://example.com/?url=', _t('其他视频云解析API'));

        return $videoapi;
    }

    // 响应耗时和访客总数
    static function SiteInfo(){
        $siteInfo = new Typecho_Widget_Helper_Form_Element_Radio('siteInfo', array(0 => '关闭', 1 => '开启'), 0, _t('响应耗时和访客总数'), '');

        return $siteInfo;
    }    

    // 时光流逝
    static function TimeInfo(){
        $timeinfo = new Typecho_Widget_Helper_Form_Element_Radio('timeinfo', array(0 => '关闭', 1 => '开启'), 0, _t('右侧边栏时光流逝模块'), '');

        return $timeinfo;
    }

    // 顶部导航栏天气
    static function Weather(){
        $weather = new Typecho_Widget_Helper_Form_Element_Radio('weather', array(0 => '关闭', 1 => '开启'), 0, _t('顶部导航栏天气'), '登录<a href="https://www.seniverse.com">心知天气官网</a>注册申请免费API 密钥');

        return $weather;
    }
    
    // 天气uid
    static function WeatherUID(){
        $weatherUID = new Text('weatherUID', null, '', _t('心知天气公钥'));
        
        return $weatherUID;
    }

    // 天气HASH
    static function WeatherHASH(){
        $weatherHash = new Text('weatherHash', null, '', _t('心知天气私钥'));

        return $weatherHash;
    }

    // 彩色目录图标
    static function ColorToc(){
        $colorToc = new Typecho_Widget_Helper_Form_Element_Radio('colorToc', array(0 => '关闭', 1 => '开启'), 0, _t('彩色目录图标'), '');

        return $colorToc;
    }

    // 彩色标签云
    static function ColorTag(){
        $colorTag = new Typecho_Widget_Helper_Form_Element_Radio('colorTag', array(0 => '关闭', 1 => '开启'), 0, _t('彩色标签'), '');

        return $colorTag;
    }

    // 鼠标经过头像旋转放大
    static function AvatarCircle(){
        $avatarCircle = new Typecho_Widget_Helper_Form_Element_Radio('avatarCircle', array(0 => '关闭', 1 => '开启'), 0, _t('鼠标经过头像旋转和放大'), '');

        return $avatarCircle;
    }

    // 鼠标点击特效
    static function ClickWord(){
        $clickWord = new Typecho_Widget_Helper_Form_Element_Radio('clickWord', array(0 => '关闭', 1 => '开启'), 0, _t('鼠标点击特效'), '');

        return $clickWord;
    }

    // 文章标题居中
    static function TitleCenter(){
        $titleCenter = new Typecho_Widget_Helper_Form_Element_Radio('titleCenter', array(0 => '关闭', 1 => '开启'), 0, _t('文章标题居中'), '');

        return $titleCenter;
    }

    // LOGO扫光
    static function LogoScan(){
        $logoScan = new Typecho_Widget_Helper_Form_Element_Radio('logoScan', array(0 => '关闭', 1 => '开启'), 0, _t('LOGO扫光'), '');

        return $logoScan;
    }

    // 复制成功提示
    static function CopyTip(){
        $copyTip = new Typecho_Widget_Helper_Form_Element_Radio('copyTip', array(0 => '关闭', 1 => '开启'), 0, _t('复制成功提示'), '');

        return $copyTip;
    }

    // H1/H2标题背景颜色
    static function HTitlebg(){
        $htitlebg = new Text('htitlebg', null, '0,191,255', _t('H1/H2标题背景颜色'),'RGB颜色代码');

        return $htitlebg;
    }

    // 打赏按钮跳动
    static function ZanBump(){
        $zanBump = new Typecho_Widget_Helper_Form_Element_Radio('zanBump', array(0 => '关闭', 1 => '开启'), 0, _t('打赏按钮跳动'), '');

        return $zanBump;
    }

    // 移动端禁止显示标签云和博客信息
    static function MobileHideInfo(){
        $mobileHideInfo = new Typecho_Widget_Helper_Form_Element_Radio('mobileHideInfo', array(0 => '关闭', 1 => '开启'), 0, _t('移动端禁止显示标签云和博客信息'), '');

        return $mobileHideInfo;
    }

    // 首页文章鼠标经过上浮
    static function IndexPostWave(){
        $indexPostWave = new Typecho_Widget_Helper_Form_Element_Radio('indexPostWave', array(0 => '关闭', 1 => '开启'), 0, _t('首页文章鼠标经过上浮'), '');

        return $indexPostWave;
    }

    // 网站运行时间
    static function SiteSpendTime(){
        $siteSpendTime = new Typecho_Widget_Helper_Form_Element_Radio('siteSpendTime', array(0 => '关闭', 1 => '开启'), 0, _t('网站运行时间'), '在合适的地方添加代码<span style="color:red">&lt;span id="uptime"&gt;&lt;/span&gt;</span>');

        return $siteSpendTime;
    }

    // 网站开始时间
    static function SiteBegin(){
        $siteBegin = new Text('siteBegin', null, '2020-01-09', _t('网站开始时间'),'严格按照给定格式填写');

        return $siteBegin;
    }

    // 文章end标识
    static function PostEndMark(){
        $postEndMark = new Typecho_Widget_Helper_Form_Element_Radio('postEndMark', array(0 => '关闭', 1 => '开启'), 0, _t('文章end标识'), '');

        return $postEndMark;
    }

    // 文章二维码
    static function PostQRCode(){
        $postQRcode = new Typecho_Widget_Helper_Form_Element_Radio('postQRcode', array(0 => '关闭', 1 => '开启'), 0, _t('文章二维码'), '');

        return $postQRcode;
    }

    // 百度手动提交按钮
    static function BaiduPushBtn(){
        $baiduPush = new Typecho_Widget_Helper_Form_Element_Radio('baiduPush', array(0 => '关闭', 1 => '开启'), 0, _t('百度手动提交'), '在文章底部修改日期旁边增加手动提交百度按钮');

        return $baiduPush;
    }

    // 全站黑白模式
    static function SiteBlackWhite(){
        $siteBlackWhite = new Typecho_Widget_Helper_Form_Element_Radio('siteBlackWhite', array(0 => '关闭', 1 => '开启'), 0, _t('全站黑白模式'), '适合某些日期开启');

        return $siteBlackWhite;
    }

    // 文章版权提示
    static function PostCopyrightTip(){
        $postCopyrightTip = new Typecho_Widget_Helper_Form_Element_Radio('postCopyrightTip', array(0 => '关闭', 1 => '开启'), 0, _t('文章版权提示'), '位于文章底部');

        return $postCopyrightTip;
    }
}