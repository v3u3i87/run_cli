<?php

class VerifyServer{

    /** isEmpty
     * 是否为空值
     */  
    public static function is_empty($str){ 
        return !empty(trim($str)) ? true : false;
    }

    /**
     * 数字验证
     * param:$flag : int是否是整数，float是否是浮点型
     */      
    public static function isNum($str,$flag = 'float'){
        if(!self::is_empty($str)) return false;
        if(strtolower($flag) == 'int'){
            return ((string)(int)$str === (string)$str) ? true : false;
        }else{
            return ((string)(float)$str === (string)$str) ? true : false;
        }
    } 

    /**
     * 名称匹配，如用户名，目录名等
     * @param:string $str 要匹配的字符串
     * @param:$chinese 是否支持中文,默认支持，如果是匹配文件名，建议关闭此项（false）
     * @param:$charset 编码（默认utf-8,支持gb2312）
     */  
    public static function isName($str,$chinese = true,$charset = 'utf-8'){
        if(!self::is_empty($str)) return false;
        if($chinese){
            $match = (strtolower($charset) == 'gb2312') ? "/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_-]+$/" : "/^[x{4e00}-x{9fa5}A-Za-z0-9_]+$/u";
        }else{
            $match = '/^[A-za-z0-9_-]+$/';
        }
        return preg_match($match,$str) ? true : false;
    }

    /**
     * 邮箱验证
     */      
    public static function isEmail($str){
        if(!self::is_empty($str)) return false;
        return preg_match("/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i",$str) ? true : false;
    }

    //手机号码验证
    public static function isMobile($str){
        $exp = "/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/";
        if(preg_match($exp,$str)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * URL验证，纯网址格式，不支持IP验证
     */      
    public static function isUrl($str){
        if(!self::is_empty($str)) return false;
        return preg_match('#(http|https|ftp|ftps)://([w-]+.)+[w-]+(/[w-./?%&=]*)?#i',$str) ? true : false;
    }

    /**
     * 验证中文
     * @param:string $str 要匹配的字符串
     * @param:$charset 编码（默认utf-8,支持gb2312）
     */  
    public static function isChinese($str,$charset = 'utf-8'){
        if(!self::is_empty($str)) return false;
        $match = (strtolower($charset) == 'gb2312') ? "/^[".chr(0xa1)."-".chr(0xff)."]+$/"
        : "/^[x{4e00}-x{9fa5}]+$/u";
        return preg_match($match,$str) ? true : false;       
    }

    /**
     * UTF-8验证
     */      
    public static function isUtf8($str){
        if(!self::is_empty($str)) return false;
        return (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word)
        == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word)
        == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word)
        == true) ? true : false;
    }

    /**
     * 验证长度
     * @param: string $str
     * @param: int $type(方式，默认min <= $str <= max)
     * @param: int $min,最小值;$max,最大值;
     * @param: string $charset 字符
    */
    public static function length($str,$type=3,$min=0,$max=0,$charset = 'utf-8'){
        if(!self::is_empty($str)) return false;
        $len = mb_strlen($str,$charset);
        switch($type){
            case 1: //只匹配最小值
                return ($len >= $min) ? true : false;
                break;
            case 2: //只匹配最大值
                return ($max >= $len) ? true : false;
                break;
            default: //min <= $str <= max
                return (($min <= $len) && ($len <= $max)) ? true : false;
        }
    }

    /**
     * 验证密码
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isPWD($value,$minLen=6,$maxLen=16){
        $match='/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{'.$minLen.','.$maxLen.'}$/';
        $v = trim($value);
        if(empty($v))
            return false;
        return preg_match($match,$v);
    } 

    /**
     * 验证用户名
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function isNames($value, $minLen=2, $maxLen=16, $charset='ALL'){
        if(empty($value))
            return false;
        switch($charset){
            case 'EN': $match = '/^[_\w\d]{'.$minLen.','.$maxLen.'}$/iu';
                break;
            case 'CN':$match = '/^[_\x{4e00}-\x{9fa5}\d]{'.$minLen.','.$maxLen.'}$/iu';
                break;
            default:$match = '/^[_\w\d\x{4e00}-\x{9fa5}]{'.$minLen.','.$maxLen.'}$/iu';
        }
        return preg_match($match,$value);
    } 

    /**
     * 验证邮箱
     * @param string $value
     */  
    public static function checkZip($str){
        if(strlen($str)!=6){
            return false;
        }
        if(substr($str,0,1)==0){
            return false;
        }
        return true;
    } 

    /**
     * 匹配日期
     * @param string $value
     */      
    public static function checkDate($str){
        $dateArr = explode("-", $str);
        if (is_numeric($dateArr[0]) && is_numeric($dateArr[1]) && is_numeric($dateArr[2])) {
        if (($dateArr[0] >= 1000 && $timeArr[0] <= 10000) && ($dateArr[1] >= 0 && $dateArr[1] <= 12) && ($dateArr[2] >= 0 && $dateArr[2] <= 31))
            return true;
        else
            return false;
        }
        return false;
    }

    /**
     * 匹配时间
     * @param string $value
     */      
    public static function checkTime($str){
        $timeArr = explode(":", $str);
        if (is_numeric($timeArr[0]) && is_numeric($timeArr[1]) && is_numeric($timeArr[2])) {
        if (($timeArr[0] >= 0 && $timeArr[0] <= 23) && ($timeArr[1] >= 0 && $timeArr[1] <= 59) && ($timeArr[2] >= 0 && $timeArr[2] <= 59))
            return true;
        else
            return false;
        }
        return false;
    } 



}





class checker{
        // 函数定义
        var $array_data="";     //要验证的数组数据
        var $var_key="";     //当前要验证的数据的key
        var $var_value="";     //当前要验证的数据的值
        var $is_empty="";     //要验证的值可以为空
        var $array_info="";     //提示信息收集
        var $array_errors=array();   //错误信息收集

        //--------------------->构造函数<------------
        function checker($date){
        $this->array_data=$date;
        }
        //--------------------->数据检验函数<-------------
        function check($array_datas){
        foreach($array_datas as $value_key => $value_v){
         $temp1=explode('|',$value_v);
         if($temp1[0]=="i_empty" and empty($this->array_data[$value_key])){
         ;
         }else{
         foreach($temp1 as $temp_key => $value_con){
          //$data_temp=$this->array_data;
          //var_dump($data_temp['birthday']);
          //echo "--".$value_key."--<br>";
          $this->var_key=$value_key;
          $this->var_value=$this->array_data[$value_key];
          $temp2=explode(':',$value_con);
          switch(count($temp2)){
           case 0:
            $this->array_errors[$this->var_key]="此值的验证请求不存在";
            break;
           case 1:
            //如果用户没有指定验证动作
            if(empty($temp2[0])){
             $this->array_errors[$this->var_key]="此值的验证请求不存在";
             break;
            }else{
             $this->$temp2[0]();   //如果返回值为非，就不用进行下一步验证
             break;
            }
           case 2:
            $this->$temp2[0]($temp2[1]);
            break;
           case 3:
            $this->$temp2[0]($temp2[1],$temp2[2]);
            break;
          }
         }
         }
        }
        }
        function i_empty(){
        $this->is_empty=1;  //这个值没什么用，只是说明要验证的值可以是空值
        }

        //日期数据、邮件地址、浮点数据、整数、IP地址、字符串、最大值、最小值、字符串长度、域名、URL
        //-------------------->日期验证--------------------
        function i_date(){
          //约定格式：2000-02-01或者：2000-5-4
             if (!eregi("^[1-9][0-9][0-9][0-9]-[0-9]+-[0-9]+$", $this->var_value)) {
           $this->array_errors[$this->var_key]="日期格式错误";
                return false;
             }
             $time = strtotime($this->var_value);
             if ($time === -1) {
           $this->array_errors[$this->var_key]="日期格式错误";
                return false;
             }
             $time_e = explode('-', $this->var_value);
             $time_ex = explode('-', Date('Y-m-d', $time));
             for ($i = 0; $i < count($time_e); $i++) {
                if ((int)$time_e[$i] != (int)$time_ex[$i]) {
           $this->array_errors[$this->var_key]="日期格式错误";
                   return false;
                }
             }
             return true;
        }
        //-------------------->时间验证--------------------
        function i_time() {
        if (!eregi('^[0-2][0-3](:[0-5][0-9]){2}$', $this->var_value)) {
         $this->array_errors[$this->var_key]="时间格式错误";
               return false;
        }
        return true;
        }
        //-------------------->email验证--------------------
        function i_email(){
        if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]
        +(\.[a-z0-9-]+)*$", $this->var_value))
         $this->array_errors[$this->var_key]="邮件格式错误<br>";
         //echo $this->var_value;
        return true;
        }
        //-------------------->浮点数验证--------------------
        function i_float(){
        //if(!is_float($this->var_value))
        if(!ereg("^[1-9][0-9]?\.([0-9])+$",$this->var_value))
         $this->array_errors[$this->var_key]="这不是一个小数";
        }
        //-------------------->字符串验证--------------------
        function i_string(){
        if(empty($this->var_value))    //允许为空
         return true;
        if(!is_string($this->var_value))
         $this->array_errors[$this->var_key]="这不是一个字符串";
        return true;
        }
        //-------------------->字符串长度验证--------------------
        function len($minv,$maxv=-1){
             $len = strlen($this->var_value);
          if($len==0){
           $this->array_errors[$this->var_key]="不能为空值";
           return false;
          }
             if ($len < $minv) {
           $this->array_errors[$this->var_key]="输入的串太短了";
                return false;
             }
             if ($maxv != -1) {
                if ($len > $maxv) {
           $this->array_errors[$this->var_key]="输入的串太长了";
                   return false;
                }
             }
             return true;
        }
        //-------------------->整数验证--------------------
        function i_int(){
        if(!ereg("^[0-9]*$",$this->var_value))
         $this->array_errors[$this->var_key]="这不是一个整数";
        }
        //-------------------->IP地址验证--------------------
        function i_ip(){
        if(!ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$", $this->var_value)){
         $this->array_errors[$this->var_key]="错误的IP地址";
        }else{
         //每个不大于255
         $array_temp=preg_split("/\./",$this->var_value);
         foreach($array_temp as $ip_value){
          if((int)$ip_value >255)
           $this->array_errors[$this->var_key]="错误的IP地址";
         }
        }
        return true;
        }
        //-------------------->最大值验证--------------------
        function i_max($maxv){
        if($this->var_value >= $maxv){
         $this->array_errors[$this->var_key]="数据值太大";
         return false;
        }
        return true;
        }
        //-------------------->最小值验证--------------------
        function i_min($minv){
        if($this->var_value <= $minv){
         $this->array_errors[$this->var_key]="数据值太小";
         return false;
        }
        return true;
        }
        //-------------------->域名验证--------------------
        function i_domain() {
        if(!eregi("^@([0-9a-z\-_]+\.)+[0-9a-z\-_]+$", $this->var_value))
         $this->array_errors[$this->var_key]="错误的域名";
        return eregi("^@([0-9a-z\-_]+\.)+[0-9a-z\-_]+$", $this->var_value);
        }
        //-------------------->URL验证--------------------
        function i_url(){
        if(!eregi('^(http://|https://){1}[a-z0-9]+(\.[a-z0-9]+)+$' , $this->var_value))
         $this->array_errors[$this->var_key]="错误的WEB地址";
        return true;
        }
        //-------------------->自定义正则校验--------------------
        function check_own($user_pattern){
        //自定义校验。出错返回false，匹配返回1，不匹配返回0
        $tempvar=preg_match($user_pattern,$this->var_value);
        if($tempvar!=1)
         $this->array_errors[$this->var_key]="数据不合法";
        }

}