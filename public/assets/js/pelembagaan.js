/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Pelembagaan = (function(REG) {

    REG.Form = function() {
        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            $('#pelembagaan-form').submit();
        });

        var rules = {
                'jenis_usulan': 'required',
                'perihal': 'required',
                'catatan': 'required',
                'password_confirmation': 'required',
                'email': {
                    required: true,
                    email: true
                }
            };

        $("#pelembagaan-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'jenis_usulan': {
                    required: 'Silahkan Pilih Jenis Usulan.'
                },                
                'perihal': {
                    required: 'Pelembagaan Harus diisi.'
                },
                'lampiran': {
                    required: 'Lampiran wajib diisi.'
                },
                'catatan': {
                    required: 'Catatan wajib diisi.'
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

        $("#pelembagaan-form input[type='file']").change(function(e){
            $(this).validate();
                $controlGroup = $(this).parents('div.control-group');
                if($(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })

    };

    REG.Update = function() {
        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            $('#pelembagaan-update').submit();
        });

        var rules = {
                'status': 'required',
                'catatan': 'required',
                'ket_lampiran': 'required'
        };

        $("#pelembagaan-update").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'status': {
                    required: 'Pelembagaan Harus diisi.'
                },
                'ket_lampiran': {
                    required: 'Keterangan Lampiran Harus diisi.'
                //},'lampiran': {
                //    required: 'Lampiran wajib diisi.'
                },
                'catatan': {
                    required: 'Catatan wajib diisi.'
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

        $("#pelembagaan-update input[type='file']").change(function(e){
            $(this).validate();
                $controlGroup = $(this).parents('div.control-group');
                if($(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })

    };


    return REG;
}(Pelembagaan || {}));
