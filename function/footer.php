<?php
	
/*
 * 作者：isSuperman
 * 地址：https://github.com/isSuperman/Pretty_for_handsome
 */
 
class PluginsFooter{

    // 配置插件
    static function SettingFooter(){
        
        // 文章底部版权提示
        if(Helper::options()->plugin('PrettyHandsome')->postCopyrightTip==1){
            echo '<script>if($("#post-content > div.support-author").length){addCopyrightTip();};</script>';
        }

        // 百度推送按钮
        if(Helper::options()->plugin('PrettyHandsome')->baiduPush==1){
            echo '<script>if($("#post-content > div.show-foot > div.notebook").length){addPushToBaiduBtn();};</script>';
        }

        // 文章二维码
        if(Helper::options()->plugin('PrettyHandsome')->postQRcode==1){
            echo '<script>addQRCodeIcon();if($("#qrcode").length){generateQRCode();};</script>';
        }

        // 文章end标识
        if(Helper::options()->plugin('PrettyHandsome')->postQRcopostEndMarkde==1){
            echo '<script>addEndMark();</script>';
        }

        // 访客数量和响应耗时
        if(Helper::options()->plugin('PrettyHandsome')->siteInfo==1){
            echo '<script>TotalVisit();ResponseTime();</script>';
        }

        // 网站运行时间
        if(Helper::options()->plugin('PrettyHandsome')->siteSpendTime==1){
            echo '<script>window.setInterval(function(){var times=new Date().getTime()-Date.parse("'.Helper::options()->plugin('PrettyHandsome')->siteBegin.'");times=Math.floor(times/1000);var days=Math.floor(times/(60*60*24));times%=60*60*24;var hours=Math.floor(times/(60*60));times%=60*60;var minutes=Math.floor(times/60);times%=60;var seconds=Math.floor(times/1);$("#uptime").html(days+" 天 "+hours+" 时 "+minutes+" 分 "+seconds+" 秒 ")},1000);</script>';
        }

        // 时光流逝
        if(Helper::options()->plugin('PrettyHandsome')->timeinfo==1){
            echo '<script>AddTimeInfo()</script>';
        }

        // 天气
        if(Helper::options()->plugin('PrettyHandsome')->weather==1){
            $weatherUID = Helper::options()->plugin('PrettyHandsome')->weatherUID;
            $weatherHash = Helper::options()->plugin('PrettyHandsome')->weatherHash;
            echo '<script>$("#header_right > ul").prepend(\'<div id="tp-weather-widget" class="navbar-form navbar-form-sm navbar-left shift"></div>\');(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"));tpwidget("init",{"flavor":"slim","location":"WX4FBXXFKE4F","geolocation":"enabled","language":"auto","unit":"c","theme":"chameleon","container":"tp-weather-widget","bubble":"enabled","alarmType":"badge","color":"#C6C6C6","uid":"'.$weatherUID.'","hash":"'.$weatherHash.'"});tpwidget("show");</script>';
        }

        // 彩色目录
         if(Helper::options()->plugin('PrettyHandsome')->colorToc==1){
            echo '<script>colorToc();</script>';
        }

        // 彩色标签云
        if(Helper::options()->plugin('PrettyHandsome')->colorTag==1){
            echo '<script>colorTag();</script>';
        }

        // 鼠标点击特效
        if(Helper::options()->plugin('PrettyHandsome')->clickWord==1){
            echo '<script>var a_idx=0;jQuery(document).ready(function($){$("body").click(function(e){var a=new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");var $i=$("<span/>").text(a[a_idx]);a_idx=(a_idx+1)%a.length;var x=e.pageX,y=e.pageY;$i.css({"z-index":1e+69,"top":y-20,"left":x,"position":"absolute","font-weight":"bold","color":"#ff6651"});$("body").append($i);$i.animate({"top":y-180,"opacity":0},1500,function(){$i.remove()})})});</script>';
        }

        // 复制提示
        if(Helper::options()->plugin('PrettyHandsome')->copyTip==1){
            echo '<script>kaygb_copy();function kaygb_copy(){$(document).ready(function(){$("body").bind("copy",function(e){hellolayer()})});var sitesurl=window.location.href;function hellolayer(){$.message({message: "尊重原创，转载请注明出处！<br>"+sitesurl,title: "复制成功",type: "success",autoHide: !1,time: "5000"})}}</script>';
        }
}
}