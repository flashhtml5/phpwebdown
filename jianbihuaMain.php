<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 15:29
 */

require('phpQuery/phpQuery.php');

function __autoload($classname){
    $classname = str_replace('\\', '/', $classname);
    $classpath="./".$classname.'.php';
//    echo $classpath;
    if(file_exists($classpath)){
        require_once($classpath);
    }
    else{
        echo 'class file'.$classpath.' not found!'.PHP_EOL;
    }
}


echo "proj 简笔画".PHP_EOL;


$starproj=new \proj\jianBihua();
 

echo "proj Comp!".PHP_EOL;