<?php
require_once __DIR__ .'/shared.php';
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
	Mqtt::setDebug(true,4);
	$mqtt = new Mqtt($config['address']);
	$mqtt->setClientID(uniqid());
	$mqtt->setAuth($config['username'],$config['password']);
	$mqtt->setKeepalive(60);

	if(!$mqtt->connect()){
		die("Not Connected");
	}

	$topics["sensor/dev/sub/#"] = 1;

	$mqtt->subscribe($topics);
	#$mqtt->unsubscribe(array_keys($topics));
	$mqtt->setHandler(new CallBack());
	$mqtt->loop();
}catch(\Exception $e){
	var_dump($e->getMessage());
}