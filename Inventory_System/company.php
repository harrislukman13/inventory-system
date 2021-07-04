<?php
require_once "pdo.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style5.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
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

            </ul>
        </nav>


        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </nav>
<?php
echo '<table class="table table-bordered">'."\n";
echo '<thead class="table-dark">';
echo "<tr><th>";
echo  "Company ID</th><th>";
echo  "Company Name</th><th>";
echo  "Address</th><th>";
echo  "Telephone Number</th><th>";
echo  "Email</th><th>";
echo "</th>";
echo  " </th>";
echo("</tr>\n");
echo  ('</thead>');
$stmt = $pdo->query("SELECT company_id,company_name, address, tel_num, email  FROM company");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
echo '<tbody>';
echo "<tr><td>";
echo(htmlentities($row['company_id']));
echo("</td><td>");
echo(htmlentities($row['company_name']));
echo("</td><td>");
echo(htmlentities($row['address']));
echo("</td><td>");
echo(htmlentities($row['tel_num']));
echo("</td><td>");
echo(htmlentities($row['email']));
echo("</td><td>");
echo('<a href="updateCompany.php?company_id='.$row['company_id'].'" class="btn btn-secondary">Update</a>');
echo('<a href="Deletecompany.php?company_id='. $row['company_id'].'" class="btn btn-secondary">Delete</a>');
echo("</td></tr>\n");
echo("</td></tr>\n");
echo '</tbody>';
}
echo '</table>';
?><a href="Registercompany.php" class="btn btn-secondary">Register new Supplier</a>

</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
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
