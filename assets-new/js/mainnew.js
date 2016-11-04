var Mainnew = function () {
    return {
        // Main function to initiate the module
        init: function ()
        {

            var type =0;var id =0;var tbname =0;var tbcol =0;
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
                if(type==0){
                   $('#confirmation-msg').html('Are you sure you would like to De-Active this record?');
                }else{
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
                    tbcol: tbcol
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
            
//            $('.tile-body').on('change', '#empID', function (e) {
//                e.preventDefault();alert( $('option:selected', this).text() ); 
//        alert( $(this).val() );
//                type = $(this).attr('data-val');
//                id = $(this).attr('data-id');
//                tbname = $(this).attr('data-tb');
//                tbcol = $(this).attr('data-col');
//                if(type==0){
//                   $('#confirmation-msg').html('Are you sure you would like to De-Active this record?');
//                }else{
//                   $('#confirmation-msg').html('Are you sure you would like to Active this record?');
//                }
//                $('#activedeactiveid').trigger("click");
        //    });
            
        } // End of init()
    };
}();
