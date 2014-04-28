<?php
namespace Home\Controller;
use Think\Controller;
class PfController extends Controller {
    public function hello(){
        echo 'hello,thinkphp!';
    }

    public function index(){
        echo "this is the index.";
    }
}
