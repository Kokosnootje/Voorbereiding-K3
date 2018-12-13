<?php
//File with helper functions to make my life easier :-D

/**
 * @param $data
 * @return string
 * Dumps nicely formed data on HTML page
 */
function d($data){
    if(is_null($data)){
        $str = "<i>NULL</i>";
    }elseif($data == ""){
        $str = "<i>Empty</i>";
    }elseif(is_array($data)){
        if(count($data) == 0){
            $str = "<i>Empty array.</i>";
        }else{
            $str = "<table style=\"border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
            foreach ($data AS $key => $value) {
                $str .= "<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . d($value) . "</td></tr>";
            }
            $str .= "</table>";
        }
    }elseif(is_resource($data)){
        while($arr = mysql_fetch_array($data)){
            $data_array[] = $arr;
        }
        $str = d($data_array);
    }elseif(is_object($data)){
        $str = d(get_object_vars($data));
    }elseif(is_bool($data)){
        $str = "<i>" . ($data ? "True" : "False") . "</i>";
    }else{
        $str = $data;
        $str = preg_replace("/\n/", "<br>\n", $str);
    }
    return $str;
}

/**
 * @param $data
 */
function dnl($data){
    echo d($data) . "<br>\n";
}

/**
 * @param $data
 */
function dump($data){
    echo dnl($data);
}

/**
 * @param $data
 */
function dd($data){
    echo dnl($data);
    exit;
}

/**
 * @param $message
 * Store a session message to be shown later on.
 */
function StoreMessage($message) {
    $key = $message[0];
    $msg = $message[1];

    $_SESSION['messages'][$key] = $msg;
}

/**
 * @param string $message
 */
function ddt($message = ""){
    echo "[" . date("Y/m/d H:i:s") . "]" . $message . "<br>\n";
}

/**
 * @param $url
 * @param bool $permanent
 */
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}
