var FormValidation = function ()
{
    return{
        init: function () {


            $("#add-form-master").validate({
                rules: {
                    menuCaption: {
                        required: true,
                        maxlength: 50
                    },
                    parentID: {
                        required: true
                    },
                    url: {
                        required: true,
                        maxlength: 150,
                        remote: {
                            type: "post",
                            url: base_path + "check-form-master-url",
                        },
                    },
                    icon: {
                        maxlength: 200
                    },
                    tooltip: {
                        maxlength: 50
                    }
                },
                messages: {
                    url: {
                        required: "This field is required",
                        remote: "Already exists this one...",
                    },
                },
                submitHandler: function (form) {
                    $('#formsubmiting').trigger('click');
                    return false;
                }
            });
            $("#edit-form-master").validate({
                rules: {
                    menuCaption: {
                        required: true,
                        maxlength: 50
                    },
                    parentID: {
                        required: true
                    },
                    url: {
                        required: true,
                        maxlength: 150,
                        remote: {
                            type: "post",
                            url: base_path + "check-form-master-url",
                            data: { 'pageID': $('#pageID').val() },
                        },
                    },
                    icon: {
                        maxlength: 200
                    },
                    tooltip: {
                        maxlength: 50
                    }
                },
                messages: {
                    url: {
                        required: "This field is required",
                        remote: "Already exists this one...",
                    },
                },
                submitHandler: function (form) {
                    $('#formsubmiting').trigger('click');
                    return false;
                }
            });
            
            $("#add-edit-employee-role").validate({
                rules: {
                    empID: {
                        required: true
                    },
                    'accessrole[]': {
                        required: true
                    },
                },
                messages: {
                    url: {
                        required: "This field is required",
                        remote: "Already exists this one...",
                    },
                },
                submitHandler: function (form) {
                    $('#formsubmiting').trigger('click');
                    return false;
                }
            });

        }

    };

}();
