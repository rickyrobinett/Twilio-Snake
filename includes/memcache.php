<?php

class RR_Memcache{
    static public $host = "127.0.0.1";
    static public $memc;

    public function __construct(){
      // let's make this a singleton
      if(isset($memc)){
        return $this;
      }

      self::$memc = new Memcache;
      self::$memc->addServer(self::$host);
    }

    public function set($key,$value){
      self::$memc->set($key,$value,2);
    }

    public function get($key){
      return self::$memc->get($key);
    }
}
