<?php
// Inițializarea sesiunii
session_start();
 
// Verifică dacă utilizatorul este autentificat, dacă nu, va fi redirecționat la pagina de autentificare
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Service21Mecanic.php");
    exit;
}
 
// Includerea fișierului de configurare
require_once "config.php";
 
// Definirea varaibilelor pentru cazurile de câmpuri goale
$username = $password = "";
$username_err = $password_err = "";
 
// Procesarea datelor din formular la trimitere
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Verificarea câmpului de utilizator necompletat
    if(empty(trim($_POST["username"]))){
        $username_err = "Utilizator neintrodus";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verificarea câmpului de parolă necompletată
    if(empty(trim($_POST["password"]))){
        $password_err = "Parolă neintrodusă";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: Service21Mecanic.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Parolă nevalidă";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Utilizator nevalid";
                }
            } else{
                echo "Vă rugăm încercați mai târziu, ceva nu funcționează!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="ro">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta charset="UTF-8">

<style type="text/css">
        .wrapper{ 
        display: block;
        margin: 0 auto;
        width: 25%; 
        padding: 20px; 
        background-color: whitesmoke;
        opacity: 0.95;
        text-align: center;
        border-radius: 5px;
        font-size: 1vw;
        

        }

        html {
        background-image: url("greybg.jpeg");
        font-family: "Helvetica", cursive, sans-serif;
        }

        .butonlogin {
        background-color: whitesmoke; color: black;
        padding: 10px;
        text-align: center;
        font-size: 18px;
        border-radius: 5px;
        }

        span {
        background-color: whitesmoke;
        opacity: 0.9;
        border-radius: 5px;
        padding: 2px;
    }

    h1 {
        font-size: 2vw;
        text-align: center;
    }

    input{
        background-color: whitesmoke; color: black;
        padding: 5px;
        text-align: center;
        font-size: 20px;
        border-radius: 5px;
        opacity: 1;
    }
    
    }
    </style>

<title>Service 21 - Autentificare Mecanic</title>

    <h1>
        <span>Service 21</span>
        <form action="ServiceHTML.html">
        <button class="butonlogin" type="submit">Mod Client</button>
        </form>
    </h1>

<head>
    <title>Login</title>
</head>
    <div class="wrapper">
        <h2>Autentificare Mecanic</h2>
        <p>Introduceți vă rog credențialele</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Utilizator:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div><br>   
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Parola:</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group"><br>
                <input type="submit" class="butonlogin" value="Autentificare">
            </div><br>
        </form>
    </div> 
</html>