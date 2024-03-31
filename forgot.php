<div class="col-sm-5">
    <h4 class="font-alt">Forgot password</h4>
    <hr class="divider-w mb-10">
    <form class="form"  method="POST">
        <div class="form-group">
        <input class="form-control" id="username" type="text" name="username" placeholder="Username"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="secpassword" type="password" name="secpassword" placeholder="secpassword"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="new_password" type="password" name="new_password" placeholder="new_password"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <button type="submit" name="forgot_password" class="btn btn-block btn-round btn-b">Đổi pass</button>
        <a href="<?= $loc ?>?action=login" class="login">Đăng nhập</a>
        </div>
    </form>
</div>