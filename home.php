<?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header("Location: $loc?action=login");
}
 ?>
<div>
        <a href="<?php echo $loc ?>?action=diemdanh" class="attendance-action">Điểm danh</a>
</div>