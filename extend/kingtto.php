<?php

/**
* Kingtto 凯信通
*/
class Kingtto
{
	protected $config;
	function __construct($config)
	{
		$this->config = $config;
	}

	public function send($code,$phone)
	{
		$post_data['userid'] = $this->config['userid'];
		$post_data['account'] = $this->config['account'];
		$post_data['password'] = $this->config['password'];
		$post_data['content'] = '【短信内容】'+$code;

		//多个手机号码用英文半角豆号‘,’分隔
		// $post_data['mobile'] = '130xxxxxxxx,131xxxxxxxx';
		$post_data['mobile'] = $phone;
		
		$url = 'http://sms.kingtto.com:9999/sms.aspx?action=send';
		$o = '';
		foreach ($post_data as $k => $v) {
		    //短信内容需要用urlencode编码，否则可能收到乱码
		    $o.= "$k=" . urlencode($v) . '&';
		}
		$post_data = substr($o, 0, -1);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
		$result = curl_exec($ch);

	}

}