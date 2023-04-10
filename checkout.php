<?php

session_start();
require_once 'functions.php';
require_once '_header.php';
echo createHeader();

if (!empty($_POST)) {
    $cartItems = getCartByUserId($_SESSION['userId']);
    $grandTotal = sumCartItemPrices($cartItems);

    $address = $_POST['address'];

    confirmCartItemOrders($cartItems);

}
?>

<div class="container">
    <h1>Checkout success!</h1>
    <hr/>
    <br>
    <h2>Summary</h2>
    <table class="table mt-5">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Book</th>
            <th scope="col">Author</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($cartItems)): ?>
        <?php for ($i = 0; $i < count($cartItems); $i++): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $cartItems[$i]['title'] ?></td>
                <td><?= $cartItems[$i]['author'] ?></td>
                <td><?= $cartItems[$i]['price'] ?></td>
                <td><?= $cartItems[$i]['quantity'] ?></td>
                <td><?= $cartItems[$i]['total_cost'] ?></td>
            </tr>
        <?php endfor; ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="h4">Grand Total</td>
            <td colspan="2"><?= $grandTotal ?? '' ?></td>
        </tr>
        </tfoot>

    </table>
<p> Books will be delivered to your address at <?= $address ?? '' ?> within three working days!</p>
</div>
<?php endif; ?>
