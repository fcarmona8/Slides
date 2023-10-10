Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "private_network", ip: "172.16.0.10"

  config.vm.provision "shell", inline: <<-SHELL
    DBHOST=localhost
    DBPASS=1234  
    DBNAME=slidescarmonagalindojumelle

    sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASS"
    sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASS"

    apt-get update
    apt-get install -y mysql-server
    mysql -u root -p$DBPASS -e "CREATE DATABASE $DBNAME;"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Presentacions (ID_Presentacio INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, descripcio TEXT);"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Diapositives (ID_Diapositiva INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, contingut TEXT);"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Presentacions_Diapositives (ID_Presentacio INT, ID_Diapositiva INT, PRIMARY KEY (ID_Presentacio, ID_Diapositiva), FOREIGN KEY (ID_Presentacio) REFERENCES Presentacions(ID_Presentacio), FOREIGN KEY (ID_Diapositiva) REFERENCES Diapositives(ID_Diapositiva));"
  SHELL
end