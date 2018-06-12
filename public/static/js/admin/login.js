/*
* 登陆
* */

var login = {
    check : function () {
    //    获取登陆的账户和密码
        var username = $('#InputAccount').val();
        var password = $('#InputPassword').val();

        if(!username){
            alert('username not exit');
        }
        if(!password){
            alert('password not exit');
        }

        var url = "/tp5/public/admin/Login/check";
        var data = {'username': username, 'password': password};
        $.post(url, data, function (result) {
            alert(result.message)
        }, 'JSON');
    }
}