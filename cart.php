<?php
session_start();
require_once 'functions.php';
require_once '_header.php';
echo createHeader();

$cartItems = getCartByUserId($_SESSION['userId']);

?>

<div class="container">
    <table class="table mt-5">
        <thead class="table-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Book</th>
            <th scope="col">Author</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total Price</th>
            <th scope="col">Actions</th>
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
                    <td>
                        <form method="post" action="edit-cart-item.php">
                            <input type='hidden' name='id' value='<?= $cartItems[$i]['id'] ?? '' ?>'>
                            <input type='hidden' name='price'
                                   value='<?= $cartItems[$i]['price'] ?? '' ?>'>
                            <input type="number" class="form-control w-50 d-inline" name="quantity"
                                   value="<?= isset($cartItems[$i]['quantity']) ? htmlentities($cartItems[$i]['quantity']) : '' ?>">
                            <button type="submit" class="border-0 bg-transparent"><img src="assets/edit-3.svg" class="outline" alt="edit icon"></button>
                        </form>
                    </td>
                    <td><?= $cartItems[$i]['total_cost'] ?></td>
                    <td>
                        <form>
                            <img src="assets/delete.svg" alt="delete icon">
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
        <?php else: ?>
            <p>Your cart is empty!</p>
        <?php endif; ?>
        </tbody>
    </table>
</div>
