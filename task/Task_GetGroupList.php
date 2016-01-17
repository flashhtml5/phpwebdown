<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:18
 */

namespace task;


use datatype\StarDataObj;
use datatype\StarPicGroup;

class Task_GetGroupList extends TaskBase
{
//    public $taskurl;

    public function startTask()
    {
        parent::startTask(); // TODO: Change the autogenerated stub




        $doc=$this->featchDoc($this->taskobj->homepage);


        $this->ProccDocName($doc);




    }

    private $taskpics;

    public function getResult()
    {

        return $this->taskpics; // TODO: Change the autogenerated stub
    }


    public function ProccDocName(\phpQueryObject $doc){


        $div=pq(".box");

        $liList=$div->find("ul");

        $liList=$liList->find("li");

        $this->taskpics=[];

        $count=count($liList);
        foreach($liList as $li){
            $pic=new StarPicGroup();
            $pic->starname=$this->taskobj->name;
            $pic->groupname=pq($li)->find("a")->text();
            $pic->grouppage=pq($li)->find("a")->attr("href");


            $rand=rand(0,100);

            if($count<50){
                $rand=100;
            }

            if($rand>40){
                echo $pic->intro().PHP_EOL;

                $this->taskpics[]=$pic;
            }
        }

    }

}