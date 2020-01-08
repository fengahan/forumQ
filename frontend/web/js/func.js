function notify(from, align, icon, type, animIn, animOut,msg){
    $.notify({
        icon: icon,
        title: '消息提示:',
        message: msg,
        url: ''
    },{
        element: 'body',
        type: type,
        allow_dismiss: true,
        offset: {
            x: 15, // Keep this as default
            y: 15  // Unless there'll be alignment issues as this value is targeted in CSS
        },
        spacing: 10,
        z_index: 1031,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
        animate: {
            enter: animIn,
            exit: animOut
        },
        template:   '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">关闭</button>' +
            '</div>'
    });
}