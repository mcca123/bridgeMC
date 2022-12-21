#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <Servo.h>

// Update these with values suitable for your network.

const char* ssid = "Bell–LaPadula-iot";
const char* password = "icl@iot!";
const char* mqttServer = "192.168.137.36";
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
long cm;

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
    senserToInt = senserToInt*2;
    if(senserToInt > 100){
      senserToInt = 100;
    }
    bridgeIot.write(senserToInt);
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
    //int sensor1 = checkSensor1();
    Serial.println();

    int u1 = getLength(echoPin1, trigPin1); // วัดระยะทาง Ultrasonic ตัวที่ 1
    Serial.print("node/sensor1 Publish message: ");
    Serial.println(u1);
    snprintf (msg, MSG_BUFFER_SIZE, "%ld", u1);
    client.publish("node/sensor1", msg);
    memset(msg, 0, sizeof(msg));
    delay(1000);
    
    int u2 = getLength(echoPin2, trigPin2); // วัดระยะทาง Ultrasonic ตัวที่ 2
    Serial.print("node/sensor2 Publish message: ");
    Serial.println(u2);
    snprintf (msg, MSG_BUFFER_SIZE, "%ld", u2);
    client.publish("node/sensor2", msg);
    memset(msg, 0, sizeof(msg));
    delay(1000);
  }
}

//เช็คระยะห่าง sensor
int getLength(int echo, int trig){
  // Clears the trigPin
  digitalWrite(trig, LOW);
  delayMicroseconds(2);

  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);

  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echo, HIGH);

  // Calculating the distance
  distance= duration*0.034/2;
  return(distance);
}
