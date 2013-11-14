Java-PHP-UDP
============

A simple UDP socket connection between Java (Client) and PHP (Server)

##### Server Side

First, launch the PHP file (server side) from command line :

```unix
cd your_path
php src/UDPServer.php
```

The last two lines of the PHP script will automatically instanciate a SocketRealTime class object and start it (you have to put your host & port as parameters)

```php
$obj = SocketRealTime::getInstance();
$obj->launch_udp_server("127.0.0.1", 9999);
```


##### Client Side

you only have to modify the host & port in the MySocket.java (line 30). 

*Please set the same information than server side.*

Then compile and execute java file :

```unix
javac src/UDPServer.java
java UDPServer
```

You're done ! UDP data (messageStr) in the java class was succefully send to the PHP script.

