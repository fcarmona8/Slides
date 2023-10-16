    apt-get update
    
    DBPASS=1234
    DBNAME=slidescarmonagalindojumelle


    sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASS"
    sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASS"

    apt-get install -y mysql-server    
    mysql -u root -p$DBPASS -e "GRANT ALL PRIVILEGES ON * . * TO 'root' IDENTIFIED BY '1234';"
    mysql -u root -p$DBPASS -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';"
    mysql -u root -p$DBPASS -e "CREATE DATABASE $DBNAME;"
    mysql -u root -p$DBPASS -e "USE $DBNAME; FLUSH PRIVILEGES;"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Presentacions (ID_Presentacio INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, descripcio TEXT);"
    mysql -u root -p$DBPASS -e "USE $DBNAME; CREATE TABLE Diapositives (ID_Diapositiva INT AUTO_INCREMENT PRIMARY KEY, titol VARCHAR(255) NOT NULL, contingut TEXT, ID_Presentacio INT, FOREIGN KEY (ID_Presentacio) REFERENCES Presentacions(ID_Presentacio));"

    sed -i 's/127.0.0.1/0.0.0.0/g'  /etc/mysql/my.cnf
    service mysql restart
