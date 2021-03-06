var Mainnew = function () {
    return {
        // Main function to initiate the module
        init: function ()
        {

            var type = 0;
            var id = 0;
            var tbname = 0;
            var tbcol = 0;
            var formname = 0;
            //$('#skills-list').on('click', '.btn-pf-viewskill', function () {

            $('.checkfield').focusout(function (event) {
                var checkvalue = this.value;//$('#checkemail').val();
                var data_tb = $(this).attr('data-tb');
                var data_col = $(this).attr('data-col');
                var url = base_path + "ajax/checkfield";
                $.post(url, {csrf_test_name: $.cookie('csrf_cookie_name'), checkvalue: checkvalue, data_tb: data_tb, data_col: data_col}, function (res) {
                    if (res.indexOf("Sorry") > -1) {
                        $("#checkfield_msg").html(res);
                    } else {
                        $("#checkfield_msg").html(res);
                    }
                });
            });

            $('#basic-usage').on('click', '.active-deactive-btn', function (e) {
                e.preventDefault();
                type = $(this).attr('data-val');
                id = $(this).attr('data-id');
                tbname = $(this).attr('data-tb');
                tbcol = $(this).attr('data-col');
                formname = $(this).attr('data-fn');
                if (type == 0) {
                    $('#confirmation-msg').html('Are you sure you would like to De-Active this record?');
                } else {
                    $('#confirmation-msg').html('Are you sure you would like to Active this record?');
                }
                $('#activedeactiveid').trigger("click");
            });
            $('#active-deactive').on('click', '.activedeactiveconf-btn', function (e) {
                e.preventDefault();
                var url = base_path + "ajax/active-deactive";
                $.post(url, {csrf_test_name: $.cookie('csrf_cookie_name'),
                    type: type,
                    id: id,
                    tbname: tbname,
                    tbcol: tbcol,
                    formname: formname
                }, function (res) {
                    if (res) {
                        $('.activedeactiveconf-close').trigger("click");
                        location.reload();
//                        if (type == 1) {
//                            $('#' + id).html('De-Active');
//                            $('#' + id).attr('data-val', '0');
//                            $('#' + id).removeClass('text-success');
//                            $('#' + id).addClass('text-danger');
//                        } else {
//                            $('#' + id).html('Active');
//                            $('#' + id).attr('data-val', '1');
//                            $('#' + id).removeClass('text-danger');
//                            $('#' + id).addClass('text-success');
//                        }
                    }
                });


            });
            $('#content').on('click', '.addcallform-btn', function (e) {
                e.preventDefault();
                var suburl = $(this).attr('data-ur');
                var url = base_path + suburl;
                $.get(url, {csrf_test_name: $.cookie('csrf_cookie_name'),
                }, function (res) {
                    //if (res.length>0) {
                    $('#ajaxLoadDiv').html(res);
                    $('.chosen-select').chosen();
                    $('#form4').parsley();
                    $('html, body').animate({scrollTop: $("#ajaxLoadDiv").offset().top - 50}, 500);
                    //$(".chosen-select").trigger("chosen:updated");
                    //$(".chosen-select").trigger("liszt:updated");
                    // }
                });

            });
            $('#ajaxLoadDiv').on('click', '#form4Submit', function (e) {
                e.preventDefault();
                if ($('#form4').parsley().isValid()) {
                    $('#form4Submit').prop('disabled', true);

                    var values = $("#form4").serializeArray();
                    values.push({name: "csrf_test_name", value: $.cookie('csrf_cookie_name')});
                    var url = $('#form4').attr('action');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: values,
                        success: function (data) {
                            if (data.substring(0, 5) == "Error") {
                                $('#form4SubmitMsg').html('<font style="color: #fa3031">' + data + '</font>');
                            } else {
                                $('#basic-usage').dataTable().fnDestroy();
                                $('#addcallform-btn').click();
                                var table = $('#basic-usage').DataTable({
                                    "ajax": base_path + 'form-access-json',
                                    "columns": [
                                        {"data": "ID"},
                                        {"data": "menuCaption"},
                                        {"data": "roleName"},
                                        {"data": "state"},
                                        {"data": "active"},
                                        {"data": "Action"}
                                    ],
                                    "aoColumnDefs": [
                                        {'bSortable': false, 'aTargets': [5]}
                                    ],
                                    "order": [[0, 'desc']],
                                    "dom": 'Rlfrtip',
                                    "fnDrawCallback": function () {
                                        MINOVATE.extra.tooltip();
                                    }
                                });
                                //table.ajax.reload();
                            }
                        }
                    });
                } else {
                    $('#form4').submit();
                    $('#form4Submit').prop('disabled', false);
                }
            });
            $('#ajaxLoadDiv').on('click', '.form4SubmitClose', function (e) {
                e.preventDefault();
                $('#ajaxLoadDiv').html('');
            });
            $('#content').on('click', '.editviewcallform-btn', function (e) {
                e.preventDefault();
                var suburl = $(this).attr('data-ur');
                var viewurl = $(this).attr('data-vur');
                var id = $(this).attr('data-val');
                var url = base_path + suburl;
                $.post(url, {csrf_test_name: $.cookie('csrf_cookie_name'),
                    id: id,
                    viewurl: viewurl,
                }, function (res) {
                    //if (res.length>0) {
                    $('#ajaxLoadDiv').html(res);
                    $('.chosen-select').chosen();
                    $('#form4').parsley();
                    $('html, body').animate({scrollTop: $("#ajaxLoadDiv").offset().top - 50}, 500);
                    //$(".chosen-select").trigger("chosen:updated");
                    //$(".chosen-select").trigger("liszt:updated");
                    // }
                });

            });

        } // End of init()
    };
}();
function activdeactiveclass(url, type)
{
    //alert(type);
    if (type == 0)
    {
        $('#confirmation-msg1').html('Are you sure you would like to De-Active this record?');
    }
    else if (type == 2)
    {
        $('#confirmation-msg1').html('Are you sure you would like to Approve this record?');
    }
    else if (type == 3)
    {
        $('#confirmation-msg1').html('Are you sure you would like to Go Back from this page?');
    }
    else
    {
        $('#confirmation-msg1').html('Are you sure you would like to Active this record?');
    }
    if (type == 3)
    {

        $('#form_sub_enable').html('<a href="' + url + '" class="btn btn-default btn-border activedeactiveconf-btn">Yes</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>');
    }
    else
    {
        $('#form_sub_enable').html('<a href="' + url + '/' + type + '" class="btn btn-default btn-border activedeactiveconf-btn">Yes</a><button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>');
    }

}
$('.submitformbtn').click(function () {
    $('#submitform_button').trigger('click');
});
function submitform(val) {
    document.getElementById(val).submit();
}
