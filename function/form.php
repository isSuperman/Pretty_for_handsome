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

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $siteInfo = new Typecho_Widget_Helper_Form_Element_Radio('siteInfo', $list, 0, _t('响应耗时和访客总数'), '');

        return $siteInfo;
    }    

    // 时光流逝
    static function TimeInfo(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $timeinfo = new Typecho_Widget_Helper_Form_Element_Radio('timeinfo', $list, 0, _t('右侧边栏时光流逝模块'), '');

        return $timeinfo;
    }

    // 顶部导航栏天气
    static function Weather(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $weather = new Typecho_Widget_Helper_Form_Element_Radio('weather', $list, 0, _t('顶部导航栏天气'), _t('登录<a href="https://www.seniverse.com">心知天气官网</a>注册申请免费API 密钥'));

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

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $colorToc = new Typecho_Widget_Helper_Form_Element_Radio('colorToc', $list, 0, _t('彩色目录图标'), '');

        return $colorToc;
    }

    // 彩色标签云
    static function ColorTag(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $colorTag = new Typecho_Widget_Helper_Form_Element_Radio('colorTag', $list, 0, _t('彩色标签'), '');

        return $colorTag;
    }

    // 鼠标经过头像旋转放大
    static function AvatarCircle(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $avatarCircle = new Typecho_Widget_Helper_Form_Element_Radio('avatarCircle', $list, 0, _t('鼠标经过头像旋转和放大'), '');

        return $avatarCircle;
    }

    // 鼠标点击特效
    static function ClickWord(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $clickWord = new Typecho_Widget_Helper_Form_Element_Radio('clickWord', $list, 0, _t('鼠标点击特效'), '');

        return $clickWord;
    }

    // 文章标题居中
    static function TitleCenter(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $titleCenter = new Typecho_Widget_Helper_Form_Element_Radio('titleCenter', $list, 0, _t('文章标题居中'), '');

        return $titleCenter;
    }

    // LOGO扫光
    static function LogoScan(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $logoScan = new Typecho_Widget_Helper_Form_Element_Radio('logoScan', $list, 0, _t('LOGO扫光'), '');

        return $logoScan;
    }

    // 复制成功提示
    static function CopyTip(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $copyTip = new Typecho_Widget_Helper_Form_Element_Radio('copyTip', $list, 0, _t('复制成功提示'), '');

        return $copyTip;
    }

    // H1/H2标题背景颜色
    static function HTitlebg(){
        $htitlebg = new Text('htitlebg', null, '0,191,255', _t('H1/H2标题背景颜色'),_t('RGB颜色代码'));

        return $htitlebg;
    }

    // 打赏按钮跳动
    static function ZanBump(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $zanBump = new Typecho_Widget_Helper_Form_Element_Radio('zanBump', $list, 0, _t('打赏按钮跳动'), '');

        return $zanBump;
    }

    // 移动端禁止显示标签云和博客信息
    static function MobileHideInfo(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $mobileHideInfo = new Typecho_Widget_Helper_Form_Element_Radio('mobileHideInfo', $list, 0, _t('移动端禁止显示标签云和博客信息'), '');

        return $mobileHideInfo;
    }

    // 首页文章鼠标经过上浮
    static function IndexPostWave(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $indexPostWave = new Typecho_Widget_Helper_Form_Element_Radio('indexPostWave', $list, 0, _t('首页文章鼠标经过上浮'), '');

        return $indexPostWave;
    }

    // 文章页头图悬浮
    static function PostThumbImgWave(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $postThumbImgWave = new Typecho_Widget_Helper_Form_Element_Radio('postThumbImgWave', $list, 0, _t('文章页头图悬浮'), '');

        return $postThumbImgWave;
    }

    // 网站运行时间
    static function SiteSpendTime(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $siteSpendTime = new Typecho_Widget_Helper_Form_Element_Radio('siteSpendTime', $list, 0, _t('网站运行时间'), _t('在合适的地方添加代码<span style="color:red">&lt;span id="uptime"&gt;&lt;/span&gt;</span>'));

        return $siteSpendTime;
    }

    // 网站开始时间
    static function SiteBegin(){
        $siteBegin = new Text('siteBegin', null, '2020-01-09', _t('网站开始时间'),_t('严格按照给定格式填写'));

        return $siteBegin;
    }

    // 文章end标识
    static function PostEndMark(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $postEndMark = new Typecho_Widget_Helper_Form_Element_Radio('postEndMark', $list, 0, _t('文章end标识'), '');

        return $postEndMark;
    }

    // 文章二维码
    static function PostQRCode(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $postQRcode = new Typecho_Widget_Helper_Form_Element_Radio('postQRcode', $list, 0, _t('文章二维码'), '');

        return $postQRcode;
    }

    // 百度手动提交按钮
    static function BaiduPushBtn(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $baiduPush = new Typecho_Widget_Helper_Form_Element_Radio('baiduPush', $list, 0, _t('百度手动提交'), _t('在文章底部修改日期旁边增加手动提交百度按钮'));

        return $baiduPush;
    }

    // 全站黑白模式
    static function SiteBlackWhite(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $siteBlackWhite = new Typecho_Widget_Helper_Form_Element_Radio('siteBlackWhite', $list, 0, _t('全站黑白模式'), _t('适合某些日期开启'));

        return $siteBlackWhite;
    }

    // 文章版权提示
    static function PostCopyrightTip(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $postCopyrightTip = new Typecho_Widget_Helper_Form_Element_Radio('postCopyrightTip', $list, 0, _t('文章版权提示'), _t('位于文章底部'));

        return $postCopyrightTip;
    }

    // 评论边框
    static function CommentBorder(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $commentBorder = new Typecho_Widget_Helper_Form_Element_Radio('commentBorder', $list, 0, _t('显示评论边框和阴影'), '');

        return $commentBorder;
    }

    // 评论边框颜色RGB
    static function CommentBorderRGB(){
        $commentBorderRGB = new Text('commentBorderRGB', null, '0,191,255', _t('评论边框颜色RGB'),_t('RGB颜色代码'));

        return $commentBorderRGB;
    }


    // 首页轮播图优化
    static function IndexSwiperPicStyle(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $indexSwiperPicStyle = new Typecho_Widget_Helper_Form_Element_Radio('indexSwiperPicStyle', $list, 0, _t('首页轮播图优化'), _t('降低背景图片亮度等'));

        return $indexSwiperPicStyle;
    }

    // 首页图片版式优化
    static function IndexHeadImageStyle(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $indexHeadImageStyle = new Typecho_Widget_Helper_Form_Element_Radio('indexHeadImageStyle', $list, 0, _t('首页图片版式优化'), _t('增加文章题目背景颜色'));

        return $indexHeadImageStyle;
    }

    // 评论头像呼吸效果
    static function CommentAvatarBreath(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $commentAvatarBreath = new Typecho_Widget_Helper_Form_Element_Radio('commentAvatarBreath', $list, 0, _t('显示评论头像呼吸效果'), _t('<br />***问题和反馈请到&nbsp;<a href="https://blog.icolak.com/program/472.html" rel="nofollow">插件发布页</a>，新功能不定时更新，请多多关注！***'));

        return $commentAvatarBreath;
    }
	
	// 动态背景
	static function DynamicBackground(){
		$list = [
			'a0.js'     => '不使用动态背景',
			'a1.js'     => '黑客帝国001',
			'a2.js'     => '黑客帝国002',
			'a3.js'     => '磁力线条',
			'a4.js'     => '浮动气泡',
			'a5.js'     => '七色彩虹',
			'a6.js'     => '下雨背景',
			'a7.js'     => '彩色气球[推荐]',
			'a8.js'     => '彩色爱心',
			'a9.js'     => '科技背景',
			'b1.js'     => '蓝色气泡',
			'b2.js'     => '漫漫星空[推荐]',
			'b3.js'     => '海平面',
			'b4.js'     => '随机色带',
			'b5.js'     => '气泡背景[推荐]',
			'b6.js'     => '旋转特效',
			'b7.js'     => '磁感线',
			'b8.js'     => '互动星空',
			'b9.js'     => '旋转星空',
			];
		
        $dynamicBackground = new Typecho_Widget_Helper_Form_Element_Select('dynamicBackground', $list, 'a7.js', _t('动态背景'), _t('动态背景的渲染会占用终端用户的内存，如果您的用户不是十几年前的机型，影响可以忽略不计'));
        
        return $dynamicBackground;
	}
    // 移动端隐藏动态背景
    static function MobileHideDyBackground(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $mobileHideDyBackground = new Typecho_Widget_Helper_Form_Element_Radio('mobileHideDyBackground', $list, 0, _t('移动端隐藏动态背景'), _t(''));

        return $mobileHideDyBackground;
    }
    // 夜间模式隐藏动态背景
    static function ThemeDarkHideDyBackground(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $themeDarkHideDyBackground = new Typecho_Widget_Helper_Form_Element_Radio('themeDarkHideDyBackground', $list, 0, _t('夜间模式隐藏动态背景'), _t(''));

        return $themeDarkHideDyBackground;
    }
    // 设置静态背景图片开关
    static function StaticBackgroundImage(){

        $list = [
            0 => '关闭',
            1 => '开启'
        ];

        $staticBackgroundImage = new Typecho_Widget_Helper_Form_Element_Radio('StaticBackgroundImage', $list, 0, _t('静态背景图片开关'), _t(''));

        return $staticBackgroundImage;
    }
    // 设置静态背景图片
    static function StaticBackgroundImageUrl(){

        $bgimg = new Text('bgimg', null, '', _t('静态背景图片'), _t('http://example.com/xxx.jpg'));

        return $bgimg;
    }
}