run vpnpi
go to vpn file and run
sudo docker run --name=mastertest --network=cNetwork --ip=172.30.3.2 --restart unless-stopped -v $PWD/openvpn-pi:/etc/openvpn -d -p 1200:1194/udp --cap-add=NET_ADMIN kylemanna/openvpn