$(document).ready(function() {
    //checkComposer();
});

function urlComposer() {
    return 'mainComposer.php';
}

function callPack(command, pack) {
    $("#output").append("\nplease wait...\n");
    $("#output").append("\n===================================================================\n");
    $("#output").append("Executing Started");
    $("#output").append("\n===================================================================\n");
    $.post('main' + pack + '.php', {
            "package": $("#"+pack+"_text").val(),
            "command": command,
            "function": "command"
        },
        function(data) {
            $("#output").append(data);
            $("#output").append("\n===================================================================\n");
            $("#output").append("Execution Ended");
            $("#output").append("\n===================================================================\n");
        }
    );
}


function extractComposer() {
    $("#output").append('\nLoading extractComposer...\n');
    $.ajax({
        url: urlComposer(),
        type: 'post',
        //dataType: 'json',
        data: {
            "function": "extractComposer"
        }
    }).done(function(data, textStatus, jqXHR) {
        $("#output").append(data);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log('--- fail ---');
        console.log('jqXHR');
        console.log(jqXHR);
        console.log('textStatus');
        console.log(textStatus);
        console.log('errorThrown');
        console.log(errorThrown);
    }).always(function(jqXHROrData, textStatus, jqXHROrErrorThrown) {
        //console.log(data);
        console.log("complete");
    });

}

function downloadComposer() {
    $("#output").append('\nLoading downloadComposer...\n');
    $.ajax({
        url: urlComposer(),
        type: 'post',
        //dataType: 'json',
        data: {
            "function": "downloadComposer"
        }
    }).done(function(data, textStatus, jqXHR) {
        $("#output").append(data);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log('--- fail ---');
        console.log('jqXHR');
        console.log(jqXHR);
        console.log('textStatus');
        console.log(textStatus);
        console.log('errorThrown');
        console.log(errorThrown);
    }).always(function(jqXHROrData, textStatus, jqXHROrErrorThrown) {
        //console.log(data);
        console.log("complete");
    });

}

function check() {
    $("#output").append('\nLoading...\n');
    $.ajax({
        url: urlComposer(),
        type: 'post',
        dataType: 'json',
        data: {
            "function": "getStatus"
        }
    }).done(function(data, textStatus, jqXHR) {
        if (data.composer_extracted) {
            $("#output").html("Ready. All commands are available.\n");
            $("button.composer").removeClass('disabled');
            $("button.bower").removeClass('disabled');
        } else if (data.composer) {
            $("#output").html("Please extractComposer \n");
            /*
            $.post(urlComposer(), {
                    "password": $("#password").val(),
                    "function": "extractComposer",
                },
                function(data) {
                    $("#output").append(data);
                    window.location.reload();
                }, 'text');
                */
        } else {
            $("#output").html("Please downloadComposer \n");
            /*
            $.post(urlComposer(), {
                    "password": $("#password").val(),
                    "function": "downloadComposer",
                },
                function(data) {
                    $("#output").append(data);
                    check();
                }, 'text');
            */
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.log('--- fail ---');
        console.log('jqXHR');
        console.log(jqXHR);
        console.log('textStatus');
        console.log(textStatus);
        console.log('errorThrown');
        console.log(errorThrown);


    }).always(function(jqXHROrData, textStatus, jqXHROrErrorThrown) {
        //console.log(data);
        console.log("complete");
    });
}

function checkComposerOLD() {
    $("#output").append('\nloading...\n');
    $.post(urlComposer(), {
            "function": "getStatus",
            "password": $("#password").val()
        },
        function(data) {

            if (data.composer_extracted) {
                $("#output").html("Ready. All commands are available.\n");
                $("button.composer").removeClass('disabled');
                $("button.bower").removeClass('disabled');
            } else if (data.composer) {
                $.post(urlComposer(), {
                        "password": $("#password").val(),
                        "function": "extractComposer",
                    },
                    function(data) {
                        $("#output").append(data);
                        window.location.reload();
                    }, 'text');
            } else {
                $("#output").html("Please wait till composer is being installed...\n");
                $.post(urlComposer(), {
                        "password": $("#password").val(),
                        "function": "downloadComposer",
                    },
                    function(data) {
                        $("#output").append(data);
                        check();
                    }, 'text');
            }
        });
}