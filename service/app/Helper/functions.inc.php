<?php
/**
 *  为了方便引入一些常用函数，以及其他项目转移过来的函数，少用
 *  @author  wangzhoudong  <wangzhoudong@foxmail.com>
 *  @version    1.0
 *
 */

/**
 * 生成双色球的详情
 *
 *
 */

if( ! function_exists('getSSQDesc'))
{
    function getSSQDesc($red1,$red2,$red3,$red4,$red5,$red6,$blue)
    {
        $red1 =  str_pad($red1,2,"0",STR_PAD_LEFT);
        $red2 =  str_pad($red2,2,"0",STR_PAD_LEFT);
        $red3 =  str_pad($red3,2,"0",STR_PAD_LEFT);
        $red4 =  str_pad($red4,2,"0",STR_PAD_LEFT);
        $red5 =  str_pad($red5,2,"0",STR_PAD_LEFT);
        $red6 =  str_pad($red6,2,"0",STR_PAD_LEFT);
        $blue =  str_pad($blue,2,"0",STR_PAD_LEFT);
        return $red1 . " " . $red2 . " " . $red3 . " " . $red4 . " " . $red5 . " " . $red6 . " " . $blue;
    }
}
/**
 * 生成双手球的唯一MD5
 *
 */

if( ! function_exists('getSSQDescMd5'))
{
    function getSSQDescMd5($desc)
    {
        return md5($desc);
    }
}

