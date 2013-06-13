#!/usr/bin/env bash

# testa se o script já foi executado e termina a execução caso se verdadeiro
test -f /etc/bootstraped && exit

# Proxy da UFU :/
PROXY_UFU="http://proxy.ufu.br:3128/"
export http_proxy=$PROXY_UFU

apt-get update

#
# Banco de dados
#

POSTGRESQL_VERSION="9.1+129"

# Postgresql 9.1
apt-get install -y postgresql=$POSTGRESQL_VERSION

# Copia a configuração que é usada pelo rad-ufu
sudo cp /vagrant/env/postgresql/pg_hba.conf /etc/postgresql/9.1/main/pg_hba.conf

DB_NAME="radufu"
DB_SCHEMA=$DB_NAME
DB_USER="radufu"
DB_PASSWORD=$DB_USER

# Cria usuário radufu
create_user="CREATE USER $DB_USER WITH PASSWORD '$DB_PASSWORD';"
sudo -u postgres psql --command="$create_user" template1

# Cria o BD
sudo -u postgres createdb --owner=$DB_USER $DB_NAME

# Reinicia o servidor de BD
service postgresql restart

# Cria as tabelas
create_tables="\i /vagrant/src/RADUFU/util/rad-ufu.sql"
PGPASSWORD=$DB_PASSWORD psql --command="$create_tables" $DB_NAME $DB_USER

# Insere resolução condir 13-2007
insert_resolucao="\i /vagrant/src/RADUFU/util/resolucao-CONDIR-13-2007.sql"
PGPASSWORD=$DB_PASSWORD psql --command="$insert_resolucao" $DB_NAME $DB_USER

#
# Apache
#

APACHE_VERSION="2.2.22-1ubuntu1.3"

# Instala o apache e cria link simbólico de '/var/www' para '/vagrant'
apt-get install -y apache2=$APACHE_VERSION
rm -rf /var/www
ln -fs /vagrant /var/www

# Ativa o 'mod_rewrite' do apache
a2enmod rewrite
sudo cp /vagrant/env/apache/default /etc/apache2/sites-available/default
service apache2 restart

#
# PHP
#

PHP_PPA="ppa:ondrej/php5"
PHP_VERSION="5.4.15-1~precise+1"

# Instala o 'add-apt-repository'
apt-get install -y python-software-properties

# Instala o ppa
add-apt-repository -y $PHP_PPA
apt-get update

# Instala o PHP
apt-get install -y --force-yes php5=$PHP_VERSION php5-pgsql=$PHP_VERSION

#
# Git
#

sudo apt-get install -y git

#
# Composer
#

# Baixa e instala o Composer
apt-get install -y curl
curl -sS --proxy $PROXY_UFU https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

#
# RAD
#

# Instala dependências do RAD
cd /vagrant && composer install --prefer-source

# Cria diretório para comprovantes
mkdir -p /home/rad/comprovantes
chown --recursive www-data /home/rad

# Sinaliza que este script já foi executado
date > /etc/bootstraped