<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['change_password'])) {
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $password_current = $_POST['password_current'];
            $password_new = $_POST['password_new'];
    
            $password_current = md5($password_current);
            $password_new = md5($password_new);
    
            $sql = "UPDATE account SET password='$password_new' WHERE username='$username' AND password='$password_current'";
            if (mysqli_query($conn, $sql)) {
                echo "Đổi mật khẩu thành công!";
            } else {
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Vui lòng đăng nhập trước khi thay đổi mật khẩu!";
        }
    }
    
    // Chức năng quên mật khẩu
    // if(isset($_POST['forgot_password'])) {
    //     $username = $_POST['username'];
    //     $secpassword = $_POST['secpassword'];
    
    //     $secpassword = md5($secpassword);
    
    //     $sql = "SELECT password FROM account WHERE username='$username' AND secpassword='$secpassword'";
    //     $result = mysqli_query($conn, $sql);
    
    //     if (mysqli_num_rows($result) == 1) {
    //         $row = mysqli_fetch_assoc($result);
    //         $password = $row['password'];
    //         echo "Mật khẩu của bạn là: $password";
    //     } else {
    //         echo "Tên đăng nhập hoặc mật khẩu phụ không đúng!";
    //     }
    // }

    if(isset($_POST['forgot_password'])) {
        $username = $_POST['username'];
        $secpassword = $_POST['secpassword'];
        $new_password = $_POST['new_password']; 
    
        // Escape input to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $username);
        $secpassword = mysqli_real_escape_string($conn, $secpassword);
        $new_password = mysqli_real_escape_string($conn, $new_password);
    
        $secpassword = md5($secpassword);
    
        $sql = "SELECT password FROM account WHERE username='$username' AND secpassword='$secpassword'";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                // Password matched, update password with the new password
                $password = md5($new_password);
                $update_sql = "UPDATE account SET password='$password' WHERE username='$username'";
                if (mysqli_query($conn, $update_sql)) {
                    echo "Mật khẩu đã được cập nhật thành công!";
                } else {
                    echo "Có lỗi xảy ra khi cập nhật mật khẩu: " . mysqli_error($conn);
                }
            } else {
                echo "Tên đăng nhập hoặc mật khẩu phụ không đúng!";
            }
        } else {
            echo "Có lỗi xảy ra khi thực hiện truy vấn: " . mysqli_error($conn);
        }
    }
    
    mysqli_close($conn);
}
?>