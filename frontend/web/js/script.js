$(function () {

    $('#users_list').DataTable();

    $('body').on('click', '#add_user', function () {
        let params = {
            'action': 'add_user'
        }
        console.log('add_user clicked');
        ajaxRequest(params);
    });

    $('body').on('click', '.delete_user', function () {
        let this_id = $(this).parent().attr('id');
        console.log('delete_user clicked');
        console.log('this_id: ' + this_id);

        let params = {
            'action': 'delete_user',
            'id': this_id,
        }

        bootbox.confirm({
            size: "medium",
            message: "Удалить?",
            callback: function (result) {
                console.log('result: ' + result);
                if (result) {
                    ajaxRequest(params);
                }
            }
        })

    });


    /*$(".comment-form").submit(function (event) {
        event.preventDefault(); // stopping submitting
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: data
        })
            .done(function (response) {
                if (response.data.success == true) {
                    alert("Wow you commented");
                }
            })
            .fail(function () {
                console.log("error");
            });
    });*/

});

function ajaxRequest(params) {

    let url = location.origin + '/ajax/request';

    jQuery.ajax({
        url: url,
        //url: location.origin + '/ajax',
        async: false,
        type: 'POST',
        data: {'param': params},
        dataType: 'text',
        //dataType: 'json',
        success: function (data) {
            ajaxSuccess(data, params);
        },
        error: function (data) {
            ajaxError(data);
        }
    });
}

function ajaxSuccess(data, params) {

    switch (params.action) {
        case 'delete_user':
            $('#users_list').html(data);
            break;
        case 'add_user':
            $('#users_list').html(data);
            break;
    }
    $('#users_list').DataTable();
}

function ajaxError(data) {
    console.log('ajax error');
}