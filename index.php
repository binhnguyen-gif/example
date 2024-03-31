<?php
include 'db_config.php';
// Start session
session_start();

$page = null;
if(isset($_GET['action'])) {
    $page = $_GET['action'];
}

$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Phân tích URL
$url_parts = parse_url($current_url);
$url_parts['path'] = preg_replace('#/+#','/', $url_parts['path']);
$url_parts['path'] = preg_replace('/(?:\.index|\.php)$/', '', $url_parts['path']);
// Tạo URL mới chỉ bao gồm scheme, host và path
$loc = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'];

// Kiểm tra xem người dùng đã đăng nhập chưa
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // Kiểm tra thời gian hết hạn của phiên đăng nhập
  if(time() > $_SESSION['expire']) {
      // Nếu thời gian đã hết hạn, xóa các biến session và đăng xuất người dùng
      session_unset();
      session_destroy();
      echo "Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.";
  } else {
      // Nếu phiên đăng nhập vẫn còn hiệu lực, cập nhật lại thời gian hết hạn
      $_SESSION['expire'] = time() + (60 * 60); // Cập nhật lại thời gian hết hạn là 1 giờ sau khi hoạt động cuối cùng
      echo "Bạn đang đăng nhập với tên người dùng: " . $_SESSION['username'];
  }
} else {
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
  .module1 {
    background: rgba(2, 2, 2, 0.4);
  }
    .module input {
        width: 100%;
    }

    .container {
        min-width: 450px;
    }

    .logout {
      display: block;
      text-align: center;
      font-size: 16px;
    }

    .logout:hover {
      color: #fff;
    }

    .login , .forgot{
      margin-left: 20px;
    }

    .avatar {
      width: 50px;
      height: 50px;
     border-radius: 50%;
    }

    .attendance-action {
      display: block;
      font-size: 16px;
      text-align: center;
    }

    .item-avatar {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .header {
      margin: 0 auto;
      max-width: 1530px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 46px;
    }

    .header-item {
      list-style: none;
    }
    .header-item a {
      display: inline-block;
      font-size: 16px;
    }

    .hint {
      color:red;
      margin: 0 0 15px 0 !important;
    }
</style>
<body>
  <div class="header">
    <ul class="nav">
      <li class="header-item"><a href="<?php echo $loc ?>">Home</a></li>
    </ul>
    <div>
    <?php if(isset($_SESSION['username'])){ ?>
      <a href="<?php echo $loc ?>?action=logout">Đăng xuất</a>
                <?php } ?>
    </div>
  </div>
<div class="main">
        <section class="module module1" data-background="assets/images/section-4.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Login-Register</h1>
                <?php if(isset($_SESSION['username'])){ ?>
                <h2 class="module-title font-alt mb-0">Username: <?php echo $_SESSION['username']; ?></h2>
                <br>  
                <a href="<?= $loc ?>?action=change" class="logout">Thay đổi mật khẩu</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </section>
        <section class="module"  style="display: flex;
    align-items: center;
    justify-content: center;
   ">
          <div class="container">
            <div class="row">
                <?php
                  switch ($page) {
                    case 'login':
                        require_once 'login.php';
                        break;
                    case 'logout':
                        session_destroy();
                        header("Location: $loc");
                        break;
                    case 'change':
                        require_once 'password_c.php';
                        require_once 'change.php';
                        break;
                    case 'forgot':
                      require_once 'password_c.php';
                      require_once 'forgot.php';
                      break;
                    case 'register':
                      require_once 'register.php';
                      break;
                    case 'diemdanh':
                      require_once 'diemdanh.php';
                      break;
                    default:
                        require_once 'home.php';
                        break;
                  }
                ?>
              
            </div>
          </div>
        </section>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
</body>
</html>