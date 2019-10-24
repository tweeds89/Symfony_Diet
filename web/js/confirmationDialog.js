function confirmationDialog(title, message, successButtonMessage, cancelButtonMessage, successCallback, cancelCallback = null) {
    $("#confirmation-dialog").attr('title', title);
    $("#confirmation-dialog p").html(message);

    $('#confirmation-dialog').dialog({
        autoOpen : true,
        width : 600,
        resizable : false,
        modal : true,
        title : title,
        buttons : [{
            html : successButtonMessage,
            "class" : "btn btn-danger",
            click : function() {
                if(typeof successCallback === 'function') {
                    successCallback();
                }
                $(this).dialog("close");
            }
        }, {
            html : "<i class='fa fa-times'></i>&nbsp;" + cancelButtonMessage,
            "class" : "btn btn-default",
            click : function() {
                if(typeof cancelCallback === 'function') {
                    cancelCallback();
                }
                $(this).dialog("close");
            }
        }]
    });
}
