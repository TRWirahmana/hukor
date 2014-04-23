@section('news-content')
<div class="maincontent" id="detail-news">
    <div class="container" style="width: 960px;">
        <!-- News Feed -->
        <div class="row-fluid">
          <h3 class="section-title" id="search-result">Hasil pencarian</h3>
          <div id="search-result-lists">
            <p>Berikut adalah hasil pencarian untuk kata kunci <strong>Put keyword here</strong>.</p>
            <ul>
              <li>
                <h6><a href="#">Judul berita 01</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 02</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 03</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 04</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 05</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 06</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 07</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 08</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 09</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
              <li>
                <h6><a href="#">Judul berita 10</a></h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur cumque esse iusto modi molestias odit omnis quas rerum sapiente. Fugiat iusto laborum officiis, quasi recusandae unde ut velit vitae...</p>
              </li>
            </ul>
          </div>
        </div>
        <!--row-fluid-->
    </div>


</div>
<!--container-->
</div>
<!--maincontent-->
@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.simplePagination.js')}}"></script>
<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Pencarian Berita"
    });
</script>
@stop
@stop