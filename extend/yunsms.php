<?php
/*--------------------------------
����:HTTP�ӿ� ���Ͷ���
˵��:		http://http.yunsms.cn/tx/?uid=�����û���&pwd=MD5λ32����&mobile=����&content=����
״̬:
	100 ���ͳɹ�
	101 ��֤ʧ��
	102 ���Ų���
	103 ����ʧ��
	104 �Ƿ��ַ�
	105 ���ݹ���
	106 �������
	107 Ƶ�ʹ���
	108 �������ݿ�
	109 �˺Ŷ���
	110 ��ֹƵ����������
	111 ϵͳ�ݶ�����
	112	�д������
	113	��ʱʱ�䲻��
	114	�˺ű�����10���Ӻ��¼
	115	����ʧ��
	116 ��ֹ�ӿڷ���
	117	��IP����ȷ
	120 ϵͳ����
--------------------------------*/
// $uid = '88888';		//�����û���
// $pwd = '8fsd888';		//����
// $mobile	 = '13856977472';	//����
// $content = '��ã���Ķ�����֤��Ϊ��6666������1��������֤����������';		//����
// //��ʱ����
// $res = YunSms($uid,$pwd,$mobile,$content);
// echo $res;

//��ʱ����
/*
$time = '2010-05-27 12:11';
$res = YunSms($uid,$pwd,$mobile,$content,$time);
echo $res;
*/

function YunSms($uid,$pwd,$mobile,$content,$time='',$mid='')
{
	$http = 'http://http.yunsms.cn/tx/';
	$data = array
		(
		'uid'=>$uid,					//�����û���
		'pwd'=>strtolower(md5($pwd)),	//MD5λ32����
		'mobile'=>$mobile,				//����
		'content'=>$content,			//���� ����Է���utf-8���룬����ת��iconv('gbk','utf-8',$content); �����gbk������ת��
		//'content'=>iconv('gbk','utf-8',$content),			//���� ����Է���utf-8���룬����ת��iconv('gbk','utf-8',$content); �����gbk������ת��
		'time'=>$time,		//��ʱ����
		'mid'=>$mid						//����չ��
		);
	$re= postSMS($http,$data);			//POST��ʽ�ύ
	
	 
	if( trim($re) == '100' )
	{
		return "���ͳɹ�!";
	}
	else 
	{
		return "����ʧ��! ״̬��".$re;
	}
}

function postSMS($url,$data='')
{
	$post='';
	$row = parse_url($url);
	$host = $row['host'];
	$port = $row['port'] ? $row['port']:80;
	$file = $row['path'];
	while (list($k,$v) = each($data)) 
	{
		$post .= rawurlencode($k)."=".rawurlencode($v)."&";	//תURL��׼��
	}
	$post = substr( $post , 0 , -1 );
	$len = strlen($post);
	
	//$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
	 
	$fp = stream_socket_client("tcp://".$host.":".$port, $errno, $errstr, 10);
	
	
	
	
	if (!$fp) {
		return "$errstr ($errno)\n";
	} else {
		$receive = '';
		$out = "POST $file HTTP/1.0\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Content-type: application/x-www-form-urlencoded\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Content-Length: $len\r\n\r\n";
		$out .= $post;		
		fwrite($fp, $out);
		while (!feof($fp)) {
			$receive .= fgets($fp, 128);
		}
		fclose($fp);
		$receive = explode("\r\n\r\n",$receive);
		unset($receive[0]);
		return implode("",$receive);
	}
}
?>