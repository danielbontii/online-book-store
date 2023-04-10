<?php
session_start();
require_once 'functions.php';
require_once '_header.php';
echo createHeader();

$cartItems = getCartByUserId($_SESSION['userId']);
$grandTotal = sumCartItemPrices($cartItems);

?>
<?php if (!empty($cartItems)): ?>
    <div class="row">
        <div class="col-8">
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
                                <button type="submit" class="border-0 bg-transparent">
                                    <img src="assets/edit-3.svg" class="outline" alt="edit icon">
                                </button>
                            </form>
                        </td>
                        <td><?= $cartItems[$i]['total_cost'] ?></td>
                        <td>
                            <form method="post" action="delete-cart-item.php">
                                <input type='hidden' name='id' value='<?= $cartItems[$i]['id'] ?? '' ?>'>
                                <button type="submit" class="border-0 bg-transparent">
                                    <img src="assets/delete.svg" alt="delete icon">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="h3">Grand Total</td>
                    <td colspan="2"><?= $grandTotal ?></td>
                </tr>
                </tfoot>

            </table>
        </div>
        <div class="col">
            <form class="mt-5" method="post" action="checkout.php">
                <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?? '' ?>">
                <div class='form-group my-3'>
                    <label for='card'>Credit Card Number</label>
                    <input type='text' name='title' class='form-control' id='card' pattern="^4[0-9]{12}(?:[0-9]{3})?$"
                           placeholder='Eg: 4155279860457' required autofocus>
                </div>
                <div class='form-group my-3'>
                    <label for='address'>Shipping address</label>
                    <input type='text' name='address' class='form-control' id='address'
                           placeholder='Enter shipping address' required autofocus>
                </div>
                <div class='form-group my-3'>
                    <label for='phone'>Phone Number</label>
                    <input type='text' name='phone' class='form-control' id='address' pattern="[0-9]{10}"
                           placeholder='Eg: 0553936239' required autofocus>
                </div>
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
        </div>
    </div>
<?php else: ?>
    <p>Your cart is empty!</p>
<?php endif; ?>
