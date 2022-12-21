vpnPi 
run from bridgeMC/vpn
sudo docker run --name=mastertest --network=cNetwork --ip=10.30.3.2 --restart unless-stopped -v $PWD/openvpn-pi:/etc/openvpn -d -p 1200:1194/udp --cap-add=NET_ADMIN kylemanna/openvpn

mosquitto on kali
run from bridgeMC/mosquitto
go to mosquitto.conf and delete config from path
docker run -it --name mosquitto -p 1883:1883 -v $(pwd):/mosquitto/ eclipse-mosquitto:1.4.10

