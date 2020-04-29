<?php

namespace app\admin\controller;


use think\facade\View;
use think\facade\Db;

class Message extends Base{
    
    
    public function message() {
		$data = Db::name('message')->order('id asc')->paginate(5);
        return View::fetch('message',['data'=>$data]);
    }

}