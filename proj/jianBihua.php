<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 15:42
 */
namespace proj;

use task\Task_JBHDown;
use task\Task_JianBiHuaType;
use task\Task_StartName;
use task\Task_PicDown;
use task\Task_GetGroupList;

class jianBihua {


    private $redis;

    public function __construct(){

        echo "下载简笔画".PHP_EOL;

        //asdfasdfsdfas324234234

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
//            "http://www.jianbihua.cc/dongwu/lb_1_189.html",
            "http://www.jianbihua.cc/renwu/lb_2_141.html",
            "http://www.jianbihua.cc/katong/lb_7_172.html",
            "http://www.jianbihua.cc/zhiwu/lb_3_64.html",
            "http://www.jianbihua.cc/wupin/lb_4_167.html",
            "http://www.jianbihua.cc/jianzhu/lb_6_20.html",
            "http://www.jianbihua.cc/guoshu/lb_5_41.html",
            "http://www.jianbihua.cc/a/fengjingjianbihua/fj_14_41.html"



        ];
        $tasklen=count($projUrls);
//        $tasklen=1;

        for($i=0;$i<$tasklen;$i++){
            $projurl=$projUrls[$i];

            echo "准备生成分类的列表页数组".$projurl.PHP_EOL;

            sleep(0.3);

            $lastindex=strripos($projurl,"/");

            $title=substr($projurl,0,$lastindex+1);
            $foot=substr($projurl,$lastindex+1);

            $titleay=explode("/",$title);

            $downtype=$titleay[count($titleay)-2];

            echo "downtype:".$downtype." title:".$title." foot:".$foot.PHP_EOL;
            
            
            

            $projTypeGroup=$this->Task_InitTaskGroup($downtype,$title,$foot);


            $this->Task_DownGroupPic($projTypeGroup);



//            $result=$this->Task_initStartName($projurl);
//
//            if($result){
//
//                $result=$this->Task_GetGroupList($result);
//
//
//                if($result){
//
//                    $this->Task_DownGroupPic($result);
//                }
//            }

        }











    }



    public function Task_InitTaskGroup($downtype,$title,$foot){


        $footinfo=explode("_",$foot);

        $minpage=1;

        $pagemax=intval(array_pop($footinfo));

        $maxpage=$pagemax;

        $pagename=join("_",$footinfo);

        $pagepictaskay=[];

//        $maxpage=1;

        for($i=$minpage;$i<=$maxpage;$i++){




            $pageurl=$title.$pagename."_".$i.".html";

            echo "add page:".$pageurl.PHP_EOL;

            $task=new Task_JianBiHuaType();

            $task->taskurl=$pageurl;

            $task->taskhost="http://www.jianbihua.cc";

            $task->taskparent=$downtype;


            $task->startTask();

            $taskresult=$task->getResult();




            array_push($pagepictaskay,$taskresult);

            sleep(0.1);
        }


        return $pagepictaskay;
    }


    public function Task_DownGroupPic($result){


        $task=new Task_JBHDown();

        $taskpics=[];

        $lenresult=count($result);
//        $lenresult=1;

        for($i=0;$i<$lenresult;$i++){

            echo "[PROGRESS]result=".$i."/".$lenresult;



            $taskstar=$result[$i];


            $lentask=count($taskstar);

//            $lentask=1;
            for($j=0;$j<$lentask;$j++) {
//
                echo "[PROGRESS]taskstar:".$j."/".$lentask;

                $taskobj=$taskstar[$j];
                
//                echo $taskobj->intro();
                
                $task->taskobj=$taskobj;
//
                $task->startTask();
//
//                $taskpics[]=$task->getResult();
//
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