jQuery(document).ready(function(e){
    var dom = {
        $table_news: jQuery("#table_news")

    };
    dom.$table_news.dataTable({
        bServerSide: true,
        bProcessing: true,
        bPaginate: true,
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
                    return "<a href='"+baseUrl+"/admin/berita/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                        + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/berita/"+id+"'>"
                        + "<i class='icon-trash'></i></a>";
                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "filter", value: 1});
        },
        fnDrawCallback: function() {

//            dom.$table_news.fnSetColumnVis( 5,  role == 3 );
        }
    });

    dom.$table_news.on('click', '.btn_delete', function(e){
        if (confirm('Apakah anda yakin?')) {
            jQuery.ajax({
                url: jQuery(this).attr('href'),
                type: 'DELETE',
                success: function(response) {
                    dom.$table_news.fnReloadAjax();
                }
            });
        }
        e.preventDefault();
        return false;
    });


//    jQuery("#select_role").change(function(){
//        dom.$table_news.fnReloadAjax();
//    });

});