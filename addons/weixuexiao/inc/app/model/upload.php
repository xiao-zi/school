<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/11
 * Time: 16:49
 */

/**
 * Class img 图片上传
 */
class upload{
    public $img_size = 20;
    public $type = array("gif", "jpeg", "jpg", "png");
    public $address = '/attachment/images/school/img/';

    /**
     * 检查文件格式
     * @param $temp
     * @return bool
     */
    public function check_temp($temp){
        if(in_array($temp,$this->type)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 检查文件大小
     * @param $size
     * @return bool
     */
    public function check_size($size){
//        1K=1Kb=1024b=8*1024 Bit
//        1M=1Mb=1024K=1024Kb=1024*1024B
//        1G=1Gb=1024M=1024Mb=1024*1024KB=10243B
//        1TB=1024GB=10242MB=10243KB=10244B=8*10244位
        return ($size < ($this->img_size *1024*1024)) ?  true:false;
    }
    /**
     * 检查临时文件是否存在
     * @param $tmp_name
     * @return bool
     */
    public function check_dir($tmp_name){
        return file_exists($tmp_name) ? true:false;
    }

    public function move_file($file){
        $date = date('Ymd',time());
        $file_root = IA_ROOT.'/attachment/'.$this->address.$date;
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        $this->make_all_dirs($file_root);
        // 判断当前目录下的 upload 目录是否存在该文件
        $file_name = explode(".", $file["name"]);
        $file_url = $this->address.$date."/" . $date.time().'.'.end($file_name);
        $url = IA_ROOT.'/attachment/'.$file_url;
        if(file_exists($url)){
            return array('status'=>false,'msg'=>'文件已经存在！');
        }else{
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($file["tmp_name"],$url);
            return array('status'=>true,'msg'=>$file_url);
        }
    }

    protected function make_all_dirs($file){
        $file_arr = explode('/',$file);
        $file = '';
        for($i=0;$i<count($file_arr);$i++){
            if($i==0){
                $file .= $file_arr[$i];
            }else{
                $file .= '/'.$file_arr[$i];
            }
            if(!is_dir($file)){
                mkdir($file,0777);
            }
        }
    }

    public function uploadFile($file){
        if ($file["file"]["error"] > 0){
            return array('status'=>false,'msg'=>"错误: " . $file["file"]["error"]);
        }
        if(!$this->check_temp(explode(".", $file["name"])[1],$file["type"])){
            return array('status'=>false,'msg'=>'文件格式错误！');
        }
        if(!$this->check_size($file["size"])){
            return array('status'=>false,'msg'=>'文件太大！');
        }
        if(!$this->check_dir($file["tmp_name"])){
            return array('status'=>false,'msg'=>'找不到临时文件！');
        }
        return $this->move_file($file);
    }

    /**
     * 生成二维码
     * @param $value //二维码内容
     * @param $address
     * @param bool $logo
     * @return string
     */
    public function qrcode($value,$address = 'school/qrcode/',$logo = false){
        appLoad()->func('phpqrcode');
        $errorCorrectionLevel = 'H';	//容错级别
        $matrixPointSize = 1;			//生成图片大小

        $file_root = IA_ROOT.'/attachment/'.$address.date('Y-m-d',time()).'/';
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        $this->make_all_dirs($file_root);
        //生成二维码图片
        $filename = time().'.png';
        QRcode::png($value,$file_root.$filename,$errorCorrectionLevel, $matrixPointSize, 2);
        $file_url = $address.date('Y-m-d',time())."/" . $filename;
        $QR = $file_root.$filename;
        $QR = imagecreatefromstring(file_get_contents($QR));//目标图象连接资源。
        if(file_exists($logo)) {
            $logo = imagecreatefromstring(file_get_contents($logo));   	//源图象连接资源。
            $QR_width = imagesx($QR);			//二维码图片宽度
            $QR_height = imagesy($QR);			//二维码图片高度
            $logo_width = imagesx($logo);		//logo图片宽度
            $logo_height = imagesy($logo);		//logo图片高度
            $logo_qr_width = $QR_width / 4;   	//组合之后logo的宽度(占二维码的1/5)
            $scale = $logo_width/$logo_qr_width;   	//logo的宽度缩放比(本身宽度/组合后的宽度)
            $logo_qr_height = $logo_height/$scale;  //组合之后logo的高度
            $from_width = ($QR_width - $logo_qr_width) / 2;   //组合之后logo左上角所在坐标点
            //重新组合图片并调整大小
            /*
             *	imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
             */
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,$logo_qr_height, $logo_width, $logo_height);
            imagedestroy($logo);
        }
        //输出图片
        imagepng($QR,'qrcode.png');
        imagedestroy($QR);
        return $file_url;
    }
}