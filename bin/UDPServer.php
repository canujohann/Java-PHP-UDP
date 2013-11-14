<?php

/**
* create a UDP socket server
* Based on Singleton pattern
*/
Class SocketRealTime {

	private $sock ; 			// Socket
	private static $singleton ;	// Singleton

	private $domain ;	// Socket domain
	private $port ;		// Socket port
	private $is_running = false;

	// No constructor
	private function __construct(){}

	// Get singleton
	public static function getInstance(){
		if (self::$singleton == null){
			self::$singleton =  new self;
		}
		return self::$singleton ;
	}

	// Start server
	public function launch_udp_server($domain, $port){

		if (!$this->is_running){

			// Set flag
			$this->is_running = true ;

			// Set info
			$this->domain 	= $domain;
			$this->port 	= $port;

			// Socket setting
			$this->socket_creation();
			$this->socket_bind();
			$this->launch_loop();

		}else{
			echo "UDP already exists !";
		}
	}

	// Socket creation
	private function socket_creation(){
		if(!($this->sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP))){
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		echo "Socket created \n";
	}

	// Binder
	private function socket_bind(){
		if( !socket_bind($this->sock, $this->domain , $this->port ) ){
		    $errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);

		    die("Could not bind socket : [$errorcode] $errormsg \n");
		}
		echo "Socket bind OK \n";
	}

	// Loop
	private function launch_loop(){

		while(1){
		    $r = socket_recvfrom($this->sock, $buf, 512, 0, $remote_ip, $remote_port);
		    $this->update_data($buf);
		}
		socket_close($sock);
	}

	
	private function update_data($data){
		// TODO  Put here your data process
		echo "data are updated ! \r";			
	}

}

// GO GO !!
$obj = SocketRealTime::getInstance();
$obj->launch_udp_server("127.0.0.1", 9999);