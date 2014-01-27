/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Admin = (function(ADM) {

    ADM.Index = function() {
        /* Filter Daerah Registrasi */
        $('#filter-registrasi').on('change', function() {
            var $this = $(this);
            if($this.val() != '') {
                var ACTION = baseUrl + '/Manage?rid=' + $this.val();
                // console.log(ACTION);
                window.location = ACTION;
            }
        });
    };

    ADM.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            $('#reg_admin_a').submit();
        });

        var rules = {
            'nama_lengkap': 'required',
            'password': 'required',
            'password_confirmation': 'required',
            'email': {
                required: true,
                email: true
            }
        };

        $("#reg_admin").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'password': 'Password tidak boleh kosong!.',
                'password_confirmation': 'Konfirmasi Password wajib diisi!.',
                'nama_lengkap': 'Nama lengkap wajib diisi.',
                'email': {
                    required: 'Alamat E-Mail wajib diisi.',
                    email: 'Format email tidak benar'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('div.controls'));
            },
            invalidHandler: function(event, validator) {
                $("div.control-group.error").removeClass('error');
                $('div.controls .error[name]').parents('div.control-group').addClass('error');
            },
            onfocusout: function(elem, event) {
                $(elem).validate();
                $controlGroup = $(elem).parents('div.control-group');
                if($(elem).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
            }
        });


    };

    return ADM;
}(Admin || {}));