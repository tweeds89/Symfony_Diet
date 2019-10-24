function alertDialog(title, message, closeButton = 'Zamknij', cancelCallback = null) {
    $("#alert-dialog").attr('title', title);
    $("#alert-dialog p").html(message);

    $('#alert-dialog').dialog({
        autoOpen : true,
        width : 600,
        resizable : false,
        modal : true,
        title : title,
        buttons : [{
            html : closeButton,
            "class" : "btn btn-default",
            click : function() {
                if(typeof cancelCallback === 'function') {
                    cancelCallback();
                }
                $(this).dialog("close");
                location.reload();
            }
        }]
    });
}
