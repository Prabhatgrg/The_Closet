<?php
require 'header.php';

global $con;


$itemIDs = [];
$itemTitles = [];
$quantities = [];
$amounts = [];

foreach ($_GET as $key => $value) {
    if (strpos($key, 'item_number') === 0) {
        $index = substr($key, strlen('item_number'));

        $itemIDs[] = $_GET['item_number' . $index];
        $itemTitles[] = $_GET['item_name' . $index];
        $quantities[] = $_GET['quantity' . $index];
        $amounts[] = $_GET['mc_gross_' . $index];
    }
}

$items = array();
$totalAmount = 0;

for ($i = 0; $i < count($itemIDs); $i++) {
    $items[] = array(
        'product_id' => $itemIDs[$i],
        'product_title' => $itemTitles[$i],
        'quantity' => $quantities[$i],
        'amount' => $amounts[$i]
    );

    $totalAmount += $amounts[$i];
}

$payerName = $_GET['first_name'] . ' ' . $_GET['last_name'];
$payerEmail = $_GET['payer_email'];
$address = $_GET['address_street'] . ', ' . $_GET['address_city'] . ', ' . $_GET['address_state'] . ', ' . $_GET['address_country_code'] . ' ' . $_GET['address_zip'];
$status = $_GET['payment_status'];
$createdAt = $_GET['payment_date'];

// Check if the data already exists in the database
$sql_check = "SELECT COUNT(*) AS num_rows FROM payments WHERE payer_name = '$payerName' AND payer_email = '$payerEmail' AND address = '$address' AND status = '$status' AND created_at = '$createdAt'";
$result_check = $con->query($sql_check);
$row_check = $result_check->fetch_assoc();
if ($row_check['num_rows'] == 0) {
    // Data does not exist, insert it into the database
    foreach ($items as $item) {
        $sql = "INSERT INTO payments (payer_name, payer_email, address, product_id, product_title, quantity, amount, status, created_at)
                VALUES ('$payerName', '$payerEmail', '$address', '{$item['product_id']}', '{$item['product_title']}', '{$item['quantity']}', '{$item['amount']}', '$status', '$createdAt')";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}
?>


<section class="section">
    <div class="container">

        <div class="text-center">
            <img src="./success.png" alt="Success">
            <h1 class="my-5"><strong>Thanks <?php echo $payerName ?> For Shopping</strong> </h1>
            <a href="index.php" class="btn btn-primary" type="submit">Shop Again</a>
            <br>
            <br>
            <br>
            <h1><strong>Your Shopping Details</strong></h1>
            <br>
            <hr>
            <br>
            <br>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM payments WHERE payer_name = '$payerName' AND payer_email = '$payerEmail' AND address = '$address' AND status = '$status' AND created_at = '$createdAt'";
                $result = $con->query($sql);

                $totalAmount = 0; // Initialize total amount outside the loop
                $i = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display each product row
                ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['product_title'] ?></td>
                            <td><?php echo $row['quantity'] ?></td>
                            <td><?php echo $row['amount'] ?></td>
                        </tr>
                    <?php
                        $totalAmount += $row['amount'];

                        $i++;
                    }
                    ?>
                    <tr class="bg-dark text-white">
                        <td colspan="3" class="text-center"><strong>Total Amount:</strong></td>
                        <td><strong><?php echo "$" . number_format($totalAmount, 2); ?></strong></td>
                    </tr>
                <?php
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>

            </tbody>
        </table>



    </div>
</section>

<?php
require 'footer.php';
