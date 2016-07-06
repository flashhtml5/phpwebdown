<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:58
 */

namespace datatype;


class JianBiHuaDataObj
{
        public $name;
        public $homepage;

        public $downdir;

        public function intro(){

            echo "标题: $this->name 启始页：$this->homepage";

        }
}