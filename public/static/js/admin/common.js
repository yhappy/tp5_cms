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

$("#btn-slide").click(function () {
    var datas = $("#form_slide").serializeArray();
    var url = SCOPE.url_slide;
    var slideArray = {"slide": new Array()};
    for (i in datas) {
        if (datas[i].name == "slide") {
            slideArray.slide.push(datas[i].value);
        }
    }
    $.post(url, slideArray, function (result) {
        console.log(result);
        if (result.status == '0') {
            new $.zui.Messager('提示消息：' + result.message, {
                type: 'danger' // 定义颜色主题
            }).show();
        } else {
            if (result.data.success) {
                new $.zui.Messager('提示消息：ID为' + result.data.success + '的新闻收藏成功', {
                    type: 'success' // 定义颜色主题
                }).show();
            }
            if (result.data.error) {
                new $.zui.Messager('提示消息：ID为' + result.data.error + '的新闻收藏失败', {
                    type: 'danger' // 定义颜色主题
                }).show();
            }
            if (result.data.exist) {
                new $.zui.Messager('提示消息：ID为' + result.data.exist + '的新闻之前收藏过了', {
                    type: 'danger' // 定义颜色主题
                }).show();
            }
        }
    }, "JSON");
    // console.log(datas);
    // console.log(slideArray);
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
    console.log(postData);
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
    var url = SCOPE.url_edit + this.name;
    // console.log(url);
    window.location.href = url;
});

/*
点击删除
 */
$('.btn-delete').click(function () {
    var url = SCOPE.url_delete;
    var id = this.name;
    var postData = {'id': id};
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

$(".list-order").change(function () {
    var data = {};
    data['listorder'] = this.value;
    data['id'] = this.name;
    url = SCOPE.url_listorder;
    $.post(url, data, function (result) {
        if (result.status == 0) {
            dialog.error(result.message);
        }
        if (result.status == 1) {
            dialog.success(result.message, '');
        }
    }, "JSON");
});
