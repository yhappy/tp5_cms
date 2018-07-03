/*
添加按钮
 */

$("#btn-add").click(function () {
    var url = SCOPE.url_add;
    window.location.href = url;
});

/*
提交排序
 */

$("#btn-listorder").click(function () {
    var data = $("#form_listorder").serializeArray();
    var url = SCOPE.url_listorder;
    $.post(url, data, function (result) {
        if (result.status == 1) {
            dialog.success(result.message, '');
        }
        if (result.status == 0) {
            dialog.error(result.message);
        }
    }, "JSON");
    // console.log(postData);
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
});

/*
添加分页样式
 */
$("ul.pagination").addClass("pager");

/*
改变选择
*/
$('select.menu-select').on('change', function () {
    // console.log(this.value);
    var url = SCOPE.url_list_type + this.value;
    window.location.href = url;
});

/*
点击编辑
 */
$('.btn-edit').click(function () {
    var url = SCOPE.url_edit + this.id;
    console.log(url);
    window.location.href = url;
});

/*
点击删除
 */
$('.btn-delete').click(function () {
    var url = SCOPE.url_delete;
    var id = this.id;
    var postData = { 'id': id };
    var message = '确定删除ID为' + id + '的数据吗？';
    // console.log(message);
    layer.open({
        title: 'CONFIRM!',
        content: message,
        icon: 3,
        skin: 'layui-layer-lan',
        yes: function () {
            doDelete(url, postData);
        }
    });
});

var doDelete = function (url, postData) {
    $.post(url, postData, function (result) {
        if (result.status == 1) {
            dialog.success(result.message, '');
        }
        if (result.status == 0) {
            dialog.error(result.message);
        }
    }, "JSON");
}

/**
 * 缩略图上传
 */
var options = {
    // 初始化选项
    'url': SCOPE.url_pic_upload,
    'deleteActionOnDone': true,
};

$('#picUploader').uploader(options);
