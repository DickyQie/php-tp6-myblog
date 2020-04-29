<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Db;
use think\captcha\facade\Captcha;
use think\facade\Session;

use think\facade\Route;

class Login extends BaseController{
    
    
    public function login() {
		//Session::delete("loginStatus");
		if(Session::has("loginStatus")){
			//return View::fetch("Index\index");
			//redirect("\admin\index\index")->send();
			//$this->redirect('/admin/index/index');

			redirect('http://localhost/demo1/tp5/tp6zqblog/public/index.php/admin/index/index')->send();
		}else{
			return View::fetch();
		}
		
		
    }
	public function logadminn(){
		$data = input('post.');
		
		if($data['username'] == 'root'){
			$aaa['status']=1;
			$aaa['message']="成功".$data['username'];
			// return json($aaa);
			return json(['status'=>1,'message'=>'成功']);
		}else{
			$aaa['status']=0;
			$aaa['message']="验证码错误".$data['code'];
			// return json($aaa);
			return json(['status'=>0,'message'=>'登录失败']);
		} 
				
		
	}
	
	
	/***
	 * 验证验证码是否正确
	 * @param unknown $param
	 */
	public function checkCode($param) {
		//$virfy= new Captcha();
		//return $virfy->check($param);//验证码id标识
		
		return Captcha::check($param);
	}
	
	
	public function loga(){
		echo "123";
	}
	
	
	public function logAdmin(){
		$data = input('post.');
		/*if($data['username'] == 'root'){
			return json(['status'=>1,'message'=>'成功']);
		}else{
			$code="验证码错误".$data['code'];
			return json(['status'=>0,'message'=>$code]);
		} */
		
		if(!Captcha::check($data['code'])){
			
			$code = "验证码错误".$data['code'];
			return json(['status'=>0,'message'=>$code]);
		}

		$username  = $data['username'];
		$dbName = Db::name('admin')->where('username',"$username")->find();
		if($dbName){
			  $res = Db::name('admin')->where('password',md5($data['password']))->find();
			  if($res){
				 Session::set('loginStatus',$res['username']); 
				 return json(['message'=>'登录成功','status'=>1]);
				 
			  }else{
				 return json(['message'=>'密码错误','status'=>1]);
			  }
		  }else{
			return json(['status'=>0,'message'=>'用户不存在']);
		  }
	}
    
    
    
    
}