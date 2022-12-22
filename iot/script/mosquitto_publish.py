import paho.mqtt.client as mqtt #import the client1

broker_address="change me" #ip mosquitto server
port=0 #change me

topic = input("Enter your Topic: ")
message = input("Enter your Message: ")

client = mqtt.Client(client_id="change me") # create new instance
client.connect(broker_address, port, 60) #connect to broker
client.publish(topic,message) #publish (topic,message)