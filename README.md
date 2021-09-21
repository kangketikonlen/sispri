<p align="center">
 <br />
 <samp>
  <b><a rel="nofollow noopener noreferrer" target="_blank" href="https://github.com/kangketikonlen/siskamlingci">🗿 SISKAMLINGCI 🗿</a></b>
  <br />
  Template awal pembuatan project menggunakan framework Codeigniter<br />
  Sebuah Sistem Keamanan Lingkungan Codeigniter, supaya ngoding tetap ceria dan berada di jalan yang benar
 </samp>
 <br />
 <img src="https://raw.githubusercontent.com/kangketikonlen/kangketikonlen/main/assets/watollie.gif" width="200"/><br />
 <img src="https://img.shields.io/github/last-commit/kangketikonlen/siskamlingci?style=flat-square" /><br />
</p>

<samp>
  <p align="center">
    <b>Requirements</b><br />
    PHP <b>^7.4</b> | Apache <b>^2.4</b> | MariaDB <b>^10.5</b> | Composer <b>^2.0</b>
  </p>
  <hr />
  
  <h2>⏱ Instalasi</h2>
  <ol>
    <li>Unduh atau clone repositori ini ke dalam webroot server</li>
    <li>Install dependensi <code>composer install</code></li>
    <li>Duplikat file <code>.env.example</code> kemudian ubah nama file duplikat tersebut dengan nama <code>.env</code></li>
    <li>Buat folder <b>development</b> di dalam <b>./application/config/</b></li>
    <li>Kemudian copy file <b>config.php</b> dan <b>database.php</b> dari dalam folder <b>./application/config/production</b></li>
    <li>Buka file <b>./application/config/development/config.php</b> kemudian ubah baris di bawah ini: <br /> <p align="center"><code>$config['base_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/';</code><br /> menjadi <br /> <code>$config['base_url'] = 'http://' . $_SERVER['HTTP_HOST'] . '/siskamlingci/';</code></p>
    </li>
    <li>Selanjutnya, buka file <b>./application/config/development/database.php</b> kemudian ubah <code>hostname</code>, <code>username</code>, <code>password</code> dan <code>database</code> sesuai dengan lingkungan server development anda</li>
    <li>Terakhir, import database pada folder <b>./application/siskamlingci.sql</b> kedalam database anda</b>
  </ol>
  <hr />
  
  <h2>🧭 Cara Penggunaan</h2>
  <ol>
    <li>Login menggunakan akun default, <br /><code>echo "dXNlcm5hbWU6IHN1cHBvcnQgfCBwYXNzd29yZDogb2xkZXI0NS4sCg===" | base64 --decode</code></li>
    <li>Ubah informasi aplikasi pada menu Sistem > Informasi Aplikasi</li>
    <li>Input data instansi yang akan digunakan pada production. Sistem akan otomatis mencari dan menyesuaikan data instansi berdasarkan <b>Url Sistem</b>. <br />Note: <i>Url sistem harus menggunakan <code>https://</code> atau <code>http://</code>, contoh; <code>https://siskamlingci.kangketik.web.id</code></i>
    <li>Buat daftar fitur dan subfitur sesuai project. Sistem akan otomatis membuatkan template yang bisa anda edit secara manual</li>
	<li>Untuk menambahkan modul pada landing page, silahkan input pada menu Level > Daftar Level. Pada tipe halaman jika anda memilih Landing, maka ketika user login, user akan di arahkan pada halaman landing untuk memilih modul. Sebaliknya, jika memilih dashboard maka user tidak akan di hadapkan pada pemilihan modul.
	<li>Supaya user mendapatkan fitur atau modul yang di inginkan, maka silahkan setting fitur apa saja yang bisa di lihat oleh user pada menu Sistem > Hak Akses Modul dan Hak Akses Fitur.
  </ol>
  <hr />

  <h2>🤝 Kontribusi</h2>
  Pull Request sangat disambut, untuk perubahan besar silahkan open issue terlebih dahulu untuk mendiskusikan apa yang ingin anda ubah. Dan tentunya, pastikan untuk melakukan test terlebih dahulu.
  <hr />

  <p align="center">
  	&copy;Images are belongs to <b><a href="https://www.hololive.tv/" target="_blank">Hololive</a></b><br />
	Special thanks to <b><a rel="nofollow noopener noreferrer" href="https://github.com/fathtech">Fathtech Developer</a></b>
  </p>
</samp>