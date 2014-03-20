jQuery(document).ready(function(e){
    var dom = {
        $table_news: jQuery("#table_layanan")

    };
    dom.$table_news.dataTable({
        bServerSide: true,
        bFilter:false,
        bProcessing: true,
        bPaginate: true,
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "nama_menu",
                mRender: function(data, type, row){
                    switch (row['id'])
                    {
                        case 1:
                            return "Informasi Perundang-undangan";
                            break;
                        case 2:
                            return "Informasi Pelembagaan";
                            break;
                        case 3:
                            return "Informasi Bantuan Hukum";
                            break;
                        case 4:
                            return "Informasi Sistem dan Prosedur";
                            break;
                        case 5:
                            return "Informasi Analisis Jabatan";
                            break;
                        default:
                            return row['nama_menu'];
                            break;
                    }
                }
            },
            {
                mData: "nama_submenu"
            },
            {
                mData: "id",
                mRender: function(id) {
                    switch (id)
                    {
                        case 1:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            break;
                        case 2:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            break;
                        case 3:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            break;
                        case 4:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            break;
                        case 5:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            break;
                        default:
                            return "<a href='"+baseUrl+"/admin/layanan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                                + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/layanan/"+id+"'>"
                                + "<i class='icon-trash'></i></a>";
                            break;
                    }

                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "filter", value: 1});
        },
        fnDrawCallback: function() {

//            dom.$table_news.fnSetColumnVis( 3,  (dom.$select_role.val() == 0 || dom.$select_role.val() == 3 || dom.$select_role.val() == 2));
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