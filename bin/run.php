<?php
define ( 'RUNTIME', microtime ( true ));
header ( 'Content-Type:text/html;charset=utf-8' );
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2024M');
set_time_limit(0);
require_once 'fun.php';
require_once 'Log.php';
require_once 'Verify.php';
require_once 'LinkPdoMysql.php';
require_once 'Model.php';



class Run
{

    /**
     * 获取命令行参数,并执行匿名函数
     * @param $callable
     * @param $argv
     */
    static function getVal($callable,$argv){
        $argv = getArgs($argv);
        if(is_callable($callable))
        {
            call_user_func($callable,$argv);
        }
    }

    /**
     * 设置参数,并执行匿名函数
     * @param $callable
     * @param $argv
     */
    static function setVal($callable,$argv){
        if(is_callable($callable))
        {
            call_user_func($callable,$argv);
        }
    }


    /**
     * 退出程序
     */
    static function setExit(){
        echo "\r\n";
        $endtime = (microtime(true)) - RUNTIME;
        echo 'runTime:'.$endtime;
        echo "\r\n";
        exit('--exit the program'.'---'."\r\n");
    }
}







