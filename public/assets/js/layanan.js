/**
 * Created by Sangkuriang on 2/3/14.
 */
/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Layanan = (function(LAY) {

    LAY.Index = function() {
        /* Filter Daerah Registrasi */
        jQuery('#filter-registrasi').on('change', function() {
            var $this = jQuery(this);
            if($this.val() != '') {
                var ACTION = baseUrl + '/Manage?rid=' + $this.val();
                // console.log(ACTION);
                window.location = ACTION;
            }
        });
    };

    LAY.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        /*
         * Trigger Submit Form
         */
        jQuery('button#submit').on('click', function() {
            jQuery('#layanan-form').submit();
        });

        var rules = {
            'layananlembaga[judul_berita]': 'required',
            'layananlembaga[berita]': 'required',
            'layananlembaga[penanggung_jawab]': 'required',
            'layananlembaga[image]': 'required'
        };

        jQuery("#layanan-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'layananlembaga[judul_berita]': 'Judul Berita tidak boleh kosong!',
                'layananlembaga[berita]': 'Isi Berita tidak boleh kosong!',
                'layananlembaga[penanggung_jawab]': 'Nama Penulis wajib diisi.',
                'layananlembaga[image]': 'Gambar wajib diisi.'
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('div.controls'));
            },
            invalidHandler: function(event, validator) {
                jQuery("div.control-group.error").removeClass('error');
                jQuery('div.controls .error[name]').parents('div.control-group').addClass('error');
            },
            onfocusout: function(elem, event) {
                jQuery(elem).validate();
                $controlGroup = jQuery(elem).parents('div.control-group');
                if(jQuery(elem).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
            }
        });


    };

    return LAY;
}(Layanan || {}));