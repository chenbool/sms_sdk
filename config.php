<?php
return [
	// 1. 云通讯 http://www.yuntongxun.com
    'yuntongxun' => [           
        'accountSid' 		=> '8a216da85e5b3555015e5fa966a302c4',	//主帐号
        'accountToken'	 	=>	'6e2e1c484af34282bc66ad4e8dc31123',	    //主帐号Token
        'appId'             =>  '8a216da85e5b3555015e5fa966e802c9',     //应用Id
        'templateId'		=>	'203826',
        'serverIP' 	        => "app.cloopen.com",   
        'serverPort' 	    => '8883',
        'softVersion'       =>  '2013-12-26' 
    ],

	// 2. 短信宝 http://www.smsbao.com
    'smsbao' => [           
        'smsapi' 	=> 'http://www.smsbao.com',	//短信网关
        'user'	 	=>	'bool',	    //短信平台帐号
        'pass'      =>  md5('bool'),     //短信平台密码
        'title'		=>	'短信标题',
    ], 

	// 3. 叮咚云  http://dingdongcloud.com
    'dingdong' => [           
        'smsapi' 	=> 'https://api.dingdongcloud.com/v1/sms/sendyzm',	//短信网关
        'appkey'	=>	'fe7e701f21645f35d62b95df8c85493f',	    //账户唯一标识符
        'pass'      =>  md5('bool'),     //短信平台密码
        'title'	=>	'短信标题',
    ], 
       
	// 4. 聚合数据短信API  https://www.juhe.cn/docs/api/id/54
    'juhe' => [           
        'smsapi' 	=> 'http://v.juhe.cn/sms/send',	//短信网关
        'appkey'	=>	'fe7e701f21645f35d62b95df8c85493f',	    //账户唯一标识符
        'tpl_id'    =>  '111',     //您申请的短信模板ID，根据实际情况修改
        'tpl_value' =>  '#code#=1234&#company#=聚合数据',     //您设置的模板变量，根据实际情况修改
    ],  

    // 5. Luosimao  https://luosimao.com
    'luosimao' => [           
        'appkey'    =>  'fe7e701f21645f35d62b95df8c85493f',     //账户唯一标识符
    ], 

    // 6. Luosimao  https://luosimao.com
    'yunsms' => [           
        'uid'    =>  'fe7e701f21645f35d62b95df8c85493f',     //账户唯一标识符
        'pwd'    =>  'fe7e701f21645f35d62b95df8c85493f',     //密码
    ], 

    // 7. 极光短信 https://docs.jiguang.cn/jsms
    'jsms' => [           
        'appkey'        =>  'fe7e701f21645f35d62b95df8c85493f',     //账户唯一标识符
        'masterSecret'  =>  'fe7e701f21645f35d62b95df8c85493f',     //密码
        'temp_id'       =>  'fe7e701f21645f35d62b95df8c85493f',     //模板id
        'temp_para'     =>  ['test' => 'jiguang'],     
    ], 

    // 8. 凯信通 http://kingtto.cn
    'kingtto' => [           
        'userid'        =>  'fe7e701f21645f35d62b95df8c85493f',     //账户唯一标识符
        'account'  =>  'fe7e701f21645f35d62b95df8c85493f',     
        'password'       =>  'fe7e701f21645f35d62b95df8c85493f',     
        'temp_para'     =>  ['test' => 'jiguang'],     
    ], 
];