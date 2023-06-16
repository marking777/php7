<?php
session_start();
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
$query = "SELECT * FROM producten";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll();


if (isset($_POST['submit'])) {
    if (!isset($_SESSION['selected_ids'])) {
        $_SESSION['selected_ids'] = array();
    }

    $selected_id = $_POST['selected_id'];

    if (!in_array($selected_id, $_SESSION['selected_ids'])) {
        $_SESSION['selected_ids'][] = $selected_id;
    }
}

if (isset($_SESSION['selected_ids']) && !empty($_SESSION['selected_ids'])) {
    echo "Geselecteerde ID's: ";
    echo implode(', ', $_SESSION['selected_ids']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asalam alaykom</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Omschrijving</th>
        </tr>
        <?php foreach ($data as $row): ?>
        <tr>
        <td><?php echo isset($row['product_code']) ? $row['product_code'] : ''; ?></td>
            <td><?php echo isset($row['product_naam']) ? $row['product_naam'] : ''; ?></td>
            <td><?php echo isset($row['prijs_per_stuk']) ? $row['prijs_per_stuk'] : ''; ?></td>
            <td><?php echo isset($row['omschrijving']) ? $row['omschrijving'] : ''; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
