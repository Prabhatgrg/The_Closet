<?php
require 'header.php';
?>

<section class="section">
    <div class="container">

        <div class="text-center">
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
                $sql = "SELECT * FROM payments WHERE status = 'Completed'";
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

        <?php clear_cart(); ?>

    </div>
</section>