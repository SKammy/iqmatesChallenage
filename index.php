<?php

    //  CONNECT TO DB   //  
    include('config/db_connect.php');


    //  SET CUSTOM ERROR ARRAY MESSAGE : ASSOCIATE ARRAY   //
    $errors = array('firstName'=>'','lastName'=>'','email'=>'','cellNumber'=>'', 'password'=>'');
    $firstName = $lastName = $email = $cellNumber = $password = '';

    // RUN WHEN SUBMIT BUTTON IS CLICKED    //
    if(isset($_POST['submit'])){

        //  FORM VALIDATION //

        # check firstName input field
        if(empty($_POST['firstName'])){
            $errors['firstName'] = 'Your first name is required';
        }else{
            $firstName = $_POST['firstName'];
            # check for special characters. Regular expression method
            if(!preg_match('/^[a-zA-Z\s]+$/',$firstName)){
                $errors['firstName'] = 'Only letters and spaces <br/>';
            }
        }

        # check lastName input field
        if(empty($_POST['lastName'])){
            $errors['lastName'] = 'Your  last name is required';
        }else{
            $lastName = $_POST['lastName'];
            # check for special characters. Regular expression method
            if(!preg_match('/^[a-zA-Z\s]+$/',$lastName)){
                $errors['lastName'] = 'Only letters and spaces <br/>';
            }
        }

        # check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br/>';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be valid email address';
            }
        }

        # check cell number
        if(empty($_POST['number'])){
            $errors['cellNumber'] = 'Cell Number is required <br/>';
        }else{
            $cellNumber = $_POST['number'];
        }

        # check password
        if(empty($_POST['password'])){
            $errors['password'] = 'A password is required <br/>';
        }else{
            $password = $_POST['password'];
        }


         # check if we have errors. If we dont have errors then the form is true
         if(array_filter($errors)){
            null;
         }else{
             session_start();
             $_SESSION['firstName'] = $_POST['firstName'];
             $_SESSION['lastName'] = $_POST['lastName'];

             //    SEND INFOR TO DB    //

             # protecting data from sql injects
             $firstName = mysqli_real_escape_string($connect, $_POST['firstName']);
             $lastName = mysqli_real_escape_string($connect, $_POST['lastName']);
             $email = mysqli_real_escape_string($connect, $_POST['email']);
             $cellNumber = mysqli_real_escape_string($connect, $_POST['number']);
             $password = mysqli_real_escape_string($connect, $_POST['password']);

            //  CREATE QUERY   //
            $sql = "INSERT INTO users(firstName,lastName,email,cellNumber,userPassword) VALUES('$firstName','$lastName','$email','$cellNumber', '$password')";
            
            //  SAVE DATA TO DB AND DIRECT USER TO SUCCESS PAGE //
            if(mysqli_query($connect, $sql)){
                header('Location: success.php');
            }else{
                echo 'query error: ' . mysqli_error($connect);
            }

            
         }

    }

?>

<!--HTML-->
<!DOCTYPE html>
<html lang="en">
<!--header section -->
<?php include("templates/header.php"); ?>
<style>
    .red-text {
    color: red;
}
</style>

<body>
    <div class="main" style='padding: 40px 0;'>
         <!-- Sign up form -->
         <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Registration</h2>
                        <form method="POST" class="register-form" id="register-form" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="firstName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="firstName" id="firstName" placeholder="First Name" value="<?php echo htmlspecialchars($firstName) ?>"/>
                                <span class='red-text'>
                                    <?php echo $errors['firstName'] ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="lastName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName) ?>"/>
                                <span class='red-text'>
                                    <?php echo $errors['lastName'] ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email Address" value="<?php echo htmlspecialchars($email) ?>"/>
                                <span class='red-text'>
                                    <?php echo $errors['email'] ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="number"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="number" id="number" placeholder="Cell Number" value="<?php echo htmlspecialchars($cellNumber) ?>"/>
                                <span class='red-text'>
                                    <?php echo $errors['cellNumber'] ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($password) ?>"/>
                                <span class='red-text'>
                                    <?php echo $errors['password'] ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>
</html>