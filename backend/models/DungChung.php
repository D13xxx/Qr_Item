<?php
/**
 * Created by PhpStorm.
 * User: cauha
 * Date: 4/3/2018
 * Time: 11:19 PM
 */

namespace app\models;

use yii\db\Query;
class DungChung
{
    public static function convert_to_date($string)
    {
        if($string!=Null||$string!='')
        {
            $mangdulieu=explode('/',$string);
            $soluongphantu=count($mangdulieu);
            if($soluongphantu<1 || $soluongphantu>3)
            {
                return FALSE;
            } else {
                if($soluongphantu==1)
                {
                    $ngay=$mangdulieu[0];
                    $thang=date("m");
                    $nam=date("Y");
                }
                if($soluongphantu==2)
                {
                    $ngay=$mangdulieu[0];
                    $thang=$mangdulieu[1];
                    $nam=date("Y");
                }
                if($soluongphantu==3)
                {
                    $ngay=$mangdulieu[0];
                    $thang=$mangdulieu[1];
                    $nam= $mangdulieu[2];
                }
            }
            if((strlen($ngay)!==2)||(strlen($thang)!==2)||(strlen($nam)!==4))
            {
                return FALSE;
            }
            if(checkdate($thang, $ngay, $nam))
            {
                return $nam.'-'.$thang.'-'.$ngay;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }


    public static function SinhMa($tiento,$bangdulieu)
    {
        if(($tiento!==''||$tiento!==NULL)&&($bangdulieu!==''||$bangdulieu!==NULL))
        {
            $connection = \Yii::$app->db;
            $sql="SELECT max(id)+1 as ids FROM ".$bangdulieu;
            $command=$connection->createCommand($sql);
            $mangdulieu=$command->queryScalar();
            if($mangdulieu==''||$mangdulieu==NULL)
            {
                return $tiento.'00001';
            }
            return $tiento.str_pad($mangdulieu, 5, '0', STR_PAD_LEFT);
        }
    }
    public static function TaoMaSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
    public static function url(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }
}