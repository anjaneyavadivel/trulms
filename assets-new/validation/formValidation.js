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
                        required: true,
                        maxlength: 200
                    },
                    tooltip: {
                        required: true,
                        maxlength: 50
                    }
                },
                messages: {
                    url: {
                        required: "This field is required",
                        remote: "Already Exists this one..!",
                    },
                },
                submitHandler: function (form) {
                    $('#form_submiting').trigger('click');
                    return false;
                }
            });

        }

    };

}();
