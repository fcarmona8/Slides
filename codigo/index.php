<?php
//index de prova
$config = require_once 'config.php';
require_once 'Connection.php';
require_once 'DAO.php';

$dao = new DAO(Connection::getConnection($config['db']));

$titulo = 'sdfs';
$descripcion = 'descripcion';
$dao->setPresentacions($titulo, $descripcion);
$presen = $dao->getPresentacions();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
</body>
</html>