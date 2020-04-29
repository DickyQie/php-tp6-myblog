<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Db;

class Resume extends BaseController
{
    public function resume() {
	   $db = Db::name('datalist')->limit("0","6")->select();
	   return View::fetch('resume',['data'=>$db]);
	  
    }
    
}
