<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\View;

class Quotations extends BaseController
{
   
    
    public function quotations() {
	   return View::fetch();
    }
    
}
