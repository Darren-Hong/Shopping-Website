
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart1</title>
</head>
<body>
    <div class="container">
        <section class="products">
            <table>
                <thead>
                    <th>No</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    include('config.php');

                    // Start the session
                    session_start();
                    
                    ?>


                    <tr>
                        <td>1</td>
                        <td>Image</td>
                        <td>Shirt</td>
                        <td>RM59.50</td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>