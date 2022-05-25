<?php
    /**
     * Baidu
     * @editer: Weifeng
     * @link: https://wfblog.net
     * @version: 1.0
     */
    
    error_reporting(0);
    header("Access-Control-Allow-Origin:*");
    header('Content-type: application/json');
    
    $domain = @$_GET['domain'];
    if(!isset($domain) || empty($domain) || $domain==''){
        $data = array(
            "code" => false,
            "msg" => "未传入请求参数！"
        );
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        exit;
    }
    if(substr($domain, -1) == '/'){
        $domain = substr($domain,0,strlen($domain)-1);
    }
    
    $data = checkBaidu($domain);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    
    function checkBaidu($url){
        $header = array(
            "Host:www.baidu.com",
            "Content-Type:application/x-www-form-urlencoded",//post请求
            "Connection: keep-alive",
            "Referer:https://www.baidu.com",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Safari/537.36"
        );
        $url = 'https://www.baidu.com/s?ie=UTF-8&wd='.urlencode($url).'&usm=3&rsv_idx=2&rsv_page=1';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(strpos($output, '没有找到') || strpos($output, '很抱歉')){
            $data = array(
                "code" => 403,
                "msg" => "该域名暂时未被百度收录！"
            );
        }else{
            $number = GetBetween($output,'<span class="nums_text">百度为您找到相关结果约','个</span>');
            if(empty($number) || $number == 0){
                $number = GetBetween($output,'<b>找到相关结果数约','个</b></p>');
                if(empty($number) || $number == 0){
                    $data = array(
                        "code" => false,
                        "msg" => "获取百度收录失败！"
                    );
                    return $data;
                }
            }
            $data = array(
                "code" => 200,
                "msg" => "该域名已被百度收录！",
                "number" => str_replace(',','',$number)
            );
        }
        return $data;
    }
    
    function GetBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
    }
    ?>