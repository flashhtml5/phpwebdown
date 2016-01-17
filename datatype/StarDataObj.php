<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:58
 */

namespace datatype;


class StarDataObj
{
        public $name;
        public $homepage;


        public function intro(){

            echo "姓名: $this->name 启始页：$this->homepage";

        }
}