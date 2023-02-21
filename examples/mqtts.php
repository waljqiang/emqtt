<?php
require_once __DIR__ . '/../vendor/autoload.php';
ini_set('error_log', __DIR__ . './runtime/mqtt.log');
use Waljqiang\Mqtt\Mqtt;
use Waljqiang\Mqtt\MessageHandler;

class CallBack extends MessageHandler{
	public function onPublish(Mqtt $mqtt,$publishObject){
		printf(
            "msgid[%d] qos[%d] dup[%d] topic[%s] msg[%s]\n",
            $publishObject->getMsgID(),
            $publishObject->getQoS(),
            $publishObject->getDup(),
            $publishObject->getTopic(),
            $publishObject->getMessage()
        );
	}
}

try{
	$config = [
		'address' => 'tls://192.168.111.208:9100',
		'username' => 'cloudnetlot',
		'password' => 'admin@cloudnetlot',
		'clean' => true,
		'qos' => 0,
		'retain' => 0,
		'keepalive' => 10,
		'timeout' => 60,
		'ssl' => [
			'verify_peer_name' => true,
		    'allow_self_signed' => true,
		    'cafile' => '/vagrant/mqtt/examples/cloudnetlot201_208_209_104ca.pem',
		    'local_cert' => '/vagrant/mqtt/examples/cloudnetlot201_208_209_104client.pem',
		    'local_pk' => '/vagrant/mqtt/examples/cloudnetlot201_208_209_104client.key'
		]
	];
	//Mqtt::setDebug(true,4);
/*	$mqtt = new Mqtt($config['address'],['ssl' => $config['ssl']]);
	$mqtt->setClientID("test_mqtts");
	$mqtt->setAuth($config['username'],$config['password']);
	$mqtt->setKeepalive($config['keepalive']);

	if(!$mqtt->connect()){
		die('Not Connected');
	}

	$topic['test/test/app2dev'] = 1;
	$mqtt->subscribe($topic);
	$mqtt->setHandler(new CallBack());
	$mqtt->loop();*/

	$mqtt = new Mqtt($config['address'],['ssl' => $config['ssl']]);
	$mqtt->setClientID("test_mqtts_send");
	$mqtt->setAuth($config['username'],$config['password']);

	if(!$mqtt->connect()){
		die('Not Connected');
	}

	$mqtt->publish_async('test/test/app2dev',"hello",0);
}catch(\Exception $e){
	var_dump($e->getMessage());
}