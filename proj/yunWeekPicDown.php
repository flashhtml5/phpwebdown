<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 15:42
 */
namespace proj;

use task\Task_StartName;
use task\Task_PicDown;
use task\Task_GetGroupList;
use task\Task_YunWeekPicDown;

class yunWeekPicDown {


    private $redis;

    public function __construct(){

        echo "孕周图片下载项目".PHP_EOL;

//        $redis=new \Redis();

//        $redis->pconnect("127.0.0.1",6379);

//        $redis->set("proj","redis 服务启动 inited！\n");

//        echo $redis->get("proj");


        $this->StartProj();

    }


    public function StartProj(){

        //        $task->taskurl="http://www.mingxing.com/ziliao/index.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index_2.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index_3.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index_4.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index_5.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index_6.html";
//        $task->taskurl="http://www.mingxing.com/ziliao/index.html";

        $projUrls=[
            "http://huaiyun.00cha.net/taier.asp",


        ];


        for($i=0;$i<count($projUrls);$i++){

            $projurl=$projUrls[$i];

            $task=new Task_YunWeekPicDown();

            $task->taskurl=$projurl;


            $task->startTask();





        }











    }


    public function Task_DownGroupPic($result){


        $task=new Task_PicDown();

        $taskpics=[];

        for($i=0;$i<count($result);$i++){

            $taskstar=$result[$i];

            for($j=0;$j<count($taskstar);$j++) {


                $task->taskobj=$taskstar[$j];
                $task->startTask();
                $taskpics[]=$task->getResult();
            }




        }


        return $taskpics;
    }



    public function Task_GetGroupList($result){

        $task=new Task_GetGroupList();

        $taskgroups=[];

        for($i=0;$i<count($result);$i++){
            $taskstar=$result[$i];
            $task->taskobj=$taskstar;
            $task->startTask();
            $taskgroups[]=$task->getResult();
        }


        return $taskgroups;

    }


    public function Task_initStartName($url){


        echo "Task:$url =====================================";
        $task=new Task_StartName();



        $task->taskurl=$url;
        $task->startTask();


        $taskay=$task->getResult();

        return $taskay;
    }
}