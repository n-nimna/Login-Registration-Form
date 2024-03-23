<?php
    session_start();
    if(isset($_SESSION["user"])) {
       header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">

    <?php
       
       if(isset($_POST["login"])) {
        $email    = $_POST["email"];
        $password = $_POST["pass"];
        require_once "database.php";

        $sql     = "SELECT * FROM users WHERE email = '$email'";
        $results = mysqli_query($conn, $sql);
        $user    = mysqli_fetch_array($results, MYSQLI_ASSOC);

        if($user){
            if(password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: index.php");
                die();
            }else{
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>Email does not match</div>";
        }
       }

    ?>

         <form action="login.php" method="post">
            <h1><b><u>Login Form</u></b></h1> <br>
            <div class="form-group">
            <input type="email" placeholder="Enter Email" name="email" class="form-control">
            </div>

            <div class="form-group">
            <input type="password" placeholder="Enter Password" name="pass" class="form-control">
            </div>

            <div class="form-btn">
                <input type="submit"  class="btn btn-warning" value="Login"  name="login">
           </div>

         </form>
         <div><p>Not registered yet  <a href="registation.php">Register Here</a></p></div>

    </div>
</body>
</html>