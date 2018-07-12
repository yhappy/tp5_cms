/*
* 登陆
* */

var login = {
    check: function () {
        //    获取登陆的账户和密码
        var username = $('#InputAccount').val();
        var password = $('#InputPassword').val();

        if (!username) {
            layer.alert('username not exit');
            return;
        }
        if (!password) {
            layer.alert('password not exit');
            return
        }
        console.log('check');
        var url = "/tp5/public/admin/Login/check";
        var data = {'username': username, 'password': password};
        $.post(url, data, function (result) {
            if (result.status == 0) {
                dialog.error(result.message);
            }
            if (result.status == 1) {
                dialog.success(result.message,'/tp5/public/admin');
            }
        }, 'JSON');
    }
}