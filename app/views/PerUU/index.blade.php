@section('content')
<h2><span class="rulycon-pilcrow"></span> PERATURAN PERUNDANG-UNDANGAN</h2>

<div class="content-non-title">
  <legend>
    Informasi & Status Usulan
    <a class="btn btn-hukor pull-right" href="{{ URL::route('pengajuan_per_uu')}}">Tambah Baru</a>
  </legend>

  @include('flash')

  <div class="form-inline">
    <label for="select-status">Status</label>
    <select id="select-status">
      <option value="">Semua Status</option>
      <option value="1">Diproses</option>
      <option value="2">Ditunda</option>
      <option value="3">Ditolak</option>
      <option value="4">Buat Salinan</option>
      <option value="5">Penetapan</option>
    </select>
  </div>

  <table id="tbl-per-uu">
    <thead>
    <tr>
      <th>#</th>
      <th>Tgl Usulan</th>
      <th>Unit Kerja</th>
      <th>Jabatan</th>
      <th>Perihal</th>
      <th>Status</th>
      <th></th>
    </tr>
    </thead>
    <tbody></tbody>
  </table>
  @stop

  @section('scripts')
  @parent
  <script type="text/javascript">
    $(function(){
      $("#menu-peraturan-perundangan").addClass("active");

      $dataTable = $("#tbl-per-uu").dataTable({
        bServerSide: true,
        sAjaxSource: document.location.href,
        aoColumns: [
          {
            mData: "id",
            sWidth: "1%"
          },
          {
            mData: "tgl_usulan",
            sWidth: "10%",
            mRender: function(data) {
              return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
            }
          },
          {
            mData: "unit_kerja",
            sWidth: "10%"
          },
          {
            mData: "nama_jabatan",
            sWidth: "10%"
          },
          {
            mData: "perihal",
            sWidth: "30%"
          },
          {
            mData: "status",
            sWidth: "10%",
            mRender: function(data) {
              switch(parseInt(data)) {
                case 1:
                  return "Diproses";
                  break;
                case 2:
                  return "Ditunda";
                  break;
                case 3:
                  return "Ditolak";
                  break;
                case 4:
                  return "Buat salinan";
                  break;
                case 5:
                  return "Penetapan";
                  break;
                default:
                  return " ";
                  break;
              };
            }
          },
          {
            mData: 'id',
            sWidth: "8%",
            mRender: function(data, type, all) {
              return "<a href='/assets/uploads/"+all.lampiran+"'><i class='icon-download'></i></a> " +
                  "<a href='/per-uu/update/"+data+"'><i class='icon-edit'></i></a> " +
                  "<a class='delete' href='javascript:void(0)' data-id='"+data+"'><i class='icon-trash'></i></a>";
            }
          }
        ],
        fnServerParams: function(aoData) {
          aoData.push({name: "status", value: $("#select-status").val()});
        }
      });

      $dataTable.on('click', '.delete', function(){
        if(!confirm('Apakah anda yakin?'))
          return;

        var id = $(this).data('id');
        $.post('/per-uu/delete', {id: id}, function(){
          $dataTable.fnReloadAjax();
        });
      });

      $("#select-status").change(function(){
        $dataTable.fnReloadAjax();
      });

    });




  </script>
</div>

@stop