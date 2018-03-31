<?php

/**
* sms短信接口
*/
class Sms
{
	protected $config;
	function __construct()
	{
		$this->config = include 'config.php';
	}

	 /*
	 *云通讯 http://www.yuntongxun.com
	 */
	 public static function yuntongxun($code ,$phone){
		include './extend/yuntongxun.php';
		$config = $this->config['yuntongxun'];

		$accountSid		= 	$config['accountSid']; //主帐号
		$accountToken	= 	$config['accountToken']; //主帐号Token
		$appId			=	$config['appId']; //应用Id
		$serverIP		=	$config['serverIP']; //请求地址，格式如下，不需要写 https://
		$serverPort		=	$config['serverPort']; //请求端口 
		$softVersion	=	$config['softVersion']; //REST版本号

		//实例化
		$rest = new \REST($serverIP,$serverPort,$softVersion);
		$rest->setAccount($accountSid,$accountToken);
		$rest->setAppId($appId);

		//模板id		
		$templateId = $config['templateId'];
		
		//发送短信
		$result = $rest->sendTemplateSMS($phone,[$code,10],$templateId);
		
		if( $result == NULL ) {
			echo "result error!";
			break;
		}

		if($result->statusCode!=0) {
			echo "error code :" . $result->statusCode . "<br>";
			echo "error msg :" . $result->statusMsg . "<br>";
			//TODO 添加错误处理逻辑
			return false;
		}else{
			// echo "Sendind TemplateSMS success!<br/>";
			// 获取返回信息
			$smsmessage = $result->TemplateSMS;
			// echo "dateCreated:".$smsmessage->dateCreated."<br/>";
			// echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
			//TODO 添加成功处理逻辑
			return true;
		}
	 }


	/**
	 * 短信宝 http://www.smsbao.com/
	 */
	public function smsbao($code ,$phone)
	{
		$config = $this->config['smsbao'];

		$content = '您的验证码为'.$code.'，在10分钟内有效。';

		$smsapi = "http://api.smsbao.com/"; //短信网关
		$user = $this->config['user']; //短信平台帐号
		$pass = md5($this->config['pass']); //短信平台密码
		$content="【".$this->config['title']."】".$content;//要发送的短信内容
		$phone = $phone;
		$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);

		$result =file_get_contents($sendurl) ;

		$status = [
			"0" => "短信发送成功",
			"-1" => "参数不全",
			"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
			"30" => "密码错误",
			"40" => "账号不存在",
			"41" => "余额不足",
			"42" => "帐户已过期",
			"43" => "IP地址限制",
			"50" => "内容含有敏感词"
		];

		if($result != 0){
			echo $status[$result];
		 	return false;
		}else{
			echo $status[$result];
			return true;
		}
	}


	// 叮咚云  http://dingdongcloud.com
	public function sendsms($code ,$phone){
		$config = $this->config['dingdong'];
		$apikey = $config['appkey'];

		$url="https://api.dingdongcloud.com/v1/sms/sendyzm";
        $content = "【".$config['title']."】你的验证码是".$code."，请在10分钟内输入。";
        $content = urlencode($content);

        $rdata = sprintf("apikey=%s&mobile=%s&content=%s", $apikey, $phone, $content);
        $url = $url.'?'.$rdata;
       	
       	$result = file_get_contents($url);

       	$arr = json_decode($result,1);
        if($arr['code'] == 1){
        	return true;
        }else{
        	return false;
        }
        
	}
	
	// 聚合数据短信API  https://www.juhe.cn/docs/api/id/54
	public function juhe($code ,$phone){
		$config = $this->config['juhe'];
		include './extend/juhe.php';

		$juhe = new \Juhe($config);
		$juhe->send($code ,$phone);
	}

	// Luosimao  https://luosimao.com
	public function luosimao($code ,$phone)
	{
		$config = $this->config['luosimao'];
		include './extend/luosimao.php';

		//api key可在后台查看 短信->触发发送下面查看
		$sms = new \Luosimao( array('api_key' => $config['appkey'] , 'use_ssl' => FALSE ) );

		//send 单发接口，签名需在后台报备
		$res = $sms->send( $phone, '验证码：'.$code.'【铁壳测试】');
		if( $res ){
		    if( isset( $res['error'] ) &&  $res['error'] == 0 ){
		        echo 'success';
		    }else{
		        echo 'failed,code:'.$res['error'].',msg:'.$res['msg'];
		    }
		}else{
		    var_dump( $sms->last_error() );
		}
		exit;
	}

	// http://www.yunsms.cn
	public function yunsms($code ,$phone)
	{
		$config = $this->config['yunsms'];
		include './extend/yunsms.php';

		$uid = $config['uid '];		//数字用户名
		$pwd = $config['pwd '];		//密码

		$content = '你好，你的短信验证码为：'.$code.'，请在1分钟内验证。【云曼】';		//内容

		//即时发送
		$res = YunSms($uid,$pwd,$phone,$content);
		echo $res;

		//定时发送
		/*
		$time = '2010-05-27 12:11';
		$res = YunSms($uid,$pwd,$mobile,$content,$time);
		echo $res;
		*/
	}
	
	// 极光短信 http://docs.jiguang.cn
	public function jsms($code ,$phone)
	{
		$config = $this->config['jsms'];
		include './extend/jsms.php';

		# 这里的 $temp_id 和 $temp_para 的值需要到 "极光控制台 -> 短信验证码 -> 模板管理" 里面获取
		// $temp_id = '6666';
		// $temp_para = ['test' => 'jiguang'];
		
		$client = new \JiGuang\JSMS($config['appkey'], $config['masterSecret']);
		$response = $client->sendMessage($phone, $config['temp_id'], $config['temp_para']);
		print_r($response);

	}

	// 凯信通 http://kingtto.cn
	public function kingtto($code ,$phone)
	{
		$config = $this->config['kingtto'];
		include './extend/juhe.php';

		$juhe = new \Kingtto($config);
		$juhe->send($code ,$phone);
	}

}