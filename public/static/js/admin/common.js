/*
添加按钮
 */

$("#btn-add").click(function () {
    var url = SCOPE.url_add;
    window.location.href = url;
});

/*
提交表单
 */

$("#btn_submit").click(function () {
    var data = $("#form_add").serializeArray();
    var postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.url_add_post;
    $.post(url, postData, function (result) {
        if(result.status == 1)
        {
            dialog.success("添加成功");
        }
        dialog.error("");
    }, "JSON");
    console.log(postData);
})