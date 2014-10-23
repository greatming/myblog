<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/10/18
 * Time: 0:55
 */

class CommonController extends Controller{

    public function actionUpload(){

        $file_arr = $_FILES['file'];
        $file_ext_name =  ltrim(strrchr(basename($file_arr['name']),"."),".");

        $webroot = YiiBase::getPathOfAlias("webroot");
        $attachment_dir = "/attachment/".date("Ym");
        if(!file_exists($webroot.$attachment_dir)) mkdir($webroot.$attachment_dir,0777,true);
        $file_upload_name = "/".time()."_".rand(1,1000).".".$file_ext_name;
        $file_upload_path = $webroot.$attachment_dir.$file_upload_name;
        if(move_uploaded_file($file_arr['tmp_name'],$file_upload_path)){
            $this->ajaxReturn(1,"上传成功",array("url"=>$attachment_dir.$file_upload_name));
        }
    }

    private function ajaxReturn($status,$info = "",$data = array()){
        echo json_encode(array("status"=>$status,"info"=>$info,"data"=>json_encode($data)));
    }

} 