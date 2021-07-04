<?php
require_once "pdo.php";

#session_destroy();
session_start();
isset($_SESSION['message']) ? $_SESSION['message'] = "" : $_SESSION['message'] = "";
$item_check = false;
$qtty_check = false;
$unit_price_check = false;

if( isset($_POST['address']) && isset($_POST['tel_num']) && isset($_POST['email'] ) ) {



  if( strlen($_POST['address']) < 1 && strlen($_POST['tel_num']) < 1 && strlen($_POST['email']) < 1)
    $_SESSION['message'] = "Fill in the blanks to update";
  else {
    $sql = "SELECT address, tel_num, email FROM company where company_ID = :id ";
    $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $_GET['company_id'],
          ));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['address'] =  $row['address'];
    $_SESSION['tel_num'] = $row['tel_num'];
    $_SESSION['email'] = $row['email'];
    }

    if (strlen($_POST['address']) > 0)
    $_SESSION['address'] = htmlentities($_POST['address']);
    if (strlen($_POST['tel_num']) > 0)
    $_SESSION['tel_num']  = htmlentities($_POST['tel_num']);
    if (strlen($_POST['email']) > 0)
    $_SESSION['email'] = htmlentities($_POST['email']);

   #  echo nl2br($_SESSION['item_name']."\n" );
  #  echo nl2br($_SESSION['qtty']."\n");
  #  echo nl2br($_SESSION['unit_price']."\n");

     if ( is_numeric($_SESSION['tel_num']) )  {

       if( strrpos($_SESSION['email'],'@') === false ) {
      $_SESSION['message'] = "Email must contain '@' ";
       }
       else {
      $sql= "Update company set address = :ad, tel_num = :tn,
           email = :em where company_ID = :id ";
      $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':ad' => $_SESSION['address'],
              ':tn' => $_SESSION['tel_num'],
              ':em' => $_SESSION['email'],
              ':id' => $_GET['company_id'],
            ));
            $_SESSION['message'] = "Company updated";
          }
        }

        else {
          $_SESSION['message'] = "Contact number must be numeric and consist of numbers only";
        }


  }
#  header("Location: insert.php");
#     return;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Update Company</title>
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
<h1 class="thickblack"> Update Company </h1><br><br><br>

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
isset($_POST['address']) ? '' : $_POST['address'] = "";
isset($_POST['tel_num']) ? '' : $_POST['tel_num'] = "";
isset($_POST['email']) ? '' : $_POST['email'] = "";


$sql = "SELECT address, tel_num, email FROM company where company_ID = :id ";
$stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $_GET['company_id'],
      ));

echo '<table id="table">'."\n";
echo "<tr><th>";
echo  "Address</th><th>";
echo  "Contact Number</th><th>";
echo  "Email</th>";
echo("</tr>\n");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo($row['address']);
    echo("</td><td>");
    echo($row['tel_num']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td></tr>\n");
}
echo "</table>\n";

?>

<br><br>
<div>
  <form class="form-horizontal " method="post" >

    <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2 "  for="address">New Address:</label>
    <textarea  class="col-sm-8  form-control"  name="address" rows="4" cols="50"></textarea>
  </div>
</div>


  <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2"  for="email">New Email:</label>
    <input type="text" class="col-sm-8 form-control"  name="email">
  </div>
</div>

  <div class="form-group">
    <div class="form-row" >
    <label class="control-label col-sm-2"  for="tel_num">New Contact Number:</label>
    <input type="text" class="col-sm-2 form-control"  name="tel_num">
  </div>
  </div>
  <br><br>
  <div class="form-group">

    <div class="col-sm-offset-2 col-sm-10">
      <a id="a" href="company.php" ><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
