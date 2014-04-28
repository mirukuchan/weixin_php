<?php
namespace Home\Controller;
use Think\Controller;
class PlatformController extends Controller {
	public function index(){
		$WxPlatform = D('Wxplatform');
		$admin_id = session('admin_id');
		$map['admin_id'] =  $admin_id;
		$wxPlatform = $WxPlatform->table('admin_wxp AW,admin A,wxplatform W')
              ->where('A.id = AW.adminId AND W.PID = AW.pId AND admin_id = $admin_id')
              ->select();
		dump($wxPlatform);
		$this->display();
	}
	public function addWeiXinPlat(){
		$this->display();
	}
/*
 * [addWxPlat description]
 * add an wxplatform
 * @param type secret appId pid icon name wxAccount
 * @return boolean
 */
	public function addWxPlat(){
		$Admin_wxp = D('Admin_wxp');
		$admin_id = session('admin_id');

		dump($_POST);
		$pid = $_POST['pid'];
		/**
		 * test
		 */
		$pid == null && $pid = 1;
		/**
		 * test end
		 */
		$admin_wxp['pId'] =  $pid;
		$admin_wxp['adminId'] =  $admin_id;
		$Admin_wxp->data($admin_wxp)->add();
		//store the relation ship
		
		//endsstore
		$WxPlatform = D('WxPlatform');
		//confirm if this wxplatform is exit
		$map['pid'] = $pid;
		$wxPlatform = $WxPlatform->where($map)->find();
		($wxPlatform != null) && ($this->error("this pid is already exits"));
		$icon = $_POST['icon'];
		$name = $_POST['name'];
		$wxAccount = $_POST['wxAccount'];
		$token = $_POST['token'];
		$type = $_POST['type'];
		if ($type == 1){
			$secret = $_POST['secret'];
			$appId = $_POST['appId'];
		}else{
			$secret = '';
			$appId = '';
		}
		//retore
		$wxPlat['pid'] =$pid;
		$wxPlat['icon'] =$icon;
		$wxPlat['name'] =$name;
		$wxPlat['wxAccount'] =$wxAccount;
		$wxPlat['type'] =$type;
		$wxPlat['secret'] =$secret;
		$wxPlat['appId'] =$appId;
		$wxPlat['token'] = $token;
		$WxPlatform->add($wxPlat);

	}

	public function changeWxPlat(){
		$WxPlatform = D('Wxplatform');
		$pid = $_POST['pid'];
		$map['pid'] = $pid;
		$wxPlat = $WxPlatform->where($map)->find();
		$wxPlatform == null && $this->error('this plat is not exits');
		//confirm if this wxplatform is exit
		$type = $_POST['type'];
		//change
		$wxPlat['icon'] =$_POST['icon'];
		$wxPlat['name'] = $_POST['name'];
		$wxPlat['wxAccount'] =$_POST['wxAccount'];
		$wxPlat['type'] =$type;
		$wxPlat['token'] =  $_POST['token'];
		$WxPlatform->save($wxPlat);
		if ($type == 1){
			$wxPlat['secret'] = $_POST['secret'];
			$wxPlat['appId'] = $_POST['appId'];
		}else{
			$wxPlat['secret'] = '';
			$wxPlat['appId'] = '';
		}
	}


}