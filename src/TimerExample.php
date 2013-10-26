<?php

/*
__PocketMine Plugin__
name=TimerExample
version=1.0
author=JWhy
class=TimerExample
apiversion=10
*/

class TimerExample implements Plugin{
  
    private $api;
    private $timer;
    
    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }
    
    public function init(){
        $interval = 10; //Interval in seconds
        if($this->startTimer($interval)){
            console('Timer (' . $interval . ' sec interval) successfully registered');
        }else{
            console('Timer (' . $interval . ' sec interval) could not be registered');
        }
    }
    
    public function __destruct(){
      
    }
    
    private function startTimer($interval){
        $msgs = array(
            'Coffee isn\'t the only solution!',
            'Did you forget to backup?',
            'There is no place like 127.0.0.1',
            'I had a dream… and there were 1\'s and 0\'s everywhere, and I think I saw a 2!',
            '1f u c4n r34d th1s u r34lly n33d t0 g37 l41d'
        );
        try{
            //Create new thread instance
            $this->timer = new TimedAnnouncer($msgs, $interval);
            
            //Start the thread
            $this->timer->start(); //DON'T use run() here!
        }catch(Exception $e){
            console($e->getMessage());
            return false;
        }
        return true;
    }

}
    
class TimedAnnouncer extends Thread {
    public $msg;
    public $interval;
    
    public function __construct($msg, $interval){
        $this->msg = $msg;
        $this->interval = $interval;
    }
     
    public function run() {
        while(true){
            //Pick random message and print it to the console
            $msg_announce = (is_array($this->msg))? $this->msg[array_rand($this->msg)] : $this->msg;
            console($msg_announce);
            
            //Wait some seconds
            sleep($this->interval);
        }
    }
}
