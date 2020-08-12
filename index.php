<?php
session_start(); //allows use of session variables

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["fname"])) {
     $firstNameErr = "First name is required";
   } else {
     $first_name = test_input($_POST["fname"]);
     if (!preg_match("/^[a-zA-Z ]*$/", $first_name)){
         $firstNameErr = "Only letters and white space allowed";
     }
   }

   if (empty($_POST["sname"])) {
    $sNameErr = "Second name is required";
  } else {
    $sName = test_input($_POST["sname"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $sName)){
        $sNameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        {
            $emailErr = "<strong>$email</strong> is not a valid email format";
        }
  }
  if (empty($_POST["dob"])) {
    $dobErr = "Date of birth is required";
  } else {
    $dob = test_input($_POST["dob"]);
  }
   if ($_POST["color"]== '#000000') {
    $colorErr = "Color is required";
  } else {
    $color = test_input($_POST["color"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  }  else {
    $gender = test_input($_POST["gender"]);
  }
  if (empty($_POST["department"])) {
    $departmentErr = "Department name is required";
  } else {
    $department = test_input($_POST["department"]);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "Invalid password format, passwords must have, at least an uppercase, a lowercase, a digit, a special character and longer than 15 characters";
  } else {
    $password = test_input($_POST["password"]);
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})$/", $password)){
        $passwordErr = "<ul >
        <li>It must be at least 15 character</li>
        <li>It must have at least one uppercase</li>
        <li>It must have at least one lowercase</li>
        <li>It must have at least one digit (number)</li>
        <li>It must have at least one special character like (`!?$%^&*() _ -+={ [ ]} : ; @ ' ' ~ # | \ < , > . ? /) </li>
        </ul> ";



       
    }else if(!preg_match("^(?=.*[A-Z]+)$", $password)){
        $passwordErr = "The password does not have uppercase yet";
    }else if(!preg_match("^(?=.*[!@#$&*]+)$", $password)){
        $passwordErr = "The password does not have special characters yet";
    }
}
  
   if(isset($first_name) && isset($sName) && isset($email) && isset($dob) && isset($color) && isset($gender) && isset($department) && isset($password))
   {
     $_SESSION['fname'] = $first_name;
     $_SESSION['sname'] = $sName;
     $_SESSION['email'] = $email;
     $_SESSION['dob'] = $dob;
     $_SESSION['color'] = $color;
     $_SESSION['gender'] = $gender;
     $_SESSION['department'] = $department;
     $_SESSION['password'] = $password;

     header("Location: test.php"  );
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Form</title>
    <style>
       body {
    background-color:rgb(226, 43, 186);
    
}
form{
    margin-top: 50px;
    margin-left: 100px;
    margin-bottom: 100px;
}

h3{
    font-size: 30px;
    text-align: center;
    margin-left: 50px;
    margin-bottom: -50px;
}

label{
    font-size: 20px;
}

input{
    font-size: 20px;
    border-radius: 10px 10px 10px;
    border: red;
    padding: 10px;
    text-align: center;
}
select{
    font-size: 20px;
    border-radius: 10px 10px 10px; 
    border: red;
    padding: 10px;
}
#btn {
    font-size: 20px;
    border-radius: 10px 10px 10px; 
    background :green;
    padding: 10px;
    align-self: center;
}
input [type=radio]{
    font-size: 20px;    
}


    </style>
    
</head>
<body>
<div>
<h3>Sign Up</h3>
<br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <fieldset>
            
                <label for="Name">First Name:</label>
                <input class="field" type="text" name="fname" placeholder="First name" >
                <?php if(isset($firstNameErr)) print ('<span  style="color:red;">* ' . $firstNameErr . '</span>'); ?>
             <br>
             <br>
            
                <label for="Name">Second Name:</label>
                <input class="field" type="text" name="sname" placeholder="Second name" > <?php if(isset($sNameErr)) print ('<span style="color:red;">* ' . $sNameErr . '</span>'); ?>
             <br>
             <br>
            
                <label class="field" for="Email">Email address:</label> 
                <input type="type" name="email" placeholder="Email " ><?php if(isset($emailErr)) print ('<span style="color:red;">* ' . $emailErr . '</span>'); ?>
            <br>
            <br>
            
                <label class="field" for="date"> Date of birth:</label>
                <input type="date" name="dob" placeholder="Date of birth"><?php if(isset($dobErr)) print ('<span style="color:red;">* ' . $dobErr . '</span>'); ?>
           <br>
           <br>
            

                <label for="Name">Favorite color:</label>
                <input class="field" type="color" name="color" > <?php if(isset($colorErr)) print ('<span style="color:red;">* ' . $colorErr . '</span>'); ?> 
            <br>
            <br>
            
            
                Gender:<input type="checkbox" name="gender" value="Male">
                <label for="male">Male</label> 
                <input type="checkbox"  name="gender" value="Female">
                <label for="female">Female</label>
                <?php if(isset($genderErr)) print ('<span style="color:red;">* ' . $genderErr . '</span>'); ?>
            <br>
            <br>
            
                <label for="department" >Department:</label>
                <select id = "myList" name="department">
                <option value = "">Select ...</option>
                    <option value = "IT">IT</option>
                    <option value = "HR">HR</option>
                    <option value = "Admin">Stuff</option>
                    <option value = "Customer relation">Customer relation</option>
             </select>
             <?php if(isset($departmentErr)) print ('<span style="color:red;">* ' . $departmentErr . '</span>'); ?>
               <br>
               <br>
            Password: <input type="password" name="password" id=""> <br> <br>
            <?php if(isset($passwordErr)) print ('<span style="color:red;">* ' . $passwordErr . '</span>'); ?>
            <br><br>
                <input type="submit" id="btn" name="btn"> 
            </p> 
        </fieldset>      
    </form>
    </div>


    
</body>
</html>

