<div class="training" id="login">
    <div class="login_style">
        <div class="login_main">
            <h1>欢迎进入考试系统</h1>
            <form method="post" action="#">
                <div class="login_infor">
                    <input type="text" name="LoginForm[name]" placeholder="登录名" id="login_name">
                    <input type="password" name="LoginForm[passwd]" placeholder="密码" id="login_password">
                </div>
                <div class="border_bottom"></div>
                <p class="check_info"></p>
                <input type="submit" value="登录" id="user_submit">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $("form").submit(function(){
        validateResult = true;
        var name = $("#login_name").val();
        var password = $("#login_password").val();
        if (name == '') {
            $(".check_info").text("请输入用户名");
            return false;
        }
        if (password == '') {
            $(".check_info").text("请输入密码");
            return false;
        }
        validateResult = $("#login_password").validate(['passwd']);
        return validateResult;
    });
});
</script>