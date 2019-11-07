<?php
namespace Waljqiang\Mqtt;

use sskaje\mqtt\MessageHandler as BaseHandler;
use Waljqiang\Mqtt\Mqtt;

class MessageHandler extends BaseHandler{
	public $waitQueue = [];

	public function onConnack(Mqtt $mqtt, $connack_object){
		
    }

    public function onDisconnect(Mqtt $mqtt){
    	
    }

    public function onSuback(Mqtt $mqtt, $suback_object){
    	
    }

    public function onUnsuback(Mqtt $mqtt, $unsuback_object){
    	
    }

    public function onPublish(Mqtt $mqtt, $public_object){
    	
    }

    public function onPuback(Mqtt $mqtt, $puback_object){
    	
    }

    public function onPubrec(Mqtt $mqtt, $pubrec_object){
    	
    }

    public function onPubrel(MQTT $mqtt, $pubrel_object){
    	
    }

    public function onPubcomp(Mqtt $mqtt,$pubcomp_object){

    }

    public function onPingresp(Mqtt $mqtt,$pingresp_object){

    }

}