FROM ubuntu:20.04

RUN apt-get update
RUN apt-get upgrade -y
RUN ln -snf /usr/share/zoneinfo/$DATE_TIMEZONE /etc/localtime && echo $DATE_TIMEZONE > /etc/timezone

RUN apt-get install -y zip unzip
RUN apt-get install -y \
	php7.4 \
	php7.4-mysql
RUN apt-get install apache2 libapache2-mod-php7.4 -y
RUN apt-get install mariadb-common mariadb-server mariadb-client -y
RUN apt-get install git composer nano tree vim curl net-tools wget -y
RUN apt-get install netcat iputils-ping -y
RUN apt-get install -y python3-pip python3-dev \
  && cd /usr/local/bin \
  && ln -s /usr/bin/python3 python \
  && pip3 install --upgrade pip
RUN apt-get -y install openssh-server sudo
RUN apt-get -y install vsftpd
RUN apt-get -y install ftp

ENV DATE_TIMEZONE Asia/Bangkok

COPY ./app /var/www/html/
RUN rm -rf /var/www/html/index.nginx-debian.html

#data
COPY ./mysql/loginadminuser.sql /var/lib/mysql/loginadminuser.sql

#copy config
COPY ./vsftpd.conf /etc/vsftpd.conf
COPY ./vsftpd.chroot_list /etc/vsftpd.chroot_list
RUN chmod 644 /etc/vsftpd.conf
RUN chmod 644 /etc/vsftpd.chroot_list

#adduser
RUN useradd -ms /bin/bash master-mc && echo "master-mc:1234" | chpasswd
RUN echo "hello" > /home/master-mc/hello.txt
COPY ./ftpMeme/helpPls.png /home/master-mc/helpPls.png

#config command
COPY ./scripts/start /start
RUN chmod +x /start

#run ssh
RUN service ssh start

EXPOSE 20
EXPOSE 21
EXPOSE 22
EXPOSE 80

CMD ["/start"]