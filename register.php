<?php
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Kiểm tra xem username đã được nhập chưa
    if (empty($_POST["username"])) {
        $errors[] = "Username is required";
    } else {
        $username = $_POST["username"];
        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check_username = "SELECT * FROM account WHERE username='$username'";
        $result_check_username = $conn->query($sql_check_username);
        if ($result_check_username->num_rows > 0) {
            $errors[] = "Username already exists";
        }
    }

    // Kiểm tra xem password đã được nhập chưa
    if (empty($_POST["password"])) {
        $errors[] = "Password is required";
    } else {
        $password = $_POST["password"];
        // Kiểm tra độ dài của password
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        }
        // Kiểm tra password chỉ bao gồm chữ cái và số
        if (!preg_match("/^[a-z0-9]+$/", $password)) {
            $errors[] = "Password can only contain letters and numbers";
        }
    }

    // Kiểm tra xem secpassword đã được nhập chưa
    if (empty($_POST["secpassword"])) {
        $errors[] = "secpassword password is required";
    }
    
    else {
        $secpassword = $_POST["secpassword"];
        // // Kiểm tra xem secpassword có trùng khớp với password không
        // if ($password !== $secpassword) {
        //     $errors[] = "Passwords do not match";
        // }
    }

    // Nếu không có lỗi, thêm dữ liệu vào cơ sở dữ liệu
    if (empty($errors)) {
        $password = md5($password);
        $secpassword = md5($secpassword);
        
        $sql = "INSERT INTO account (username, password, secpassword) VALUES ('$username', '$password', '$secpassword')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registered successfully";
            header("Location: $loc/?action=login");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Hiển thị các lỗi nếu có
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    $errors = [];
}

$conn->close();
?>

<div class="col-sm-5">
    <h4 class="font-alt">Register</h4>
    <hr class="divider-w mb-10">
    <form class="form" id="form-resgiter" method="POST">
        <div class="form-group">
        <input class="form-control" id="username" type="text" name="username" placeholder="Username"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="password" type="password" name="password" placeholder="password"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="secpassword" type="password" name="secpassword" placeholder="secpassword"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <button type="submit" name="register" class="btn btn-block btn-round btn-b">Register</button>
        <a href="<?= $loc ?>?action=login" class="login">Đăng nhập</a>
        </div>
    </form>
</div>