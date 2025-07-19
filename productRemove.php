<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeProduct'])) {
    $removedProductKey = $_POST['removeProduct'];
    
    if (isset($_SESSION['shopping_cart'][$removedProductKey])) {
        unset($_SESSION['shopping_cart'][$removedProductKey]);
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Product not found in the cart']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
