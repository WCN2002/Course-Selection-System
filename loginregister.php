<!DOCTYPE html>
<!--Format from https://www.codinglabweb.com/2023/01/login-registration-form-html-css.html -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <section class="wrapper">
    <div class="form signup">
        <?php
        if (isset($_POST["register"])){
          $username = $_POST["username"];
          $firstname = $_POST["first_name"];
          $lastname = $_POST["last_name"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $role = $_POST["role"];

          $errors = array();

          if (empty($username) OR empty($firstname) OR empty($lastname) OR empty($email) OR empty($password) OR empty($role)) {
            array_push($errors, "Fill all the fields");
          }

          require_once "database.php";
          $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
          $stmt = mysqli_stmt_init($conn);
          $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
          mysqli_stmt_bind_param($stmt,"ss", $email, $username);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          $rowCount = mysqli_num_rows($result);
          if ($rowCount > 0){
            while($row = mysqli_fetch_assoc($result)) {
            if($row["email"] == $email){
              array_push($errors, "Email already exists!");
              }
            if($row["username"] == $username){
              array_push($errors, "Username already exists!");
              }
            }
          }
          if (empty($errors)){
            require_once "database.php";
            $sql = "INSERT INTO users (username, firstName, lastName, email, password, isAdmin) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt){
              // Convert role value to boolean
              $isAdmin = ($role == "admin") ? true : false;
              mysqli_stmt_bind_param($stmt,"sssssi", $username, $firstname, $lastname, $email, $password, $isAdmin); // Use "i" for integer data type, as BOOLEAN is stored as TINYINT(1) in MySQL
              mysqli_stmt_execute($stmt);
              echo "<div class='alert alert-success'>You registered successfully";
            }
            else{
              die("Something went wrong");
            }
          } else {
            echo "<div class='alert alert-danger'>".implode("<br>", $errors)."</div>";
          }
        }
        ?>
        <header>Register</header>
        <form action="loginregister.php" method="post">
          <input type="text" name="username" placeholder="Username" required />
          <input type="text" name="first_name" placeholder="firstname" required />
          <input type="text" name="last_name" placeholder="lastname" required />
          <input type="text" name="email" placeholder="Email address" required />
          <input type="password" name="password" placeholder="Password" required />
          <div class="checkbox1">
            <input type="radio" id="adminCheck" name="role" value="admin" />
            <label for="adminCheck">Admin</label>
          </div>
          <div class="checkbox2">
            <input type="radio" id="userCheck" name="role" value="user" />
            <label for="userCheck">User</label>
          </div>
          <input type="submit" value="Register" name="register"/>
          <p>Already have an account? <a href="index.php">Login</a></p>
        </form>
      </div>


      
    </section>
  </body>
</html>
