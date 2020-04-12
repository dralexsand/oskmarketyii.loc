$(function () {

    $('#users_list').DataTable({
        "order": [[0, "desc"]]
    });

    $('body').on('click', '#add_user', function () {
        let params = {
            'action': 'add_user'
        }
        ajaxRequest(params);
    });

    $('body').on('click', '.delete_user', function () {
        let this_id = $(this).parent().attr('id');

        let params = {
            'action': 'delete_user',
            'id': this_id,
        }

        bootbox.confirm({
            size: "medium",
            message: "Удалить?",
            callback: function (result) {
                if (result) {
                    ajaxRequest(params);
                }
            }
        })

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
                loadDataTablesResult(data);

                break;
            case 'add_user':
                loadDataTablesResult(data);
                break;
        }
    }

    function loadDataTablesResult(data) {
        if($('#users_list').length>0){
            $('tbody#users_list_body').html('');
            $('#users_list').DataTable().destroy();
            $('tbody#users_list_body').html(data);
            $('#users_list').DataTable({
                "order": [[0, "desc"]]
            });
        }
    }

    function ajaxError(data) {
        console.log('ajax error:');
        console.log(data);
    }

});

