<?php
/**
 * Created by PhpStorm.
 * User: zhouhua
 * Date: 2015-10-19
 * Time: 16:58
 */

namespace datatype;


class StarPicGroup
{
        public $starname;
        public $groupname;
        public $grouppage;


        public function intro(){

            echo "名星：$this->starname 图集名: $this->groupname 图集页：$this->grouppage";

        }
}