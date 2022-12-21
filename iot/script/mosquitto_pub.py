import paho.mqtt.client as mqtt #import the client1

broker_address="192.168.1.107" #ip
port=1883
conTimeOut=60

client = mqtt.Client(client_id="#", clean_session=True) # create new instance
client.connect(broker_address, port, conTimeOut) #connect to broker
client.publish("node/test","123") #publish (topic,message)