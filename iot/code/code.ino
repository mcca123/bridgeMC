#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <Servo.h>

// Update these with values suitable for your network.

const char* ssid = "Malenia_2.4G";
const char* password = "0986524559";
const char* mqttServer = "192.168.1.104";
const char* mqttUser = "mastermcca";
const char* mqttPassword = "vpjkg-hk,kot";

//Senser 1
const int trigPin1 = D5;
const int echoPin1 = D6;

//Senser 2
const int trigPin2 = D7;
const int echoPin2 = D8;

//bridge D0
Servo bridgeIot; 

//barrier D1
Servo barrierIot; 

//alarm
const int alarmPin = D2;

//senser ตัวแปร
long duration;
int distance;

//wifi
WiFiClient espClient;
PubSubClient client(espClient);
unsigned long lastMsg = 0;
#define MSG_BUFFER_SIZE  (50)
char msg[MSG_BUFFER_SIZE];

void setup_wifi() {

  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  randomSeed(micros());

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void callback(char* topic, byte* payload, unsigned int length) {
  String receivedtopic = topic;
  String receivedpayload ;
  int senserToInt;
  
  for (int i = 0; i < length; i++) {
    receivedpayload += (char)payload[i];
    Serial.print((char)payload[i]);
  }

  senserToInt = receivedpayload.toInt();
  Serial.println();

  if(receivedtopic == "node/alarm"){ //Alarm
    if(senserToInt == 1){
       digitalWrite(alarmPin, LOW);
       //alarn On
    }else{
      digitalWrite(alarmPin, HIGH);
      //alarn oFF
    }
  }else if(receivedtopic == "node/barrier"){ //barrier
    barrierIot.write(senserToInt);
  }else if(receivedtopic == "node/bridge"){ //bridge
    delay(2000);
    senserToInt = senserToInt*2;
    if(senserToInt > 140){
      senserToInt = 140;
    }
    if(senserToInt > 0){
      for(int x=0;x<senserToInt;x++){
        bridgeIot.write(x);
        delay(15);
      }
    }else if(senserToInt < 140){
      for(int x=140;x<senserToInt;x--){
        bridgeIot.write(x);
        delay(15);
      }
    }
  } 
}

void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    if (client.connect("ESP32Client", mqttUser, mqttPassword )) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      client.publish("node/connect", "MQTT Server is Connected");
      // ... and resubscribe
      client.subscribe("node/bridge");
      client.subscribe("node/alarm");
      client.subscribe("node/barrier");
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void setup() {
  pinMode(BUILTIN_LED, OUTPUT);     // Initialize the BUILTIN_LED pin as an output
  pinMode(trigPin1, OUTPUT); // Sets the trigPin1 as an Output
  pinMode(echoPin1, INPUT); // Sets the echoPin1 as an Input
  pinMode(trigPin2, OUTPUT); // Sets the trigPin2 as an Output
  pinMode(echoPin2, INPUT); // Sets the echoPin2 as an Input
  pinMode(alarmPin, OUTPUT); // Sets the alarmPin as an Output
  bridgeIot.attach(D0); // Sets the bridgeIot as an Output
  barrierIot.attach(D1);
  Serial.begin(115200);
  digitalWrite(alarmPin, HIGH); //set alarm off when start
  setup_wifi();
  client.setServer(mqttServer, 1883);
  client.setCallback(callback);
}

void loop() {

  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  unsigned long now = millis();
  if (now - lastMsg > 2000) {
    lastMsg = now;
    int sensor1 = checkSensor1();
    Serial.println();
    snprintf (msg, MSG_BUFFER_SIZE, "%ld", sensor1);
    Serial.print("node/sensor1 Publish message: ");
    Serial.println(msg);
    client.publish("node/sensor1", msg);

    Serial.print("node/sensor2 Publish message: ");
    int sensor2 = checkSensor2();
    snprintf (msg, MSG_BUFFER_SIZE, "%ld", sensor2);
    client.publish("node/sensor2", msg);
  }
}

//เช็คระยะห่าง sensor1
int checkSensor1(){
  // Clears the trigPin
  digitalWrite(trigPin1, LOW);
  delayMicroseconds(2);

  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin1, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin1, LOW);

  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echoPin1, HIGH);

  // Calculating the distance
  distance= duration*0.034/2;
  Serial.println(distance);
  return(distance);
}

//เช็คระยะห่าง sensor2
int checkSensor2(){
  // Clears the trigPin
  digitalWrite(trigPin2, LOW);
  delayMicroseconds(2);

  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin2, LOW);

  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echoPin2, HIGH);

  // Calculating the distance
  distance= duration*0.034/2;
  Serial.println(distance);
  return(distance);
}
