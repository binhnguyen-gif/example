<div class="col-sm-5">
    <h4 class="font-alt">Change password</h4>
    <hr class="divider-w mb-10">
    <form class="form"  method="POST">
    <?php if(isset($_SESSION['username'])){ ?>
        <div class="form-group">
        <input class="form-control" id="username" disabled type="text" name="username" value="<?php echo $_SESSION['username']; ?>" placeholder="Username"/>
        </div>
                <?php } ?>
        <div class="form-group">
        <input class="form-control" id="password_current" type="password" name="password_current" placeholder="password_current"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <input class="form-control" id="password_new" type="password" name="password_new" placeholder="password_new"/>
        <p class="hint">Chỉnh sửa</p>
        </div>
        <div class="form-group">
        <button type="submit" name="change_password" class="btn btn-block btn-round btn-b">Change</button>
        </div>
    </form>
</div>


