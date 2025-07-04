<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>watermelon</p>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "alvin21";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    ?>

    <form action="index.php" method="POST">
        Email: <input type="email" name="email" id="">
        <br>
        Password: <input type="password" name="password" id="">
        <br>
        <input type="submit" value="Submit">
    </form><br>


   
    <?php
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $sql = "Select * from User_creds where Email = '$email' and Password ='$pass'";
        $conn->query("use clothee");
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo 'login successfuly';
        }else{
            echo 'no';
        }
    ?>



<form action="index.php" method="POST">

<h1>sign up</h1>

<input type="email" name="s_email" id="">
<input type="password" name="s_pass" id="">
<input type="submit" value="Sign up">

</form>
    <?php
    try{
        $email = $_POST["s_email"];
        $pw = $_POST["s_pass"];

        $sql = "Insert into user_creds(user_id,email,password,authority) Values(null, '$email','$pw','User')";
        $conn->query($sql);
        echo "New record created successfully";
    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }
    ?>


</body>
</html>