<?php 
    session_start();
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>
<style>
    .container{
        text-align: center;
    }
    .success-text{
        font-size: 50px;
    }
</style>
<body>
    <div class="main">
        <div class="container">
            <h2 class='success-text'>Hooray!!</h2>
            <p><?php echo htmlspecialchars("$firstName") . ' '; echo htmlspecialchars("$lastName"); ?>  you are registrated</p>
        </div>
    </div>
</body>
</html>