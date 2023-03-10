<?php
session_start();
// Verifica se l'utente è già autenticato
if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true){
    header('Location: SecFile.php');
    exit();
}

// Verifica se è stato inviato il form
if(isset($_POST['password']) && isset($_POST['g-recaptcha-response'])){
    // Verifica la validità del recaptcha
    $captcha_secret_key = "6LcNx8skAAAAAO-4zWzDRbnTv_PbAd79fc2Dn3uW";
    $captcha_response = $_POST['g-recaptcha-response'];
    $captcha_verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$captcha_secret_key."&response=".$captcha_response;
    $captcha_verify_response = file_get_contents($captcha_verify_url);
    $captcha_verify_result = json_decode($captcha_verify_response, true);

    if($captcha_verify_result['success'] == true){
        // Verifica la password
        $password = $_POST['password'];
        $correct_password = "1954"; 
        if($password == $correct_password){
            // Autenticazione corretta
            $_SESSION['authenticated'] = true;
            header('Location: SecFile.php');
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid captcha";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Webpage - Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>
      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group" style="margin-left: 280px; margin-top: 10px;">
          <div class="g-recaptcha" data-sitekey="6LcNx8skAAAAALS7aHvAGRQrkrZ67DkL2EFhteBt"></div>
        </div>
        <button type="submit" class="button" style="margin-top: 10px;">Login</button>
      </form>
    </div>
  </body>
</html>
