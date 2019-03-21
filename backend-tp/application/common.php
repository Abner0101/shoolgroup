<?php

/**
 * 行为绑定
 */
\think\Hook::add('app_init','app\\common\\behavior\\InitConfigBehavior');

/**
 * 返回对象
 * @param $array 响应数据
 */
function resultArray($array)
{
    if(isset($array['data'])) {
        $array['error'] = '';
        $code = 200;
    } elseif (isset($array['error'])) {
        $code = 400;
        $array['data'] = '';
    }
    return [
        'code'  => $code,
        'data'  => $array['data'],
        'error' => $array['error']
    ];
}
/**
 * 返回对象
 * @param $array 响应数据
 */
function resultJsonp($array)
{
    if(isset($array['data'])) {
        $array['error'] = '';
        $code = 200;
    } elseif (isset($array['error'])) {
        $code = 400;
        $array['data'] = '';
    }
    return jsonp([
        'code'  => $code,
        'data'  => $array['data'],
        'error' => $array['error']
    ]);
}
/**
 * 调试方法
 * @param  array   $data  [description]
 */
function p($data,$die=1)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if ($die) die;
}

/**
 * 用户密码加密方法
 * @param  string $str      加密的字符串
 * @param  [type] $auth_key 加密符
 * @return string           加密后长度为32的字符串
 */
function user_md5($str, $auth_key = '')
{
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}


// 应用公共文件
function get( $url, $_header = NULL )
{
    $curl = curl_init();
    //curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false);
    if( stripos($url, 'https://') !==FALSE )
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if ( $_header != NULL )
    {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $_header);
    }
    $ret    = curl_exec($curl);
    $info   = curl_getinfo($curl);
    curl_close($curl);

    if( intval( $info["http_code"] ) == 200 )
    {
        return $ret;
    }

    return false;
}
/*
 * post method
 */
function post( $url, $param )
{
    $oCurl = curl_init ();
    // curl_setopt ( $oCurl, CURLOPT_SAFE_UPLOAD, false);
    if (stripos ( $url, "https://" ) !== FALSE) {
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
    }

    curl_setopt ( $oCurl, CURLOPT_URL, $url );
    curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $oCurl, CURLOPT_POST, true );
    curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $param );
    $sContent = curl_exec ( $oCurl );
    $aStatus = curl_getinfo ( $oCurl );
    curl_close ( $oCurl );
    if (intval ( $aStatus ["http_code"] ) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

