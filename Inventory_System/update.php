<?php
require_once "pdo.php";

#session_destroy();
session_start();
isset($_SESSION['message']) ? $_SESSION['message'] = "" : $_SESSION['message'] = "";
$item_check = false;
$qtty_check = false;
$unit_price_check = false;

if( isset($_POST['unit_price']) && isset($_POST['item_name']) && isset($_POST['qtty'] ) ) {



  if( strlen($_POST['unit_price']) < 1 && strlen($_POST['item_name']) < 1 && strlen($_POST['qtty']) < 1)
    $_SESSION['message'] = "Fill in the blanks to update";
  else {
    $sql = "SELECT Item_name, Quantity, price FROM inventory where item_ID = :id ";
    $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $_GET['item_id'],
          ));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['item_name'] =  $row['Item_name'];
    $_SESSION['qtty'] = $row['Quantity'];
    $_SESSION['unit_price'] = $row['price'];
    }

    if (strlen($_POST['unit_price']) > 0)
    $_SESSION['unit_price'] = htmlentities($_POST['unit_price']);
    if (strlen($_POST['item_name']) > 0)
    $_SESSION['item_name']  = htmlentities($_POST['item_name']);
    if (strlen($_POST['qtty']) > 0)
    $_SESSION['qtty'] = htmlentities($_POST['qtty']);

   #  echo nl2br($_SESSION['item_name']."\n" );
  #  echo nl2br($_SESSION['qtty']."\n");
  #  echo nl2br($_SESSION['unit_price']."\n");

     if ( is_numeric($_SESSION['qtty']) && is_numeric($_SESSION['unit_price']) ) {
      $sql= "Update inventory set item_name = :it, quantity = :qt,
           price = :up where item_ID = :id ";
      $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':it' => $_SESSION['item_name'],
              ':qt' => $_SESSION['qtty'],
              ':up' => $_SESSION['unit_price'],
              ':id' => $_GET['item_id'],
            ));
            $_SESSION['message'] = "Stock updated";
        }
        else {
          $_SESSION['message'] = "Quantity/Unit Price must be numeric";
        }


  }
#  header("Location: insert.php");
#     return;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Update Stock</title>
  <meta charset='UTF-8' />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  body {
    background-color: black !important;
  }
  </style>
</head>
<body>

<div class="container-fluid pt-5 pb-5 pl-5 bg-white align-items-center justify-content-center rounded " id="pad">
<h1 class="thickblack"> Update Inventory </h1><br><br><br>

<?php
if (strlen($_SESSION['message']) > 0 ) {
if (strpos($_SESSION['message'],'updated') === false ) {
 echo ("<p class=\" message \" style=\"color:red;\">".$_SESSION['message']."</p>");
}
else {
 echo ("<p class=\" message \" style=\"color:green;\">".$_SESSION['message']."</p>");
}
}
?>
<br>
<?php
isset($_POST['item_name']) ? '' : $_POST['item_name'] = "";
isset($_POST['qtty']) ? '' : $_POST['qtty'] = "";
isset($_POST['unit_price']) ? '' : $_POST['unit_price'] = "";


$sql = "SELECT Item_name, Quantity, price FROM inventory where item_ID = :id ";
$stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $_GET['item_id'],
      ));

echo '<table id="table">'."\n";
echo "<tr><th>";
echo  "Item Name</th><th>";
echo  "Quantity</th><th>";
echo  "Unit Price (RM)</th>";
echo("</tr>\n");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo($row['Item_name']);
    echo("</td><td>");
    echo($row['Quantity']);
    echo("</td><td>");
    echo($row['price']);
    echo("</td></tr>\n");
}
echo "</table>\n";

?>

<br><br>
<div>
  <form class="form-horizontal " method="post" >

    <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2"  for="item_name">New Item Name:</label>
    <input type="text" class="col-sm-8 form-control "  name="item_name">
  </div>
</div>


  <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2"  for="qtty">New Quantity:</label>
    <input type="text" class="col-sm-2 form-control"  name="qtty">
  </div>
</div>

  <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2"  for="unit_price">New Unit Price (RM):</label>
    <input type="text" class="col-sm-2 form-control"  name="unit_price">
  </div>
  </div>
  <br><br>
  <div class="form-group">

    <div class="col-sm-offset-2 col-sm-10">
      <a id="a" href="inventory.php" ><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
    </svg> </a>&nbsp;&nbsp;&nbsp;
      <a  id="b" href="" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
      </svg></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" class=" button btn btn-outline-secondary btn-lg"  value="Update"/>
    </div>
  </div>
  </form>

</div>


</div>

<!-- <h1>HEyiufhuierfhfhe</h1> -->
<br><br><br>
<!-- <h1>iuwebuwfifnif</h1> -->
</div>



</body>

</html>
