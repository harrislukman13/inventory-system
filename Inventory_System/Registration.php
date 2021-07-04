<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Registration</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                  <h3>MARF'S</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Database System</p>
                    <li>
                        <a href="inventory.php">Inventory</a>
                    </li>
                    <li>
                        <a href="Registration.php">Register</a>
                    </li>
                    <li>
                        <a href="company.php">Supplier Contact</a>
                    </li>
                    <li>
                        <a href="invoice.php">Invoice</a>
                    </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="logout.php">Logout</a>
                </li>

            </ul>
        </nav>

        <!-- Page Content Holder -->
        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>


                </div>
            </nav>


            <?php
            require_once "pdo.php";
            session_start();
            ?>
            <?php
            if ( isset($_SESSION['error']) ) {
                echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                unset($_SESSION['error']);
            }
            if ( isset($_SESSION['success']) ) {
                echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }

        

            if ( isset($_POST['item_id']) && isset($_POST['item_name'])
                 && isset($_POST['quantity']) && isset($_POST['price'])){

                $sql = "INSERT INTO inventory(item_id,item_name,quantity,price,company_id) VALUES (:item_id, :item_name, :quantity,:price,:company_id)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':item_id' => $_POST['item_id'],
                    ':item_name' => $_POST['item_name'],
                    ':quantity' => $_POST['quantity'],
                    ':price' => $_POST['price'],
                    ':company_id' => $_POST['company_id']));
                    echo('<center>');
                $_SESSION['success'] = 'Registration Success';
                echo('</center>');
                header( 'Location: Registration.php' ) ;

                return;
            }

            // Flash pattern
            if ( isset($_SESSION['error']) ) {
                echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                unset($_SESSION['error']);
            }
            ?>

            <div>
            <form method="post">

              <center><h1>Register</h1></center>

              <fieldset>
                <label for="item">Item ID</label>
                <input type="text" name="item_id">

                <label for="name">Name</label>
                <input type="text" name="item_name">

                <label for="quantity">Quantity</label>
                <input type="double" name="quantity">

                <label for="price">Price</label>
                <input type="double" name="price">

                <label for="supplier">Supplier</label>
                <input type="text" name="company_id">
              </fieldset>
              <button type="submit">Register</button>
            </form>


            </div>
    </div>
        </div>
    </div>





    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });
            });
        </script>


</body>

</html>
