# Phalcon 3.0.x Quick Start
#
# Ubuntu 16.04 LTS w/ PHP 7.0.x using built-in webserver

FROM ubuntu:16.04

MAINTAINER Trevor Smith <djtrevorsmith@gmail.com>

# Set environment variables
ENV DEBIAN_FRONTEND noninteractive
ENV TIMEZONE UTC
ENV DIRPATH /root

WORKDIR /root

# Avoid ERROR: invoke-rc.d: policy-rc.d denied execution of start
RUN echo "#!/bin/sh\nexit 0" > /usr/sbin/policy-rc.d

# Setup timezone
RUN echo "${TIMEZONE}" | tee /etc/timezone &&  \
    dpkg-reconfigure --frontend noninteractive tzdata

# Seup locale
RUN echo " \n\
    LC_CTYPE=en_US.UTF-8 \n\
    LC_ALL=en_US.UTF-8 \n\
    LANG=en_US.UTF-8 \n\
    LANGUAGE=en_US.UTF-8 \n\
    " >> /etc/environment

RUN locale-gen en_US en_US.UTF-8 && \
    dpkg-reconfigure locales && \
    export LANGUAGE=en_US.UTF-8 && \
    export LANG=en_US.UTF-8 && \
    export LC_ALL=en_US.UTF-8

# Update Ubuntu
RUN sed -i 's#http://archive.ubuntu.com/ubuntu/#mirror://mirrors.ubuntu.com/mirrors.txt#g' /etc/apt/sources.list && \
    apt-get update && apt-get upgrade -y

# Install required software
RUN apt-get install -y --no-install-suggests --no-install-recommends \
    curl \
    git

# Download Phalcon
RUN curl -k -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | bash

# Install PHP and Phalcon
RUN apt-get install -y --no-install-suggests --no-install-recommends \
    php7.0-cli \
    php7.0-common \
    php7.0-curl \
    php7.0-json \
    php7.0-mysql \
    php7.0-opcache \
    php7.0-phalcon \
    php7.0-readline \
    php-xdebug

# Install Phalcon Tools
RUN git clone git://github.com/phalcon/phalcon-devtools.git && \
    ln -s $DIRPATH/phalcon-devtools/phalcon.php /usr/bin/phalcon && \
    chmod ugo+x /usr/bin/phalcon

# Cleanup package manager
RUN apt-get autoremove && \
    apt-get autoclean && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Define working directory
VOLUME ["/var/www"]

EXPOSE 80

WORKDIR /var/www

# Define default command
CMD ["/usr/bin/php","-S","0.0.0.0:80","-c","php.ini","-t","public",".htrouter.php"]
