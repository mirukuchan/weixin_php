<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head> 
  <meta charset="UTF-8" /> 
  <title>
            WeChat后台管理@SysLab
        </title> 
  <link href="/weiphp/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" /> 
  <link rel="stylesheet" type="text/css" href="../css/base.css" media="all" /> 
  <link rel="stylesheet" type="text/css" href="../css/common.css" media="all" /> 
  <link rel="stylesheet" type="text/css" href="../css/module.css" /> 
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="all" /> 
  <link rel="stylesheet" type="text/css" href="../css/default_color.css" media="all" /> 
  <!--link rel="stylesheet" type="text/css" href="../css/bootstrap.css" media="all" /--> 
  <!--[if lt IE 9]>
            <script type="text/javascript" src="/weiphp/Public/static/jquery-1.10.2.min.js?v=20140412">
            </script>
        <![endif]--> 
  <!--[if gte IE 9]>
            <!--> 
  <script type="text/javascript" src="../js/jquery-2.0.3.min.js"></script> 
  <script type="text/javascript" src="../js/jquery.mousewheel.js"></script> 
  <script type="text/javascript" src="../js/admin_common.js"></script> 
  <script type="text/javascript" src="../js/jquery.uploadify.min.js"></script> 
  <!--<![endif]--> 
 </head> 
 <body> 
  <div class="header">
   <span class="logo"> </span> 
   <div class="user-bar"> 
    <a href="javascript:;" class="user-entrance"> <i class="icon-user"> </i> </a> 
    <ul class="nav-list user-menu hidden"> 
     <li class="manager"> 你好， <em title="root"> root </em> </li> 
     <li> <a href="http://localhost/weiphp/index.php?s=/home/index/main.html"> 返回前台 </a> </li> 
     <li> <a href="http://localhost/weiphp/index.php?s=/admin/user/updatepassword.html"> 修改密码 </a> </li> 
     <li> <a href="http://localhost/weiphp/index.php?s=/admin/user/updatenickname.html"> 修改昵称 </a> </li> 
     <li> <a href="http://localhost/weiphp/index.php?s=/admin/public/logout.html"> 退出 </a> </li> 
    </ul> 
   </div> 
  </div> 
  <div class="sidebar" onselectstart="return false"> 
   <div id="subnav" class="subnav"> 
    <h3> <i class="icon icon-unfold"> </i> 后台 </h3> 
    <ul class="side-sub-menu"> 
     <li> <a class="item" href=" "> 管理员信息 H</a> </li> 
     <li> <a class="item" href="../view/add.html"> 添加公众号 </a> </li> 
     <li> <a class="item" href="../view/main.html"> 公众号管理 </a> </li> 
    </ul> 
    <h3> <i class="icon icon-unfold"> </i> 功能 </h3> 
    <ul class="side-sub-menu"> 
     <li> <a class="item" href="../view/push.html"> 消息推送 H</a> </li> 
     <li> <a class="item" href="../view/auto-reply.html"> 自动回复 </a> </li> 
    </ul> 
    <h3> <i class="icon icon-unfold"> </i> 管理 </h3> 
    <ul class="side-sub-menu"> 
     <li> <a class="item" href=" "> 消息管理 H</a> </li> 
     <li> <a class="item" href=" "> 用户管理 H</a> </li> 
     <li> <a class="item" href=" "> 素材管理 H</a> </li> 
    </ul>  
   </div> 
  </div> 
  <div id="main-content"> 
   <div id="top-alert" class="fixed alert alert-error" style="display: none;"> 
    <button class="close fixed" style="margin-top: 4px;"> &times; </button> 
    <div class="alert-content">
      状态栏在这里！ 
    </div> 
   </div> 
   <div class="inner-main"> 
    <div class="tab-content"> 
     <!-- 表单 --> 
     <form id="form" action="addWxPlat" method="post" class="form-horizontal"> 
      <!-- 基础文档模型 --> 
      <div id="tab1" class="tab-pane in              tab1"> 
       <div class="form-item cf"> 
        <label class="item-label">公众号名称<span class="check-tips"> </span></label> 
        <div class="controls"> 
         <input type="text" class="text input-large" name="public_name" value="" /> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">公众号原始id<span class="check-tips"> </span></label> 
        <div class="controls"> 
         <input type="text" class="text input-large" name="public_id" value="" /> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">微信号<span class="check-tips"> </span></label> 
        <div class="controls"> 
         <input type="text" class="text input-large" name="wechat" value="" /> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">公众号头像<span class="check-tips"> </span></label> 
        <div class="controls"> 
         <div class="controls"> 
          <input type="file" id="upload_picture_headface_url" /> 
          <input type="hidden" name="headface_url" id="cover_id_headface_url" /> 
          <div class="upload-img-box"> 
          </div> 
         </div> 
         <script type="text/javascript">
                //上传图片
                  /* 初始化上传插件 */
                $("#upload_picture_headface_url").uploadify({
                      "height"          : 30,
                      "swf"             : "/weiphp/Public/static/uploadify/uploadify.swf",
                      "fileObjName"     : "download",
                      "buttonText"      : "上传图片",
                      "uploader"        : "http://localhost/weiphp/index.php?s=/home/file/uploadpicture/session_id/tjmm8plfrhpfv4ajpn24tr1tg3.html",
                      "width"           : 120,
                      'removeTimeout'   : 1,
                      'fileTypeExts'    : '*.jpg; *.png; *.gif;',
                      "onUploadSuccess" : uploadPictureheadface_url                 });
                function uploadPictureheadface_url(file, data){
                    var data = $.parseJSON(data);
                    var src = '';
                      if(data.status){
                        $("#cover_id_headface_url").val(data.id);
                        src = data.url || '/weiphp' + data.path;
                        $("#cover_id_headface_url").parent().find('.upload-img-box').html(
                          '<div class="upload-pre-item"><img src="' + src + '"/></div>'
                        );
                      } else {
                        updateAlert(data.info);
                        setTimeout(function(){
                              $('#top-alert').find('button').click();
                              $(that).removeClass('disabled').prop('disabled',false);
                          },1500);
                      }
                  }
                </script> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">Secret<span class="check-tips"> （认证服务号的Secret） </span></label> 
        <div class="controls"> 
         <input type="text" class="text input-large" name="secret" value="" /> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">AppId<span class="check-tips"> （认证服务号的AppId） </span></label> 
        <div class="controls"> 
         <input type="text" class="text input-large" name="appid" value="" /> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <label class="item-label">公众号类型<span class="check-tips"> </span></label> 
        <div class="controls"> 
         <label class="radio"> <input type="radio" value="0" name="type" checked="" /> 订阅号 </label> 
         <label class="radio"> <input type="radio" value="1" name="type" /> 服务号 </label> 
        </div> 
       </div> 
       <div class="form-item cf"> 
        <button class="home_btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button> 
       </div> 
      </div> 
     </form> 
    </div> 
   </div> 
   <script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 241);
        }).resize();
    })
   </script> 
   <!-- /内容区 --> 
   <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "..", //当前网站地址
            "APP"    : "../main.html", //当前项目地址
            "PUBLIC" : "/weiphp/Public", //项目公共目录地址
            "DEEP"   : "/", //PATHINFO分割符
            "MODEL"  : ["3", "1", "html"],
            "VAR"    : ["m", "c", "a"]
        }
    })();

  </script> 
   <script type="text/javascript" src="../js/think.js"></script> 
   <script type="text/javascript" src="../js/common.js"></script> 
   <script type="text/javascript">
            +function(){
                var $window = $(window), $subnav = $("#subnav"), url;
                $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
                }).resize();

                /* 左边菜单高亮 */
                url = window.location.pathname + window.location.search;
                url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
                $subnav.find("a[href$='" + url + "']").parent().addClass("current");

                /* 左边菜单显示收起 */
                $("#subnav").on("click", "h3",
                function() {
                    var $this = $(this);
                    $this.find(".icon").toggleClass("icon-fold");
                    $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").prev("h3").find("i").addClass("icon-fold").end().end().hide();
                });

                $("#subnav h3 a").click(function(e) {
                    e.stopPropagation()
                });

                /* 头部管理员菜单 */
                $(".user-bar").mouseenter(function() {
                    var userMenu = $(this).children(".user-menu ");
                    userMenu.removeClass("hidden");
                    clearTimeout(userMenu.data("timeout"));
                }).mouseleave(function() {
                    var userMenu = $(this).children(".user-menu");
                    userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                    userMenu.data("timeout", setTimeout(function() {
                        userMenu.addClass("hidden")
                    },
                    100));
                });

                /* 表单获取焦点变色 */
                $("form").on("focus", "input",
                function() {
                    $(this).addClass('focus');
                }).on("blur", "input",
                function() {
                    $(this).removeClass('focus');
                });
                $("form").on("focus", "textarea",
                function() {
                    $(this).closest('label').addClass('focus');
                }).on("blur", "textarea",
                function() {
                    $(this).closest('label').removeClass('focus');
                });

                // 导航栏超出窗口高度后的模拟滚动条
                var sHeight = $(".sidebar").height();
                var subHeight = $(".subnav").height();
                var diff = subHeight - sHeight; //250
                var sub = $(".subnav");
                if (diff > 0) {
                    $(window).mousewheel(function(event, delta) {
                        if (delta > 0) {
                            if (parseInt(sub.css('marginTop')) > -10) {
                                sub.css('marginTop', '0px');
                            } else {
                                sub.css('marginTop', '+=' + 10);
                            }
                        } else {
                            if (parseInt(sub.css('marginTop')) < '-' + (diff - 10)) {
                                sub.css('marginTop', '-' + (diff - 10));
                            } else {
                                sub.css('marginTop', '-=' + 10);
                            }
                        }
                    });
                }
            } ();
        </script> 
  </div>  
 </body>
</html>