<?php
//index de prova
$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

$titol = 'prova';
$descripcio = 'prova2';
$dao->setPresentacions($titol, $descripcio);
$presen = $dao->getPresentacions();


?>
<!DOCTYPE html>
<html>

<head>
    <title>Pantalla Home</title>
    <link rel="stylesheet" href="Styles.css">
</head>

<body>
    <h1>Slides</h1>
    <hr class="line">
    <div class="container">
    <table>
        <thead>
            <tr>
                <th>titol</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $presen->fetch()) : ?>
                <tr>
                    <td><?= $row['titol']; ?></td>
                </tr>
            <?php endwhile ?>   
        </tbody>
    </table>
        <a href="CrearPresentacio.php" class="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                viewBox="0 0 512 512">
                <path
                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
            </svg> Crear una nova presentació</a>
            
    </div>
    <p class="description">Este sitio web te permite crear y gestionar presentaciones de diapositivas de forma sencilla y eficiente. ¡Comienza a crear tu presentación ahora!</p>
</body>

</html>