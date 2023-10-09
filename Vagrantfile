Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    apt-get install -y mysql-server
    mysql -u root -p -e "CREATE DATABASE slidescarmonagalindojumelle;"
    mysql -u root -p -e "USE slidescarmonagalindojumelle;"
    mysql -u root -p -e "CREATE TABLE Presentacions (ID_Presentacio INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, descripcio TEXT);"
    mysql -u root -p -e "CREATE TABLE Diapositives (ID_Diapositiva INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, contingut TEXT);"
    mysql -u root -p -e "CREATE TABLE Presentacions_Diapositives (ID_Presentacio INT, ID_Diapositiva INT, PRIMARY KEY (ID_Presentacio, ID_Diapositiva), FOREIGN KEY (ID_Presentacio) REFERENCES Presentacions(ID_Presentacio), FOREIGN KEY (ID_Diapositiva) REFERENCES Diapositives(ID_Diapositiva));"
  SHELL
end
