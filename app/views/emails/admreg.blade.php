<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Selamat Datang di Sistem Registrasi Online Penyuluh Budaya</h2>
        <div>
        	Anda telah terdaftar sebagai Admin Rayon di <b>{{ $region->nama }}</b></b>.
            Gunakan username dan password dibawah ini untuk masuk kedalam sistem
            di http://kebudayaan.kemdikbud.go.id/penyuluh_budaya/public atau klik
            <a href="http://kebudayaan.kemdikbud.go.id/penyuluh_budaya/public">Registrasi Online Penyuluh Budaya</a>
            <h3>
                <b>Jadwal pendaftaran di sistem ini dimulai dari tanggal 8 Oktober 2013 sampai 19 Oktober 2013 (pukul 23.59 WIB)</b>
            </h3>

            <b>Username dan Password anda:</b>
        </div>

            <br />
	        <div>Username: {{ $username }}</div>
	        <div>Password: {{ $password }}</div>
            
    </body>
</html>