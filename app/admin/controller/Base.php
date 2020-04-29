<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\Session;

class Base extends BaseController{
    
    
     // 初始化
    protected function initialize()
    {
		 //Session::delete("loginStatus");
		  if(!Session::has("loginStatus")){
			redirect('http://localhost/demo1/tp5/tp6zqblog/public/index.php/admin/login/login')->send();
		  }
	}
    
    
    
    
}