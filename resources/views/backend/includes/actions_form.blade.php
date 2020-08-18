<script>

    jQuery(document).ready(function(){
        let page_content = $(".page-content");
        let page_content_crud = $(".page-content-crud");
        let datatable_ajax = $("#datatable_ajax");
        let form_crud_edit = $(".form-crud-edit");
        let form_action_cancel = $(".form-action-cancel");
        let form_action_ok = $(".form-action-ok");
        let select2 = $("select.select2");
        let select = $("form select.form-control");
        let form_action_change_password = $(".form-action-change-password");
        let page_content_list = $(".page-content-list");
        let lang = ['en', 'es'];
        let gallery_files = [];
        let gallery_files_list = $('.gallery-files-list');
        let cont_gallery_files = gallery_files_list.find('.gallery-file').length;
        let gallery_file_remove = $('.gallery-file-remove');

        form_action_change_password.on('click', function(){
            $("#password").removeAttr("disabled");
            $("#password_confirmation").removeAttr("disabled");
        });


        /*summernote*/
        for(let i = 0; i < lang.length; i++){
            let textarea_editor = $("textarea#ckeditor_" + lang[i]);
            if(textarea_editor.hasClass('hide-toolbar')){
                textarea_editor.summernote({
                    toolbar: [],
                });
            }
            else{
                textarea_editor.summernote({
                    callbacks: {
                        onImageUpload: function(files) {
                            for(let j=0; j < files.length; j++) {
                                $.upload(files[j], textarea_editor);
                            }
                        },
                        onMediaDelete : function(target) {
                            $.delete(target[0].src);
                        }
                    },
                });
            }
        }
        $.upload = function (file, ele) {
            let out = new FormData();
            out.append('_token', '{{ csrf_token() }}');
            out.append('file', file);

            $.ajax({
                url: '{{ action('Backend\DefaultController@uploadFileCKEditor') }}',
                method: "POST",
                data: out,
                cache: false,
                contentType: false,
                processData: false,
                async: true,
            })
            .done(function(response){
                let image = '';
                if(response !== undefined){
                    if(response.success === true){
                        image = $('<img style="width: 100%;">').attr('src', "{{ asset('storage/') }}" + "/" + response.path);
                        ele.summernote("insertNode", image[0]);
                    }
                }
            })
            .fail(function(){

            });
        };
        $.delete = function (src) {
            let out = new FormData();
            out.append('_token', '{{ csrf_token() }}');
            out.append('src', src);

            $.ajax({
                url: '{{ action('Backend\DefaultController@deleteFileCKEditor') }}',
                method: "POST",
                data: out,
                cache: false,
                contentType: false,
                processData: false,
                async: true,
            })
            .done(function(response){

            })
            .fail(function(){

            });
        };

        /*Select*/
        select2.each(function(){
            $(this).select2({
                placeholder: "Select",
                allowClear: true
            });
            let data_value_select2 = $(this).attr('data-value');
            if(data_value_select2 !== ''){
                data_value_select2 = jQuery.parseJSON(data_value_select2);
            }
            if($(this).attr('multiple') === undefined){
                $(this).val(data_value_select2).trigger('change');
            }
        });
        select.each(function(){
            $(this).val($(this).attr('data-value')).trigger('change');
        });

        form_action_cancel.on('click', function(){
            if(form_crud_edit.attr('id') === 'user-profile-form'){
                page_content.empty();
                page_content.load('{{ action('Backend\UserController@showProfile') }}');
            }
            else{
                page_content_crud.empty();
                page_content_list.show();
            }
        });
        form_action_ok.on('click', function(){
            form_crud_edit.submit();
        });

        form_crud_edit.on('submit', function(e){
            e.preventDefault();

            let out = new FormData(this);
            out.delete('files');
            out.delete('gallery_files[]');

            for(let i = 0; i < gallery_files.length; i++){
                out.append('gallery_files[]', gallery_files[i]);
            }

            $.ajax({
                url: $(this).attr('data-action'),
                method: "POST",
                data: out,
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                beforeSend: validate_custom
            })
            .done(function(response){
                if(response !== undefined){
                    if(response.success === true){
                        if(form_crud_edit.attr('id') === 'user-profile-form'){
                            page_content.empty();
                            page_content.load('{{ action('Backend\UserController@editProfile') }}');
                        }
                        else{
                            showAlert('success', 'fa fa-check', 'Successful operation');
                            datatable_ajax.DataTable().ajax.reload();
                            page_content_crud.empty();
                            page_content_list.show();
                        }
                    }
                    if(response.success === false){
                        showAlert('danger', 'fa fa-times', 'Failed operation');
                    }
                }
            })
            .fail(function(){
                if(validate_custom()){
                    showAlert('danger', 'fa fa-times', 'Failed operation');
                }
            });
        });


        /*VALIDATE*/

        /* Notify */
        let showAlert = function(type, icon, message){
            $.notify(
                {
                    icon: icon,
                    message: message
                },
                {
                    allow_dismiss: true,
                    type: type,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                }
            );
        };

        /* Validate */
        let validate_custom = function(){
            let form_crud = form_crud_edit[0];
            let result = true;
            for (let i = 0; i < form_crud.length; i++) {
                let name = form_crud[i].name;
                let parent = $('*[name*="' + name + '"]').parent();
                if (form_crud[i].required === true) {
                    if(isEmptyCustom(form_crud[i].value)){
                        showMessage(parent, 'The field is required');
                        result = false;
                    }
                    else if(form_crud[i].type === 'email' && !isEmailCustom(form_crud[i].value)){
                        showMessage(parent, 'The email is not correct');
                        result = false;
                    }
                    else if(form_crud[i].type === 'file' && !checkSizeFile(form_crud[i].files[0])){
                        showMessage(parent, 'File size must be less than 1 MB');
                        result = false;
                    }
                    else{
                        deleteMessage(parent);
                    }
                }
                if(form_crud[i].type === 'password' && form_crud[i].id === 'password_confirmation'){
                    let password = $("#password");
                    if(password.val() !== null){
                        if(form_crud[i].value !== password.val()){
                            showMessage(parent, 'Passwords do not match');
                            result = false;
                        }
                    }
                }
                if(form_crud[i].type === 'file' && !isEmptyCustom(form_crud[i].value)){
                    if(!checkSizeFile(form_crud[i].files[0])){
                        showMessage(parent, 'File size must be less than 1 MB');
                        result = false;
                    }
                }
            }
            return result;
        };
        let isEmptyCustom = function(value){
            let expresion = /^\s*$/;
            return expresion.test(value)
        };
        let isEmailCustom = function(value){
            let expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
            return expresion.test(value)
        };
        let checkSizeFile = function(value){
            return value.size < 1048576;/*1MB*/
        };
        let showMessage = function(field, text) {
            field.addClass('has-error');
            field.children('.help-block').html(text);
        };
        let deleteMessage = function(field) {
            field.removeClass('has-error');
            field.children('.help-block').html('');
            field.addClass('has-success');
        }


        /*Gallery*/
        $('.files-input').change(function (e) {
            for(let i = 0; i < e.target.files.length; i++){
                gallery_files.push(e.target.files[i]);
                addImages(e.target.files[i]);
            }
        });
        function addImages(file){
            let imageType = /image.*/;
            if (!file.type.match(imageType))
                return;
            let reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
        }
        function fileOnload(file) {
            let result = file.target.result;
            cont_gallery_files = cont_gallery_files + 1;
            gallery_files_list.append('<div class="col-lg-3 form-group"><img class="img-responsive" src="'+ result +'"/><a class="btn btn-default gallery-file-remove" href="javascript:;">X</a></div>');
                if(cont_gallery_files % 4 === 0){
                    gallery_files_list.append('<div class="clearfix"></div>');
                }
        }
        gallery_file_remove.on('click', function(){
            $(this).parent().remove();
        });
    });

</script>
