<?php

namespace app\admin\controller;


use think\facade\View;

class Type extends Base{
    
    
    public function index(){
        $keywords = input('keyword');
		$map = array();
		if($keywords){
			$data = \think\facade\Db::name('type')->where('type','like',"%$keywords%")->order('id asc')->paginate(5);
			//dump($data);
			//die;
		}else{
			$data = \think\facade\Db::name('type')->order('id asc')->paginate(5);
		}
		
		//var_dump($data);
		
		return View::fetch('index',['data'=>$data]);
		 
    }
	
	public function edit(){
		
		if(request()->isPost()){
			$data = input('post.');
			$db = \think\facade\Db::name('type')->save($data);
			if($db){
				//echo "修改成功";
				return json(['code'=>0,'success'=>'删除成功']);
			}else{
				echo "修改失敗";
			}
		}else{
			$id = input('id');
			$data = \think\facade\Db::name('type')->where('id',$id)->find();
			return view('edit',['data'=>$data]);
		}
		
		
		
	}
	
	public function del(){
		$id = input('id');
		$res = \think\facade\Db::name('type')->delete($id);
		if($res){
			//return json(['code'=>1,'success'=>'删除成功']);
			return "删除成功";
		}else{
			//return json(['code'=>0,'error'=>'删除失败']);
			return 删除失败;
		}
	}
	
	public function delAll(){
		$ids = input('ids');
		$res = \think\facade\Db::name('type')->delete($ids);
		if($res){
			return "删除成功";
		}else{
			return 删除失败;
		}
	}
    
    
    public function add(){
        
        if (request()->isPost()){
			$data = input('post.');
			//var_dump($data);
			//echo $data['type'];
			
			$type = $data['type'];
			
			$res = \think\facade\Db::name('type')->where('type','=',$type)->find();
			if(!$res){
				$db = \think\facade\Db::name('type')->insert($data);
				if($db){
					//var_dump($data);
					return json(['code'=>1,'success'=>'添加成功']);
				}else{
					return json(['code'=>0,'success'=>'添加失败']);
				}
			}else{
				//$this->error("该类型已存在");
				echo "已存在";
			}
            
			
			
        }else {
            return view();
        }
        
    }
    
}