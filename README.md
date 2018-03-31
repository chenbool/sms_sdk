## sms-sdk

短信发送接口

名称| 类型 | 描述
---|---|---
phone|string | 手机号
code|string | 验证码

---

## 使用

```
include './sms.php';

$sms = new Sms();
$sms->yuntongxun('4280','130****0083');
$sms->smsbao('4280','130****0083');
$sms->dingdong('4280','130****0083');
$sms->juhe('4280','130****0083');
$sms->luosimao('4280','130****0083');
$sms->jsms('4280','130****0083');
$sms->yunsms('4280','130****0083');
$sms->kingtto('4280','130****0083');
```

## 集成接口

*  1.`云通讯`
*  2.短信宝
*  	3.叮咚云
*  	4.聚合数据短信
*  	5.Luosimao
*  	6.yunsms
*  	7.jsms
*  	8.凯信通
