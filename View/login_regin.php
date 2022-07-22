<link rel="stylesheet" href="css/log.css" />
<?php
include_once('../view/widget/header.php');
?>
<main>
    <div class="title">
        <span class="home">Trang chủ</span> &ensp;
        <i class="fa-solid fa-forward"></i> &ensp;
        <span>Đăng nhập/Đăng ký</span>
    </div>
    <div class="login_regin">
        <div class="login">
            <h2>ĐĂNG NHẬP</h2>
            <form id="login_form" >
                <label for="">Email:</label><br />
                <input type="text" name="email" id="" /><br />

                <label for="">Password:</label><br />
                <input type="password" name="password" /><br>


                <div class="btn_login">
                    <input type="submit" name="login" value="Đăng nhập" />
                    <a href="">Quên mật khẩu?</a>
                </div>
            </form>
            <p>
                Nếu Quý khách có vấn đề gì thắc mắc hoặc cần hỗ trợ gì thêm có thể
                liên hệ:
            </p>
            <b>Hotline: 0961.022.334</b>
            <p>để được support nhanh nhất nhé.</p>
        </div>
        <div class="regin">
            <h2>ĐĂNG KÝ</h2>
            <form  id="register_form" enctype="multipart/form-data">
                <label for="">Họ và tên:</label><br />
                <input type="text" name="name" /><br />
                <label for="">Email:</label><br />
                <input type="email" name="email" /><br />
                <label for="">Mật Khẩu:</label><br />
                <input type="password" id="password" name="password" /><br />
                <label for="">Nhập lại password:</label><br />
                <input type="password" name="repassword" /><br />
                <div class="btn_regin">
                    <input type="submit" value="Đăng ký" name="register" />
                    <input type="reset" value="Làm mới" />
                </div>
            </form>
        </div>
    </div>
</main>
<?php
include_once('../view/widget/footer.php');
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./js/jquery.validate.min.js"></script>
<script src="./js/register.js"></script>