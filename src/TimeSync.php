<?php

/*
__PocketMine Plugin__
name=TimeSync
version=1.0
author=JWhy
class=TimeSync
apiversion=10
*/

class TimeSync implements Plugin{
  
    private $interval = 3; //Interval in seconds between time updates
    private $offset = 0;
  
    private $api;
    private $timer;
    
    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }
    
    public function init(){
        if($this->startTimer($this->interval)){
            //console('Timer (' . $this->interval . ' sec interval) successfully registered');
        }else{
            console('Timer (' . $this->interval . ' sec interval) could not be registered');
        }
    }
    
    public function __destruct(){
      
    }
    
    private function startTimer($interval){
        try{
            //Create new thread instance
            $this->timer = new TimedAnnouncer($this, $this->interval, $this->offset);
            
            //Start the thread
            $this->timer->start();
        }catch(Exception $e){
            console($e->getMessage());
            return false;
        }
        return true;
    }
    
    public function setTime($val){
        $this->api->time->set($val);
    }
    
}
    
class TimedAnnouncer extends Thread {
    private $plugin;
    public $interval;
    public $offset;
    
    public function __construct($plugin, $interval, $offset = 0){
        $this->plugin = $plugin;
        $this->interval = $interval;
        $this->offset = $offset;
    }
     
    public function run() {
        while(true){
            $this->plugin->setTime(0 + offset);
            //Wait some seconds
            sleep($this->interval);
        }
    }
}
