<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;

class About extends BaseController
{
  
    public function about() {
      
	   return View::fetch();
    }
    
}
