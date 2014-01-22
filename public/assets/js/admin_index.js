$(document).ready(function(e){

	var dom = {
		$table_admin: $("#table_admin"),
		$select_role: $("#select_role"),

	};


	dom.$table_admin.dataTable({
		sDom: 'tipr',
		bProcessing: true,
		bServerSide: true,
		bSort: false,
		sAjaxSource: document.URL,
		aoColumns: [
			{
				mData: "nama_lengkap"
			},
			{
				mData: "registrasi.username"
			},
			{
				mData: "registrasi.email"
			},
			{
				mData: "bpnb_id",
				mRender: function(data, type, full) {
					if(data == null)
						return "";
					else
						return full.bpnb.nama;
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
		
			dom.$table_admin.fnSetColumnVis( 3,  (dom.$select_role.val() == 3));
		}
	});

	dom.$table_admin.on('click', '.btn_delete', function(e){
		if (confirm('Apakah anda yakin?')) {
			$.ajax({
				url: $(this).attr('href'),
				type: 'DELETE',
				success: function(response) {
					dom.$table_admin.fnReloadAjax();
				}
			});
		}
		e.preventDefault();
		return false;
	});


	dom.$select_role.change(function(e){
		dom.$table_admin.fnReloadAjax();
	});
		




});