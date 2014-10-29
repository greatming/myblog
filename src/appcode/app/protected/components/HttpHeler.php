<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/27
 * Time: 23:49
 */

class HttpHeler {

    static public function getGET($key){
        if(isset($_GET[$key]))
            return $_GET[$key];
        else{
            if(func_num_args() > 1){
                return func_get_arg(1);
            }
        }
        return false;
    }
} 