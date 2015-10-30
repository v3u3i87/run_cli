<?php

if ( ! function_exists('getHeader'))
{
    /**
     * 获取头信息
     */
    function getHeader()
    {
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

}


if ( ! function_exists('p'))
{
    /**
     * 该函数格式化打印数组
     *
     * @param unknown $data
     * @param string $type
     *        	true as 1 为不断点执行
     */
    function p($data, $type = null) {
        echo '<pre>';
        print_r ( $data );
        echo '</pre>';
        !$type ? exit () : null;
    }

}

if(! function_exists('vd')) {
    /**
     * 打印参数详细数据 var_dump
     *
     * @param unknown $data
     * @param string $type
     *            true as 1 为不断点执行
     */
    function vd($data, $type = '')
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        !$type ? exit () : null;
    }

}


if(! function_exists('jump')) {
    /**
     * 转跳
     *
     * @param string $url
     */
    function jump($url)
    {
        if (isset ($url)) {
            header('Location:' . $url);
            exit ();
        }
    }

}

if(! function_exists('lode')) {
    /**
     * 分割数组或字符串处理
     *
     * @param string $type
     *            : , | @
     * @param type $data
     *            : array|string
     * @internal string $type ->a=array ->explode || $type ->s=string ->implode
     * @return array|string
     */
    function lode($type, $data)
    {
        if (is_string($data)) {
            return explode($type, $data);
        } elseif (is_array($data)) {
            return implode($type, $data);
        }
    }
}

if(!function_exists('array_merge_one')) {
    /**
     * 多维数组合并成一维数组
     *
     * @param unknown $a
     * @return unknown
     */
    function array_merge_one($data)
    {
        static $one;
        foreach ($data as $v) {
            is_array($v) ? array_merge_one($v) : $one [] = $v;
        }
        return $one;
    }
}



/**
 * 序列化函数
 *
 * @param 序列化的数据 $data        	
 * @param 类型 $type
 *        	as true 序列化 | false 反序列化
 * @return string|mixed
 */
function ialize($data, $type) {
	if ($type) {
		return serialize ( $data );
	} elseif (! $type) {
		return unserialize ( $data );
	}
}


if(!function_exists('json')){
    
    /**
     * 对json进行编码或解码
     * @param null $data
     * @param int $DataType
     * @return bool
     */
    function json($data=null,$DataType=1){
        if(is_array($data)){
               return json_encode($data);
            }else{
               return json_decode($data,$DataType);
        }
    }

}


if(!function_exists('is_json')){
    /**
     * 判断JSON是否合法
     * @param null $string
     * @return bool
     */
    function is_json($string = null) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}



function runtime($time){
    
    return date('Y-m-d H:i:s',$time);

}



if(!function_exists('is_json')){
    /**
     * 判断JSON是否合法
     * @param null $string
     * @return bool
     */
    function is_json($string = null) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if(!function_exists('is_dirName')) {
    /**
     * 判断目录是否存在，如果不存在就创建
     *
     * @param unknown $path
     */
    function is_dirName($dirName)
    {
        // 设置总目录
        if (!is_dir($dirName) || !is_writeable($dirName)) {
            if (!mkdir($dirName, 0777)) {
                is_exit($dirName . lang('is_dir'));
            }
        }
    }
}

if(!function_exists('is_upToken')) {
    /**
     * 令牌
     */
    function is_upToken()
    {
        defined('UPADD_HOST') or exit ('Please visit the normal!');
    }
}


if(!function_exists('array_sort_field')) {
    /**
     * 根据某字段多维数组排序
     *
     * @param unknown $array
     * @param unknown $field
     * @param string $desc
     */
    function array_sort_field(&$array, $field, $desc = false)
    {
        $fieldArr = array();
        foreach ($array as $k => $v) {

            $fieldArr [$k] = $v [$field];
        }
        $sort = $desc == false ? SORT_ASC : SORT_DESC;
        array_multisort($fieldArr, $sort, $array);
    }
}


if(!function_exists('m')){
    
    /**
     * 获取表模型对象
     * @param unknown $table
     * @return Model
     */
    function m($table){
        if($table){
            $model = new Model();
            $model->setTableName($table);
            return $model;
        }    
    }
    
}


if(!function_exists('getMachineName')){

    /**
     * 返回机器名称
     * @return string
     */
    function getMachineName(){
        $os = lode(" ", php_uname());
        if('/'==DIRECTORY_SEPARATOR ){
            $os =  $os[1];
        }else{
            $os =  $os[2];
        }
        $osName = $os;
        //strtolower($os);
        return $osName;
    }

}

if(!function_exists('msg')){

    /**
     * 对外接口数据msg
     * @param int $code
     * @param string $message
     * @param array $data
     * @param string $type or json
     */
    function msg($code=10001,$message='Unauthorized access',$data = array(),$type='json'){
       exit(json(array(
           'code'=>$code,
           'msg'=>$message,
           'data'=>$data
       )));
    }

}


function getCurl($data, $url, $type='POST')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//url
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $User_Agen = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36';
        curl_setopt($ch, CURLOPT_USERAGENT, $User_Agen);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//数据
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($info, 1);
        if ($json) {
            return $json;
        } else {
            return false;
        }
}



function get_code($eid){
    return dechex(crc32(mt_rand().time())).dechex(crc32($eid.mt_rand()));
}


if(!function_exists('getArgs')){
    // $evnStatus = false;
    // if(function_exists('php_sapi_name')){
    //  $evnName = php_sapi_name();
    //  if($evnName === 'cli' ){
    //      $evnStatus = true;
    //  }elseif (PHP_SAPI === 'cli'){
    //          $evnStatus = true;
    //  }
    // }

    /**
    * 获取命令行参数
    * --key＝value 多个数据空出
    */
    function getArgs($argv){
        array_shift($argv); 
        $out = array(); 
        foreach ($argv as $arg){ 
            if (substr($arg,0,2) == '--') {
                $eqPos = strpos($arg, '=');
                if ($eqPos === false) {
                    $key = substr($arg, 2);
                    $out[$key] = isset($out[$key]) ? $out[$key] : true;
                } else {
                    $key = substr($arg, 2, $eqPos - 2);
                    $out[$key] = substr($arg, $eqPos + 1);
                }
            }else{
                exit('you input parameters have a problem'."\r\n".'exit the program...'."\r\n".'If you have questions, can contact me.'."\r\n".'my email: v3u3i87@gmail.com'."\r\n");
            }
        } 
        return $out; 
    }
}


if(!function_exists('postData')){
    /**
    * 模拟提交
    */
    function postData($_param=array()){
        $url = isset($_param['url']) ? $_param['url'] : '';
        $data = isset($_param['data']) ? $_param['data'] : array();
        $type = isset($_param['type']) ? $_param['type'] : 'POST';
        $mode = isset($_param['mode']) ? $_param['mode'] : true;
        $header = isset($_param['header']) ? $_param['header'] : null;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//数据
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $body = curl_exec($ch);
        curl_close($ch);
        return $body;
    }
}