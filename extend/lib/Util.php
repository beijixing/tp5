<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/7/5
 * Time: 下午8:34
 */

namespace lib;


class Util
{
    public static function random_16() {
        $pr_bits = '';
        // Unix/Linux platform?
        $fp = @fopen('/dev/urandom','rb');
        if ($fp) {
            $pr_bits .= @fread($fp,16);
            @fclose($fp);
        }

        if ($pr_bits) {
            $pr_bits = md5($pr_bits);
        }

        return $pr_bits;
    }
}