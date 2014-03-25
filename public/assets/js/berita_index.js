jQuery(document).ready(function(e){
    var dom = {
        $table_news: jQuery("#table_news")

    };
    dom.$table_news.dataTable({
        bServerSide: true,
        bProcessing: true,
        bPaginate: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Berita",
            "sEmptyTable": "Data Kosong",
            "sZeroRecords" : "Pencarian Tidak Ditemukan",
            "sSearch":       "Cari:",
            "sLengthMenu": 'Tampilkan <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '</select> Berita'
        },
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "judul"
            },
            {
                mData: "nama_kategori"
            },
            {
                mData: "tgl_penulisan"
            },
            {
                mData: "id",
                mRender: function(id) {
                    if(role == 3){
                        return "<a href='"+baseUrl+"/admin/berita/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                            + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/berita/"+id+"'>"
                            + "<i class='icon-trash'></i></a>";
                    }else{
                        return null;
                    }

                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "filter", value: 1});
        },
        fnDrawCallback: function() {
//            var role = '<?php echo Auth::user()->role_id; ?>' ;
//            dom.$table_news.fnSetColumnVis( 2,  role == 3 );
        }
    });

    dom.$table_news.on('click', '.btn_delete', function(e){
        if (confirm('Apakah anda yakin menghapus berita?')) {
            jQuery.post(jQuery(this).attr('href'), {_method: 'delete'}, function(r){
                dom.$table_news.fnReloadAjax();
            });
        }
        e.preventDefault();
        return false;
    });


//    jQuery("#select_role").change(function(){
//        dom.$table_news.fnReloadAjax();
//    });

});