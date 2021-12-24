<?php
/**
 * 全部的类都同一个文件，避免多加载
 */

class YunFileBlogs {

    protected $id;
    protected $ip;
    protected $ua;
    protected $ref;
    protected $url;
    protected $http = 'http://';
    protected $phps;
    protected $userid;
    protected $version;
    protected $username;
    protected $versiontype;
    protected $pdsfffffffffffk = array();  ///尼玛，之前源码没了


    public function getid($id) {
        $this->$pdsfffffffffffk['id'] = $id;
        return $this;
    }


    public function getip() {
    static $rip;
    if (isset($_SERVER)){
    	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){$rip=$_SERVER['HTTP_X_FORWARDED_FOR'];}elseif(isset($_SERVER['HTTP_CLIENT_IP'])){$rip=$_SERVER['HTTP_CLIENT_IP'];}else{$rip=$_SERVER['REMOTE_ADDR'];}
    }else{
        if(getenv('HTTP_X_FORWARDED_FOR')){$rip=getenv('HTTP_X_FORWARDED_FOR');}elseif(getenv('HTTP_CLIENT_IP')){$rip=getenv('HTTP_CLIENT_IP');}else{$rip=getenv('REMOTE_ADDR');}
    }
        $this->$pdsfffffffffffk['ip'] = $rip;
        return $this;
    }
    
    public function getua() {
        $this->$pdsfffffffffffk['ua'] = $_SERVER['HTTP_USER_AGENT'];
        return $this;
    }


   public function getref() {
        $this->$pdsfffffffffffk['ref'] = $_SERVER["HTTP_REFERER"];
        return $this;
    }
    
    
    public function geturl($url,$phps) {
        $this->url = $url.$phps;
        return $this;
    }
  

    public function getphps($phps) {
        $this->phps = $phps;
        return $this;
    }
    
    
    public function getuserid($userid) {
        $this->$pdsfffffffffffk['userid'] = $userid;
        return $this;
    }
    
    
    public function getversion($version) {
        $this->$pdsfffffffffffk['version'] = $version;
        return $this;
    }
    
    
    public function getusername($username) {
        $this->$pdsfffffffffffk['username'] = $username;
        return $this;
    }


    public function getversiontype($versiontype) {
        $this->$pdsfffffffffffk['version-type'] = $versiontype;
        return $this;
    }


    public function setssl($ssl) {
        $this->ssl = $ssl;
        return $this;
    }


    public function request() {
        
        if (!empty($this->phps)) {
        	$url = $this->url;
        }

        $rs = $this->getjson($this->trequest($url, $this->$pdsfffffffffffk, 300, true));
        
        if($rs['json']){
        	if($rs['data']['state'] != 200){
        	echo $this->setjson(array('name'=>$this->$pdsfffffffffffk['version-type'], 'time'=>time(), 'msg'=>$rs['data']['msg'],'state'=>$rs['data']['state']), true);
        	}else{
        	echo $rs['data']['data']['content'];
        	}
        }else{
        	echo $this->setjson(array('name'=>$this->$pdsfffffffffffk['version-type'], 'time'=>time(), 'msg'=>'错误','state'=>000), true);
        }
        
    }


    protected function trequest($url, $data = [], $timeout = 30, $ssl = false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeout);

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        if($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }


    protected function getjson($data) {
    	
    	if($data){
    		$arr['data'] = json_decode($data, true);
    		$arr['json'] = true;
    	}else{
    		$arr['json'] = false;
    	}
        return $arr;
    }
    
    
    public function setjson($data, $zw = false) {
    	return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
