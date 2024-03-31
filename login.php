<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM account WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['start'] = time(); // Set session start time
        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60); // Set session duration to 1 hour

        echo "Login successful";
        ob_start();
        header("Location: $loc");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>

<div class="col-sm-5 col-sm-offset-1 mb-sm-40">
    <h4 class="font-alt">Login</h4>
    <hr class="divider-w mb-10">
    <form class="form" id="form-login" method="POST">
        <div class="form-group" >
        <input class="form-control" id="username" type="text" name="username" placeholder="Username"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="password" type="password" name="password" placeholder="Password"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <button name="login" type="submit" class="btn btn-round btn-b">Login</button>
        <a href="<?= $loc ?>?action=forgot" class="forgot">Forgot Password?</a>
        </div>
        <div class="form-group">
        <a href="<?= $loc ?>?action=register" class="">Đăng ký</a>
    </div>
    </form>
</div>