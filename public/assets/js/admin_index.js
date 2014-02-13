jQuery(document).ready(function(e){
    var dom = {
        $table_admin: jQuery("#table_admin"),
        $select_role: jQuery("#select_role")

    };
    dom.$table_admin.dataTable({
        bServerSide: true,
        bFilter:false,
        sAjaxSource: document.URL,
        aoColumns: [
            {
                mData: "pengguna.nama_lengkap"
            },
            {
                mData: "pengguna.email"
            }
            ,
            {
                mData: "role_id",
                mRender: function(role_id) {
                    switch(role_id){
                        case 1 :
                            return "Kepala Biro";
                        break;
                        case 2 :
                            return "Pengguna";
                            break;
                        case 3 :
                            return "Super Admin";
                            break;
                        case 4 :
                            return "Kepala Bagian";
                            break;
                        case 5 :
                            return "Kepala Sub Bagian";
                            break;
                        case 6 :
                            return "Admin Peraturan Perundang-Undangan";
                            break;
                        case 7 :
                            return "Admin Pelembagaan";
                            break;
                        case 8 :
                            return "Admin Bantuan Hukum";
                            break;
                        case 9 :
                            return "Admin Ketatalaksanaan";
                            break;
                    }

                }
            },
            {
                mData: "id",
                mRender: function(id) {
                    return "<a href='"+baseUrl+"/admin/account/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                        + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/admin/account/"+id+"'>"
                        + "<i class='icon-trash'></i></a>";
                }
            }
        ],
        fnServerParams: function(aoData){
            aoData.push({name: "role_id", value: dom.$select_role.val()});
        },
        fnDrawCallback: function() {

            dom.$table_admin.fnSetColumnVis( 3,  (dom.$select_role.val() == 0 || dom.$select_role.val() == 3 || dom.$select_role.val() == 2));
        }
    });

    dom.$table_admin.on('click', '.btn_delete', function(e){
        if (confirm('Apakah anda yakin?')) {
            jQuery.ajax({
                url: jQuery(this).attr('href'),
                type: 'DELETE',
                success: function(response) {
                    dom.$table_admin.fnReloadAjax();
                }
            });
        }
        e.preventDefault();
        return false;
    });


    jQuery("#select_role").change(function(){
        dom.$table_admin.fnReloadAjax();
    });

});