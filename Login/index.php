<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["user_id"])) {
  header("Location: welcome.php");
}

if (isset($_POST["signup"])) {
  $full_name = mysqli_real_escape_string($conn, $_POST["signup_full_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
  $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));
  $token = md5(rand());

  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email='$email'"));

  if ($password !== $cpassword) {
    //kiểm tra mật khẩu khớp hay không
    echo "<script>alert(' Mật khẩu không trùng khớp ');</script>"; 
  } elseif ($check_email > 0) {
    echo "<script>alert('Email đã tồn tại trong hệ thống');</script>";
  } else {
    $sql = "INSERT INTO users (full_name, email, password, token, status) VALUES ('$full_name', '$email', '$password', '$token', '0')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_POST["signup_full_name"] = "";
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      $_POST["signup_cpassword"] = "";

      $to = $email;
      $subject = "Xác thực Email";

      $message = "
      <html>
      <head>
      <title>{$subject}</title>
      </head>
      <body>
      <p><strong>Dear {$full_name},</strong></p>
      <p>Thanks for registration! Verify your email to access our website. Click below link to verify your email.</p>
      <p><a href='{$base_url}verify-email.php?token={$token}'>Verify Email</a></p>
      </body>
      </html>
      ";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= "From: ". $my_email;

      if (mail($to,$subject,$message,$headers)) {
        echo "<script>alert('We have sent a verification link to your email - {$email}.');</script>";
      } else {
        echo "<script>alert('Mail not sent. Please try again.');</script>";
      }
    } else {
      echo "<script>alert('User registration failed.');</script>";
    }
  }
}

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

  $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND password='$password' AND status='1'");

  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["user_id"] = $row['id'];
    header("Location: welcome.php");
  } else {
    echo "<script>alert('Login details is incorrect. Please try again.');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Sign in & Sign up Form - Pure Coding</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- Form đăng nhập -->
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Đăng nhập</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email" name="email" value="<?php echo $_POST['email']; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Mật khẩu" name="password" value="<?php echo $_POST['password']; ?>" required />
          </div>
          <input type="submit" value="Tiếp tục" name="signin" class="btn solid" />
          <p style="display: flex;justify-content: center;align-items: center;margin-top: 20px;"><a href="forgot-password.php" style="color: #4590ef;">Forgot Password?</a></p>
        </form>

        <!-- Form đăng kí -->
        <form action="" class="sign-up-form" method="post">
          <h2 class="title">Đăng kí</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Họ và tên" name="signup_full_name" value="<?php echo $_POST["signup_full_name"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" name="signup_email" value="<?php echo $_POST["signup_email"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Mật khẩu" name="signup_password" value="<?php echo $_POST["signup_password"]; ?>" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Xác nhận mật khẩu" name="signup_cpassword" value="<?php echo $_POST["signup_cpassword"]; ?>" required />
          </div>
          <input type="submit" class="btn" name="signup" value="Sign up" />
        </form>
      </div>
    </div>

    <!-- Giao diện welcome -->
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Bạn chưa có tài khoản</h3>
          <p>
            Hãy đăng kí để tham gia cộng đồng hiến máu 
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Đăng kí ngay !
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Đã có tài khoản?</h3>
          <p>
            Đăng nhập để đến với cộng đồng hiến máu
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Đăng nhập ngay !
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>