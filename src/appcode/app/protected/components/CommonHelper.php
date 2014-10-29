<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/26
 * Time: 22:18
 */

class CommonHelper {

    static public function formatArrayData($data_list){
        $ret_list = array();
        foreach ($data_list as $data) {
            array_push($ret_list, $data->getAttributes());
        }
        return $ret_list;
    }
} 