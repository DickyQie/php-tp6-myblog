<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;

class Message extends BaseController
{
    
    public function message() {
	   return View::fetch();
    }
	
	public function addmsg(){
		$inta = input("post.");
		//var_dump($inta);die;
		$data = \think\facade\Db::name('message')->insert($inta);
		if($data){
			 return View::fetch('message');
		}else{
			 return View::fetch('message');
		}
	}
    
}
