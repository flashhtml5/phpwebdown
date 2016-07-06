<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:58
 */

namespace datatype;


class JBHPic
{
        public $picindex;
        public $picurl;


        public function intro(){

            echo "序号: $this->picindex 地址：$this->picurl";

        }
}