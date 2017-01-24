# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "hashicorp/precise64"
  # config.vm.box_check_update = false
  # config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "private_network", ip: "192.168.33.10"
  # config.vm.network "public_network"
  # config.vm.synced_folder "../data", "/vagrant_data"
  config.vm.provision "shell", inline: <<-SHELL
    echo "deb http://ppa.launchpad.net/nginx/stable/ubuntu $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/nginx-stable.list
    apt-key adv --keyserver keyserver.ubuntu.com --recv-keys C300EE8C
    apt-get update
    apt-get install -y nginx

    apt-get install -y python-software-properties
    add-apt-repository -y ppa:ondrej/php
    apt-get update
    debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
    debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
    apt-get install -y php5.6 php5.6-fpm php5.6-mysql php5.6-cli php5.6-xml php5.6-intl vim
    cp -f /vagrant/app/provision/www.conf /etc/php/5.6/fpm/pool.d/www.conf
    cp -f /vagrant/app/provision/default /etc/nginx/sites-enabled/default
    cp -f /vagrant/app/provision/php_fpm.ini /etc/php/5.6/fpm/php.ini
    cp -f /vagrant/app/provision/php_cli.ini /etc/php/5.6/cli/php.ini
    service php5.6-fpm restart
    service nginx restart

  SHELL
end
