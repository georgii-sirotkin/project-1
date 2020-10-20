<?php
if (!$book) {
?>
    <h4>You haven't selected a book</h4>
<?php
} else {
    ?>
    <div class="col-md-6 offset-3 mt-5">
        <h4>Selected book: <?php echo $book['name']; ?></h4>
        <hr>
        <form method="POST">
            <h6 class="mb-2">Billing address</h6>
            <input type="hidden" name="bookId" value="<?php echo $book['id'];?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="" value="<?php echo $_POST['firstName'] ?? '' ?>">
                    <?php
                        echo isset($errors['firstName'])
                            ? "<small class='text-danger'>{$errors['firstName']}</small>"
                            : '';
                    ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="<?php echo $_POST['lastName'] ?? '' ?>">
                    <?php
                        echo isset($errors['lastName'])
                            ? "<small class='text-danger'>{$errors['lastName']}</small>"
                            : '';
                    ?>
                </div>
            </div>

            <h6 class="mt-3 mb-2">Payment</h6>

            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input
                        id="credit"
                        name="paymentMethod"
                        type="radio"
                        class="custom-control-input"
                        value="credit"
                        <?php echo isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === 'credit' ? 'checked' : '';?>
                    >
                    <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input
                        id="debit"
                        name="paymentMethod"
                        type="radio"
                        value="debit"
                        class="custom-control-input"
                        <?php echo isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === 'debit' ? 'checked' : '';?>
                    >
                    <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <?php
                    echo isset($errors['paymentMethod'])
                        ? "<small class='text-danger'>{$errors['paymentMethod']}</small>"
                        : '';
                ?>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" name="cardHolderName" value="<?php echo $_POST['cardHolderName'] ?? '' ?>">
                    <?php
                        echo isset($errors['cardHolderName'])
                            ? "<small class='text-danger'>{$errors['cardHolderName']}</small>"
                            : '';
                    ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input name="cardNumber" value="<?php echo $_POST['cardNumber'] ?? '' ?>" type="text" class="form-control" id="cc-number" placeholder="">
                    <?php
                        echo isset($errors['cardNumber'])
                            ? "<small class='text-danger'>{$errors['cardNumber']}</small>"
                            : '';
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input name="expiration" value="<?php echo $_POST['expiration'] ?? '' ?>" type="text" class="form-control" id="cc-expiration" placeholder="" >
                    <?php
                        echo isset($errors['expiration'])
                            ? "<small class='text-danger'>{$errors['expiration']}</small>"
                            : '';
                    ?>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input name="cvv" value="<?php echo $_POST['cvv'] ?? '' ?>" type="text" class="form-control" id="cc-cvv" placeholder="">
                    <?php
                        echo isset($errors['cvv'])
                            ? "<small class='text-danger'>{$errors['cvv']}</small>"
                            : '';
                    ?>
                </div>
            </div>
            <button type="submit" class="mt-2 btn btn-primary">Place order</button>
        </form>
    </div>
<?php
}