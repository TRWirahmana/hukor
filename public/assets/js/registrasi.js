/*
 * File      : registrasi.js
 * Desc      : Object berisi fungsionalitas transaksi
 * Author    : tajhul.faijin@sangkuriang.co.id
 * Copyright : Sangkuriang
 */
var Registrasi = (function(REG) {

    REG.Index = function() {
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

    REG.Form = function() {

        tinymce.init({
            selector: "#konten_tulisan",
            plugins: '',
            toolbar: "undo redo | styleselect | bold italic | link image",
            height: 300
        });

        $("#status").change(function(e){
            if(parseInt($(this).val()) == 1) {
                $("#surat_ijin_keluarga_group").prop("disabled", false).show();
            } else {
                $("#surat_ijin_keluarga_group").prop("disabled", true).hide();
            }
        });

        $("#status").change();

        //jenis instansi logic
//        $("#jenis_instansi").change(function(e){
//            if(parseInt($(this).val()) == 1) {
//                $("#instansi").prop("disabled", false).show();
//                $("#kesatuan").prop("disabled", true).hide();
//            } else if(parseInt($(this).val()) == 2){
//                $("#kesatuan").prop("disabled", true).show();
//                $("#instansi").prop("disabled", false).hide();
//            } else {
//                $("#kesatuan").prop("disabled", true).hide();
//                $("#instansi").prop("disabled", true).hide();
//            }
//        });
//
//        if($("#kesatuan").val() != null){
//            var kesatuan = "Kesatuan";
//            $("#jenis_instansi option").filter(function() {
//                //may want to use $.trim in here
//                return $(this).text() == kesatuan;
//            }).prop('selected', true);
//
//            $("#instansi").prop("disabled", true).hide();
//            $("#kesatuan").prop("disabled", true).show();
//        }
//
//        if($("#instansi").val() != null){
//            var instansi = "Instansi";
//            $("#jenis_instansi option").filter(function() {
//                //may want to use $.trim in here
//                return $(this).text() == instansi;
//            }).prop('selected', true);
//
//            $("#instansi").prop("disabled", true).show();
//            $("#kesatuan").prop("disabled", true).hide();
//        }
//
//        $("#jenis_instansi").change();

        $("#umur").val(calculateAge());
        $("#tahun_lahir,#bulan_lahir,#tanggal_lahir").change(function(){
            $("#umur").val(calculateAge());
        });

        /*
         * Trigger Submit Form
         */
        $('button#submit').on('click', function() {
            var validator = $("#registrasi-form").validate();
            //inisialisasi untuk pencarian input, select dan textarea
            var $input = $("#registrasi-form").find("input, textarea");

            var count = 0;
            $input.each(function(){
                if($(this).hasClass('required')){   //hasClass untuk mendapatkan nama class yang di inginkan
                    if(!$(this).val()){     //cek value dari element yg memiliki class required
                        var text = 'Harus di isi.';

                        //object untuk msg error di jquery validation
                        msg = new Object();
                        msg[$(this).attr('name')] = text;
                        validator.showErrors(msg);
                        count++;
                    }
                }
        });

        //submit form apabila count = 0
        if(count == 0){
            $("#registrasi-form").submit();
        }
        });

        var rules = {
                'biodata[nama_lengkap]': 'required',
                'biodata[tempat_lahir]': 'required',
                'biodata[email]': {
                    required: true,
                    email: true
                },
                'biodata[alamat]': 'required',
                'biodata[provinsi_id]': 'required',
                'biodata[status_nikah]': 'required',
                'biodata[telepon]': {
                    required: true,
                    number: true
                },
                'biodata[hp]': {
                    required: true,
                    number: true
                },
                'biodata[no_ktp]': {
                    required: true,
                    number: true
                },
                'biodata[no_sim]': {
                    required: true,
                    number: true
                },
                'biodata[nama_ayah]': {
                    required: true
                },
                'biodata[nama_ibu]': {
                    required: true
                },
                'biodata[pekerjaan_ayah]': {
                required: true
                },
                'biodata[pekerjaan_ibu]': {
                    required: true
                },
                'kesehatan[riwayat_penyakit]': {
                    required: true
                },
                'foto': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },
                'ijazah_terakhir': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },
                'transkrip_nilai': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },  
                'ktp': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },  
                'lamaran': {
                    required: true,
                    extension: 'pdf',
                    filesize: 524288
                },  
                'cv': {
                    required: true,
                    extension: 'pdf',
                    filesize: 524288
                },  
                'ket_sehat': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },  
                'ket_bebas_narkoba': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },  
                'ket_catatan_kepolisian': {
                    required: true,
                    extension: 'png|jpe?g',
                    filesize: 524288
                },
                'surat_ijin_keluarga': {
                    required: function(e) {
                        return (parseInt($("#status").val()) == 1);
                    },
                    extension: 'jpe?g|png',
                    filesize: 524288
                },
                'pendidikan[sma]': 'required',
                'pendidikan[sma_tahun]': 'required',
                'pendidikan[prasarjana_universitas]': 'required',
                'pendidikan[prasarjana_jurusan]': 'required',
                'pendidikan[prasarjana_tahun]': 'required',
                'pendidikan[ipk_terakhir]': {
                    required: true,
                    number: true,
                    max: 4
                }
            };

        if($("#lampiran_foto").length != 0) rules.foto.required = false;
        if($("#lampiran_ijazah").length != 0) rules.ijazah_terakhir.required = false;
        if($("#lampiran_transkrip").length != 0) rules.transkrip_nilai.required = false;
        if($("#lampiran_ktp").length != 0) rules.ktp.required = false;
        if($("#lampiran_lamaran").length != 0) rules.lamaran.required = false;
        if($("#lampiran_cv").length != 0) rules.cv.required = false;
        if($("#lampiran_ket_sehat").length != 0) rules.ket_sehat.required = false;
        if($("#lampiran_ket_bebas_narkoba").length != 0) rules.ket_bebas_narkoba.required = false;
        if($("#lampiran_skck").length != 0) rules.ket_catatan_kepolisian.required = false;
        if($("#lampiran_sik").length != 0) rules.surat_ijin_keluarga.required = false;

        $("#registrasi-form").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'help-block error',
            rules: rules,
            messages: {
                'biodata[nama_lengkap]': 'Nama lengkap wajib diisi.',
                'biodata[tempat_lahir]': 'Tempat lahir wajib diisi.',
                'biodata[email]': {
                    required: 'Alamat E-Mail wajib diisi.',
                    email: 'Format email tidak benar'
                },
                'biodata[alamat]': "Alamat lengkap wajib diisi.",
                'biodata[provinsi_id]': 'Silahkan tentukan provinsi tempat anda mendaftar.',
                'biodata[status_nikah]': 'Pilih status nikah.',
                'biodata[telepon]': {
                    required: 'Nomor telepon wajib diisi.'
                },
                'biodata[hp]': {
                    required: 'Nomor handphone wajib diisi.'
                },
                'biodata[no_ktp]': {
                    required: 'Nomor kartu tanda penduduk (KTP) wajib diisi.'
                },
                'biodata[no_sim]': {
                    required: 'Nomor SIM C wajib diisi.'
                },
                'biodata[nama_ayah]': {
                    required: 'Nama Ayah tidak boleh kosong.'
                },
                'biodata[nama_ibu]': {
                    required: 'Nama Ibu tidak boleh kosong.'
                },
                'biodata[pekerjaan_ayah]': {
                    required: 'Pekerjaan Ayah tidak boleh kosong.'
                },
                'biodata[pekerjaan_ibu]': {
                    required: 'Pekerjaan Ibu tidak boleh kosong.'
                },
                'kesehatan[riwayat_penyakit]': {
                    required: 'Riwayat Penyakit tidak boleh kosong.',
                },
                'foto': {
                    required: 'Wajib melampirkan berkas foto.',
                    extension: 'Berkas harus berupa png atau jpg.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },
                'ijazah_terakhir': {
                    required: 'Wajib melampirkan berkas ijazah terakhir.',
                    extension: 'Berkas harus berupa png atau jpg.',
                    filesize: 'Ukuran berkas maksima 512 kilobytes.'
                },
                'transkrip_nilai': {
                    required: 'Wajib melampirkan berkas transkrip nilai.',
                    extension: 'Berkas harus berupa png atau jpg.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },
                'ktp': {
                    required: "Wajib melampirkan kartu tanda penduduk (KTP).",
                    extension: 'Berkas harus berupa jpg atau png.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },  
                'lamaran': {
                    required: "Wajib melampirkan surat lamaran.",
                    extension: 'Berkas harus berupa pdf.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },  
                'cv': {
                    required: "Wajib melampirkan Curiculum Vitae (CV).",
                    extension: 'Berkas harus berupa pdf.',
                    filesize: "Ukuran berkas maksimal 512 kilobytes."
                },  
                'ket_sehat': {
                    required: "Wajib melampirkan surat keterangan sehat.",
                    extension: 'Berkas harus berupa jpg atau png.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },  
                'ket_bebas_narkoba': {
                    required: 'Wajib melampirkan surat keterangan bebas narkoba.',
                    extension: 'Berkas harus berupa jpg atau png.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },  
                'ket_catatan_kepolisian': {
                    required: 'Wajib melampirkan surat keterangan catatan kepolisian.',
                    extension: 'Berkas harus berupa jpg atau png.',
                    filesize: 'Ukuran berkas maksimal 512 kilobytes.'
                },  
                'surat_ijin_keluarga': {
                    required: 'Wajib melampirkan surat ijin dari keluarga untuk yang sudah menikah.',
                    extension: 'Berkas harus berupa jpg atau png.',
                    filesize: 'Ukuran berkas maksima 512 kilobyes.'
                },
                'pendidikan[ipk_terakhir]': {
                    required: 'Wajib mencantumkan Nilai IPK terakhir anda.',
                    number: 'Nilai IPK terakhir berupa angka.',
                    max: 'Nilai IPK maksimal adalah 4.'
                },
                'pendidikan[sma]': 'Nama sekolah SMA wajib diisi.',
                'pendidikan[sma_tahun]': 'Tentukan tahun kelulusan SMA anda.',
                'pendidikan[prasarjana_universitas]': 'Nama universitas wajib diisi.',
                'pendidikan[prasarjana_jurusan]': 'Nama jurusan di universitas tersebut wajib diisi.',
                'pendidikan[prasarjana_tahun]': 'Tahun lulus dari universitas tersebut wajib diisi.'
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

        $("#registrasi-form input[type='file']").change(function(e){
            $(this).validate();
                $controlGroup = $(this).parents('div.control-group');
                if($(this).valid())
                    $controlGroup.removeClass('error');
                else
                    $controlGroup.addClass('error');
        })

        /*
         * Add Karir
         */
        $('#add-karir').on('click', function() {
            var $this = $(this);
            $this.prev('.block-karir').clone().insertBefore($this);
            ReIndexKarir();

            $parent = $("#karir");
                // Cleare textbox
            $parent.find('.perusahaan:last').val('');
            $parent.find('.jabatan:last').val('');
            $parent.find('.uraian_singkat:last').val('');
            $parent.find('.karir_bulan_awal:last').val('');
            $parent.find('.karir_tahun_awal:last').val('');
            $parent.find('.karir_bulan_akhir:last').val('');
            $parent.find('.karir_tahun_akhir:last').val('');
        });
        /*
         * Add Organisasi
         */
        $('#add-organisasi').on('click', function() {
            var $this = $(this);
            $this.prev('.block-organisasi').clone().insertBefore($this);
            ReIndexOrganisasi();

            var $parent = $('#pengalaman-organisasi');
             // Cleare textbox
            $parent.find('.org_organisasi:last').val('');
            $parent.find('.org_jabatan:last').val('');
            $parent.find('.org_uraian_singkat:last').val('');
            $parent.find('.org_karir_bulan_awal:last').val('');
            $parent.find('.org_karir_tahun_awal:last').val('');
            $parent.find('.org_karir_bulan_akhir:last').val('');
            $parent.find('.org_karir_tahun_akhir:last').val('');
        });
        /*
         * Add Organisasi
         */
        $('#add-prestasi').on('click', function() {
            var $this = $(this);
            $this.prev('.block-prestasi').clone().insertBefore($this);
            ReIndexPrestasi();

            var $parent = $("#prestasi");

            $parent.find('.nama_prestasi:last').val('');
            $parent.find('.tahun_prestasi:last').val('');
        });

        /*
         * Add Anak
         */
        $('#add-anak').on('click', function() {
            var $this = $(this);
            $this.prev('.block-anak').clone().insertBefore($this);
            ReIndexAnak();

            $parent = $("#keluarga");
            // Cleare textbox
            $parent.find('.anak:last').val('');
        });

        $(document).on('click', '.delete_karir', function(){
            if($("#karir .block-karir").length == 1) {
                $parent = $("#karir");
                // Cleare textbox
                $parent.find('.perusahaan:last').val('');
                $parent.find('.jabatan:last').val('');
                $parent.find('.uraian_singkat:last').val('');
                $parent.find('.karir_bulan_awal').val('');
                $parent.find('.karir_tahun_awal').val('');
                $parent.find('.karir_bulan_akhir').val('');
                $parent.find('.karir_tahun_akhir').val('');

                return;
            }

            $(this).parents('.block-karir').remove();
            ReIndexKarir();
        });

        $(document).on('click', '.delete_organisasi', function(){
            if($("#pengalaman-organisasi .block-organisasi").length == 1) {
                var $parent = $('#pengalaman-organisasi');
                // Cleare textbox
                $parent.find('.org_organisasi').val('');
                $parent.find('.org_jabatan').val('');
                $parent.find('.org_uraian_singkat').val('');
                $parent.find('.org_karir_bulan_awal').val('');
                $parent.find('.org_karir_tahun_awal').val('');
                $parent.find('.org_karir_bulan_akhir').val('');
                $parent.find('.org_karir_tahun_akhir').val('');

                return;
            }

            $(this).parents('.block-organisasi').remove();
            ReIndexOrganisasi();
        });

         $(document).on('click', '.delete_prestasi', function(){
            if($("#prestasi .block-prestasi").length == 1) {
                var $parent = $('#prestasi');
                // Cleare textbox
                $parent.find('.nama_prestasi:last').val('');
                $parent.find('.tahun_prestasi:last').val(''); 

                return;
            }

            $(this).parents('.block-prestasi').remove();
            ReIndexPrestasi();
        });

        $(document).on('click', '.delete_anak', function(){
            if($("#keluarga .block-anak").length == 1) {
                var $parent = $('#keluarga');
                // Cleare textbox
                $parent.find('.anak:last').val('');

                return;
            }

            $(this).parents('.block-anak').remove();
            ReIndexAnak();
        });


        /*
         * Re Index Dom Karir
         */
        function ReIndexKarir() {
            var $parent = $('#karir');
            $parent.find('.block-karir').each(function(i) {
                var $this = $(this);
                $this.find('.label-subject').html('Karir/Riwayat pekerjaan (' + (i + 1) + ') <a class="delete_karir">Hapus</a>');
                $this.find('.perusahaan').attr('name', 'karir[' + i + '][perusahaan]');
                $this.find('.jabatan').attr('name', 'karir[' + i + '][jabatan]');
                $this.find('.uraian_singkat').attr('name', 'karir[' + i + '][uraian_singkat]');
                $this.find('.karir_bulan_awal').attr('name', 'karir[' + i + '][bulan_awal]');
                $this.find('.karir_tahun_awal').attr('name', 'karir[' + i + '][tahun_awal]');
                $this.find('.karir_bulan_akhir').attr('name', 'karir[' + i + '][bulan_akhir]');
                $this.find('.karir_tahun_akhir').attr('name', 'karir[' + i + '][tahun_akhir]');
            });

        }
        /*
         * Re Index Dom Organisasi
         */
        function ReIndexOrganisasi() {
            var $parent = $('#pengalaman-organisasi');
            $parent.find('.block-organisasi').each(function(i) {
                var $this = $(this);
                $this.find('.label-subject').html('Pengalaman organisasi (' + (i + 1) + ') <a class="delete_organisasi">Hapus</a>');
                $this.find('.org_organisasi').attr('name', 'organisasi[' + i + '][organisasi]');
                $this.find('.org_jabatan').attr('name', 'organisasi[' + i + '][jabatan]');
                $this.find('.org_uraian_singkat').attr('name', 'organisasi[' + i + '][uraian_singkat]');
                $this.find('.org_karir_bulan_awal').attr('name', 'organisasi[' + i + '][bulan_awal]');
                $this.find('.org_karir_tahun_awal').attr('name', 'organisasi[' + i + '][tahun_awal]');
                $this.find('.org_karir_bulan_akhir').attr('name', 'organisasi[' + i + '][bulan_akhir]');
                $this.find('.org_karir_tahun_akhir').attr('name', 'organisasi[' + i + '][tahun_akhir]');
            });
        }
        /*
         * Re Index Dom Prestasi
         */
        function ReIndexPrestasi() {
            var $parent = $('#prestasi');
            $parent.find('.block-prestasi').each(function(i) {
                var $this = $(this);
                $this.find('.label-subject').html('Prestasi (' + (i + 1) + ') <a class="delete_prestasi">Hapus</a>');
                $this.find('.nama_prestasi').attr('name', 'prestasi[' + i + '][nama_prestasi]');
                $this.find('.tahun_prestasi').attr('name', 'prestasi[' + i + '][periode]');
            });

        }

        /*
         * Re Index Dom Anak
         */
        function ReIndexAnak() {
            var $parent = $('#keluarga');
            $parent.find('.block-anak').each(function(i) {
                var $this = $(this);
                $this.find('.label-subject').html('Anak (' + (i + 1) + ') <a class="delete_anak">Hapus</a>');
                $this.find('.anak').attr('name', 'keluarga[' + i + '][nama_anak]');
            });

        }

        // fungsi untuk menggenare umur.
        function calculateAge() {
            var tahun = $("#tahun_lahir").val();
            var bulan = $("#bulan_lahir").val();
            var tgl = $("#tanggal_lahir").val();

            if("" == tahun || "" == bulan || "" == tgl)
                return "";

            var today = new Date();
            var birthDate = new Date(tahun, bulan - 1, tgl);
            console.log(birthDate);

            var age = today.getFullYear() - birthDate.getFullYear();
            var hasBirthday = (today.getMonth() > birthDate.getMonth()) 
                || ((today.getMonth() == birthDate.getMonth()) && today.getDate() >= birthDate.getDate());

            if(hasBirthday)
                return age;
            else
                return --age;
        }


    };

    return REG;
}(Registrasi || {}));