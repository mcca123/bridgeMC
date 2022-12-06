import paho.mqtt.client as mqtt #import the client1

broker_address="" #ip
port=0
conTimeOut=60

client = mqtt.Client(client_id="change me", clean_session=True) # create new instance
client.connect(broker_address, port, conTimeOut) #connect to broker
client.publish("change me","change me") #publish (topic,message)