<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:18
 */

namespace task;


use datatype\JianBiHuaDataObj;
use datatype\StarDataObj;

class Task_JianBiHuaType extends TaskBase
{
    public $taskurl;
    public $taskhost;

    public $taskparent;

    public function startTask()
    {
        parent::startTask(); // TODO: Change the autogenerated stub

        $this->taskStars=[];

        $doc=$this->featchDoc($this->taskurl);


        $this->ProccDocImglist($doc);



        return $this->getResult();

    }

    private $taskStars;

    public function getResult()
    {
        return $this->taskStars; // TODO: Change the autogenerated stub
    }

    public function getDownPath(){

        return "./downjbh/".$this->taskparent;
    }

    public $downdir;


    public function ProccDocImglist(\phpQueryObject $doc){




        $ulblock=pq(".imglist");




        $liList=$ulblock->find("li");

        $this->taskStars=[];



        foreach($liList as $li){

            $star=new JianBiHuaDataObj();

            $star->name=pq($li)->find("a")->attr("title");
            $star->name=strip_tags($star->name);
            $star->homepage=pq($li)->find("a")->attr("href");
            $star->homepage=$this->taskhost.$star->homepage;

            echo "name:".$star->name;
            echo "homepage:".$star->homepage;
            echo PHP_EOL;

            $parentdir=$this->getDownPath();

            if(!file_exists($parentdir)){
                mkdir($parentdir);
            }

            $taskdir=$this->getDownPath()."/".$star->name;



            if(!file_exists($taskdir)){
                mkdir($taskdir);
            }
            else{
                echo "跳过己存在的页面项目: ".$star->name.PHP_EOL;
                continue;
            }

            $this->taskStars[]=$star;
            $star->downdir=$taskdir;


            echo $star->intro().PHP_EOL;

//            return;
        }

    }

}