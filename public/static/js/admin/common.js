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
    var url = SCOPE.url_add;
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            dialog.success(result.message, '.');
        }
        if (result.status == 0) {
            dialog.error(result.message);
        }
    }, "JSON");
    // console.log(postData);
})

/*
添加分页样式
 */
$("ul.pagination").addClass("pager");

/*
改变选择
*/
$('select.chosen-select').on('change', function () {
    // console.log(this.value);
    var url = SCOPE.url_list_type + this.value;
    window.location.href = url;
});

/*
点击编辑
 */
$('.table .btn-edit').click(function(){
    var url = SCOPE.url_edit + this.id;
    // console.log(url);
    window.location.href = url;
});