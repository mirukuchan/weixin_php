<?php
namespace Home\Controller;
use Think\Controller;
class MsgController extends Controller {
    public function hello(){
        echo 'hello,thinkphp!';
    }

    public function index(){
        $admin_id  = session('admin_id');
        $Text = D("group");
        $members = $Text->select();
        
        /*
        
         $members=$model->table('bm_member m,bm_company c')
              ->where('m.cid=c.id')
              ->field('m.* ,c.work')
              ->order('m.id')
              ->select();
        */
        dump($members);
        
    }
}
