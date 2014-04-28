<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 *1. identify
	 *2. store message
	 *3. show responseMessage
	 */

    public function index(){
                echo "hello";
        dump(preg_match('/^group[0-9]*$/',"group12332ads")==null);
        echo "end";
        $this->valid();

        $Platform = D('Wxplatform');
        $platform = $Platform->select();
        dump($platform);
        $this->storeMessage();
        $this->showMessage();
        //$this->display();
        dump($_POST);
    }


    public function wechat_server(){
        $this->display();
    }
    public function showMessage(){
        $fromUsername = 'jupiter';
        $toUsername = 'david';
        $keyword = trim('hello');
        $time = time();
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        $msgType = "text";
        $contentStr = date("Y-m-d H:i:s",time());
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        dump($resultStr);
        
    }
    public function identified(){
        $Wxplatform = D('Wxplatform');
        $pid = $_GET['pid'];
        $map['pid'] = $pid;
        $wxplatform = $Wxplatform->where($map)->find();
        if ($wxplatform == null){
            echo '';
        }
        $token = $wxplatform['token'];
		define("TOKEN", $token);
		$wechatObj = new wechatCallbackapiTest();
		if (isset($_GET['echostr'])) {
		    $wechatObj->valid();
		}else{
		    $wechatObj->responseMsg();
		}


    }
    /**
     * 
     */

    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }


    
    public function responseMsg()
    {
        $Response = D('Response');

        $Text = D("Text");
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
           
            $msgType = "text";
            //get the info
            $map['pid']=1;
            $map['keyword'] = $keyword;
            /**
             * divide this user into group
             */
            
            $res = $Response->where($map)->find();
            $contentStr = $res['reply'];
            //flag
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            $resText['ToUserName'] =  $fromUserName;
            $resText['FromUserName'] =  $toUserName;
            $resText['CreateTime'] =  time();
            $resText['Content'] =  $contentStr;
            $resText['flag'] =  1;
            $Text->add($resText);
        }else{
            echo "";
            exit;
        }
    }

    public function storeMessage(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $Plat_Msg = D("Plat_msg");
        $xml = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><FromUserName><![CDATA[fromUser]]></FromUserName> <CreateTime>1348831860</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[this is a test]]></Content><MsgId>1234567890123456</MsgId></xml>";
        $postStr = $xml;
        dump(!empty($postStr)) ;
        if (!empty($postStr)){
            $pid = $_GET['pid'];
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            /**
             * 
             * @var [fromUsername] [toUserName] [msgId] [createTime] [MsgType] 
             */
            $msgId = strval($postObj->MsgId);
            $MsgType = strval($postObj->MsgType);
            
            /**
             * resotre the relationship between the msgId and the wxplatform
             * @var [type]
             */
            $Plat_msg = D('Plat_msg');
            $plat_msg['msgId']= $msgId;
            $plat_msg['MsgType']= $MsgType;
            $plat_msg['platformId'] = $pid;
            dump($_GET);
            dump($_GET['pid']);
            dump($plat_msg);
            $Plat_msg->data($plat_msg)->add();
            //endretore
            $fromUsername = strval($postObj->FromUserName);
            $toUsername = strval($postObj->ToUserName);
            $createTime = strval($postObj->CreateTime);
            
            dump($MsgType);
            switch ($MsgType) {
                case 'text':
                    $Text = D('Text');
                    $text['ToUserName'] = strval($toUsername);
                    dump();
                    echo 'toUser';
                    $text['FromUserName'] = strval($fromUsername);
                    $text['CreateTime'] = strval($createTime);
                    $text['content'] = strval($postObj->Content);
                    $text['MsgId'] = strval($msgId);
                    dump($text);
                    dump($Text->data($text)->add($text));
                    if (!(preg_match('/^group[0-9]*$/',$text['content'])==null)){
                        // make sure we have insert correctly
                        $flag = $this->addGroup($FromUserName,$text['content'],$pid);

                    }
                    break;
                case 'image':
                    $Image = D('Image');
                    $image['ToUserName'] = $toUsername;
                    $image['FromUserName'] = $fromUsername;
                    $image['CreateTime'] = $createTime;
                    $image['MsgId'] = $msgId;
                    $image['PicUrl'] = strval($postObj->PicUrl);
                    $image['MediaId'] = strval($postObj->MediaId);
                    $Image->add($text);
                    break;
                case 'voice':
                    $Voice = D('Voice');
                    $voice['ToUserName'] = $toUsername;
                    $voice['FromUserName'] = $fromUsername;
                    $voice['CreateTime'] = $createTime;
                    $voice['MediaId']= strval($postObj->MediaId);
                    $voice['Format']= strval($postObj->Format);
                    $voice['MsgId'] = $msgId;
                    $Voice->add($text);
                    
                    break;
                case 'video':
                    $Video = D('Video');
                    $video['ToUserName'] = $toUsername;
                    $video['FromUserName'] = $fromUsername;
                    $video['CreateTime'] = $createTime;
                    $video['MediaId']= strval($postObj->MediaId);
                    $video['ThumbMediaId']= strval($postObj->ThumbMediaId);
                    $video['MsgId'] = $msgId;
                    $Video->add($text);
                    break;
                case 'Location':
                    $Location = D('Location');
                    $location['ToUserName'] = $toUsername;
                    $location['FromUserName'] = $fromUsername;
                    $location['CreateTime'] = $createTime;
                    $location['Location_X']= strval($postObj->Location_X);
                    $location['Location_Y']= strval($postObj->Location_Y);
                    $location['Scale']= strval($postObj->Scale);
                    $location['Label']= strval($postObj->Label);
                    $location['MsgId'] = $msgId;
                    $Location->add($text);
                    break;
                case 'link':
                    $Link = D('Link');
                    $link['ToUserName'] = $toUsername;
                    $link['FromUserName'] = $fromUsername;
                    $link['CreateTime'] = $createTime;
                    $link['Title']= strval($postObj->Title);
                    $link['Description']= strval($postObj->Description);
                    $link['Url']= strval($postObj->Url);
                    $link['MsgId'] = $msgId;
                    $Link->add($text);
                    break;
                default:
                    echo "";
                    break;
            }


        }else{
            echo "";
            //exit;
        }
    }
    /**
     * when user choose their group ,they can be added to the certain group!
     * @param [type] $FromUserName [description]
     * @param [type] $content      [description]
     * @param [type] $pid          [description]
     */
    private function addUserToGroup($FromUserName,$content,$pid){
        $flag = false;
        $Group = D("Group");
        $User_wxp = D('User_wxp');
        $group_id = (int)preg_replace('/^group$/',$content);
        $map['id'] = $group_id;
        $map['wxp_id'] = $pid;
        $group = $Group->where($map)->find();
        if ($group != null){
            $user_wxp['user_id'] = $FromUserName;
            $user_wxp['wxp_id'] =  $pid;
            $user_wxp['group_id'] = $group_id;
            $User_wxp->save($user_wxp);
            $flag =true;
        }
        return $flag;

    }
}

