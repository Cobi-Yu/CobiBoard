FROM ubuntu:14.04
MAINTAINER CobiYu <gudghks0825@naver.com>

RUN apt-get update
RUN apt-get upgrade
RUN apt-get install -y git
RUN apt-get install -y apache2
RUN apt-get install -y php5

#RUN { \
#   echo mysql-community-server mysql-community-server/data-dir select ''; \
#   echo mysql-community-server mysql-community-server/root-pass password ''; \
#   echo mysql-community-server mysql-community-server/re-root-pass password ''; \
#   echo mysql-community-server mysql-community-server/remove-test-db select false; \
#} | debconf-set-selections \
#&& apt-get install -y mysql-server

RUN rm -rf /var/www/*
RUN git clone https://github.com/Cobi-Yu/CobiBoard.git /var/www/html

ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80
EXPOSE 8080
EXPOSE 3306

ENTRYPOINT /entrypoint.sh
