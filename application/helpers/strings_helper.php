<?php
/**
 * Created by PhpStorm.
 * User: jcastro
 * Date: 26/11/16
 * Time: 14:45
 */

if ( ! function_exists('strings_notEmpty')) {

    function strings_notEmpty($str){

        return $str!=null && strlen($str)>0;
    }

}


if ( ! function_exists('strings_random')) {

    function strings_random($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
}







if ( ! function_exists('strings_date_to_app_format')) {

    function strings_date_to_app_format($date)
    {

        $date = date_create_from_format('d-m-Y H:i:s', $date);


        $date = date_format($date,"Y-m-d H:i:s");

        return $date;
    }
}



if ( ! function_exists('strings_app_format_to_date')) {

    function strings_app_format_to_date($date)
    {

        $date = date_create_from_format('Y-m-d H:i:s', $date);


        $date = date_format($date,"d-m-Y H:i:s");

        return $date;
    }
}




if(!function_exists("read_assign_property")){
    function read_assign_property($object,$propertyName,$defaultValue){
        //$fecha = read_assign_property($object,"fecha","");

        $res =$defaultValue;
        if(isset($object)){
            if(property_exists($object,$propertyName)){
                $res  = $object->$propertyName;
            }
        }

        return $res;
    }
}





?>