<?php
/**
 * Created by PhpStorm.
 * User: huyhung
 * Date: 8/4/16
 * Time: 2:20 PM
 */
try {
    $conn = new PDO("mysql:host=localhost;dbname=mvc-project", 'root', '') or die(" chet nhe");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$page = 1;
$items_per_page = 12;
$range = ($page - 1) * $items_per_page;
try {
    $stmt = $conn->prepare("SELECT * FROM PRODUCTS LIMIT ?,?");
    $stmt->bindValue(1, $page, PDO::PARAM_INT);
    $stmt->bindValue(2, $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
} catch (PDOException $e) {
    die(json_encode($e->getMessage()));
}
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>