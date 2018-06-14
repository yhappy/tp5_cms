var dialog = {
    error: function (message) {
        layer.open({
            title: 'WRONG!',
            content: message,
            icon: 5,
            skin: 'layui-layer-lan',
        });
    },
    success: function (message, url) {
        layer.open({
            title: 'SUCCESS!',
            content: message,
            icon: 6,
            skin: 'layui-layer-lan',
            yes: function () {
                location.href = url;
            },
        });
    },
}