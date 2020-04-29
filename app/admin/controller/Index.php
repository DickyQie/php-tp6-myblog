<?php

namespace app\admin\controller;


use think\facade\View;
use think\facade\Session;

class Index extends Base{
    
	  public function index() {
		  
		 
		  
		  echo Session::get("loginStatus");
		  $keyword = input('keyword');
		  if($keyword){
			 $db = \think\facade\Db::table('zq_datalist')->where('title','like',"%$keyword%")->order('id','desc')->paginate(5);
		  }else{
			 $db = \think\facade\Db::table('zq_datalist')->order('id','desc')->paginate(5);
		  }
		  
		  $page = $db->render();
		  //$this->assign('data',$db);
		  return View::fetch('index',['data'=>$db,'page'=>$page]);
		  
	  }
	  
	  
	  public function edit(){
		  $id = input('id');
		  if(request()->isPost()){
			  $post = input('post.');
			  $res = \think\facade\Db::name('datalist')->save($post);
			  if($res){
				//echo "修改成功";
				return json(['code'=>1,'success'=>'修改成功']);
			}else{
				return json(['code'=>0,'success'=>'修改失败']);
			}
		  }else{
			  $type = \think\facade\Db::name('type')->select();
			  $data = \think\facade\Db::name('datalist')->where('id',$id)->find();
			  //$data['content']=html_entity_decode($data['content']);
			  return view('edit',['data'=>$data,'type'=>$type]);
		  }
	  }
	  
	  
	  public function add(){
		  
		  if(request()->isPost()){
			  $data = input('post.');
			   //var_dump($data);
			  $data['volume'] = 0;
			  //$data['content']=html_entity_decode($data['content']);
			  $data['time']=date('Y-m-d');
			  $db = \think\facade\Db::name('datalist')->insert($data);
			   if($db){
					return json(['code'=>1,'success'=>'添加成功']);
				}else{
					return json(['code'=>0,'success'=>'添加失败']);
				}
			 
		  }else{
			  $type = \think\facade\Db::name('type')->select();
			  return View::fetch('add',['type'=>$type]);
		  }
	  }
	  
	  public function del(){
		  $id = input("id");
		  $db = \think\facade\Db::name("datalist")->delete($id);
		  if($db){
			  return "删除成功";
		  }else{
			  return "删除失败";
		  }
	  }
	  
	  public function delAll(){
		  $ids = input('ids');
		  $db = \think\facade\Db::name('datalist')->delete($ids);
		  if($db){
			  return "删除成功了";
		  }else{
			  return "删除失败了";
		  }
	  }
	  
	  
	
	/**
	*	路由部署访问  admin/route中
	*http://localhost/demo1/tp5/tp6zqblog/public/index.php/admin/home
	*/
	
    public function indexn() {
        echo "123";
        
		//table方式
		//$db = \think\facade\Db::table('zq_datalist')->select();
        $db = \think\facade\Db::table('zq_datalist')->where('id',1)->find();

		
        
		
		//助手函数
		//$db = db('datalist')->where('id',1)->find();
		
		
		//Query查询
		/*$query = new \think\db\Query();
		$query->table('zq_datalist')->where('id',1);
		$db = \think\Db::find($query);
		
		//返回指定的值
	    $db = \think\Db::table('zq_datalist')->where('id',1)->value('title');
		
		
		$db = \think\Db::table('zq_datalist')->column('title','id');
		
		
		////返回指定的值
		$db = \think\Db::name("datalist")->field('id,title')->select();
		
		//排除指定值
		$db = \think\Db::name("datalist")->field('content',true)->select();
		
		
		*/
		var_dump($db);
		
		
		
		
        
        
    }
	
	
	
	function content($data){
		foreach($data as $datas){
			var_dump($datas);
		}
	}
	
	
}