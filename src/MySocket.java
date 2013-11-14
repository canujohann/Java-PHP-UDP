import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.UnknownHostException;

public class MySocket {

	/**
	 * Send an UPD datagram socket
	 * 
	 * In order to avoid NetworkOnMainThreadException with android
	 * we 'll use a thread
	 */
	public static void main(String[] args) {

		new Thread(new Runnable() {
			
			public void run() {

				try {

					// Data
					String messageStr = "I want to send this message via UDP!";
					int msg_length = messageStr.length();
					byte[] message = messageStr.getBytes();

					// Remote server
					int server_port = 9999;
					InetAddress local = InetAddress.getByName("127.0.0.1");

					// UDP socket
					DatagramSocket s = new DatagramSocket();
					DatagramPacket p = new DatagramPacket(message, msg_length,
							local, server_port);
					s.send(p); 	// Send it !

				} catch (UnknownHostException e) {
					// Problem with host
					e.printStackTrace();
				} catch (SocketException e) {
					// Problem with the socket object
					e.printStackTrace();
				} catch (IOException e) {
					// Problem with the send method 
					e.printStackTrace();
				} catch (Exception e) {
					// Other exception
					e.printStackTrace();
				}

			}

		}).start();

	}

}
