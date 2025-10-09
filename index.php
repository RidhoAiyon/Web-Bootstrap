<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Soto Bude Tri - Lampung Tengah</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="stylesheet.css">

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="img/soto.jpg" alt="Logo" style="width: 50px;" class="rounded-circle">
        <span class="fw-bold site-title ms-2">SOTO BUDE TRI</span>
      </a>
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#grafik">Grafik</a></li>
          <li class="nav-item"><a class="nav-link" href="#lokasi">Lokasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero d-flex align-items-center position-relative">
    <video autoplay muted loop playsinline class="video-bg">
      <source src="img/soto.mp4" type="video/mp4">
    </video>

    <div class="container text-white position-relative text-center">
      <h1><span class="super">Selamat Datang di</span> Soto Bude Tri!</h1>
      <p class="lead">Rasakan kehangatan kuah bening khas Soto Bude Tri, racikan asli Lampung Tengah.</p>
      <p class="btn btn-warning btn-lg">Pesan Sekarang!!!</p>
    </div>
  </section>

  <!-- Tentang Kami -->
<section id="tentang" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center g-5">
      <!-- Gambar Warung Soto -->
      <div class="col-md-6 text-center">
        <img src="img/warung soto.jpg" alt="Warung Soto Bude Tri" class="img-fluid rounded-4 shadow-lg tentang-img">
      </div>

      <!-- Teks Tentang -->
      <div class="col-md-6">
        <h2 class="fw-bold mb-3 text-warning">Tentang Soto Bude Tri</h2>
        <p class="text-muted fs-5">
          Soto Bude Tri adalah warung soto legendaris di Lampung Tengah yang sudah melayani pelanggan
          sejak tahun 2008. Kami menyajikan soto khas Jawa Timur dengan kuah gurih, suwiran ayam lembut,
          dan sambal yang menggugah selera.
        </p>
        <p class="text-muted fs-5">
          Kami percaya bahwa rasa autentik dan pelayanan ramah adalah kunci untuk mempertahankan pelanggan setia.
          Dengan bahan segar dan resep turun-temurun, Soto Bude Tri terus menjadi pilihan utama pecinta kuliner tradisional.
        </p>
      </div>
    </div>
  </div>
</section>

  <!-- Menu -->
<section id="menu" class="how py-5 text-center">
  <div class="container">
    <h2 class="fw-bold display-5 mb-5">Menu :</h2>

    <!-- Menu Makanan -->
    <div class="row mt-4">

          <?php
        include("koneksi.php");

            $sql = "SELECT gambar, judul, harga FROM menu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4"> <div class="card shadow-sm p-3">';
                echo "<div>";
                echo "<img src='img/" . $row['gambar'] . "' width='350'><br>";
                echo "<strong>" . $row['judul'] . "</strong><br>";
                echo $row['harga'] . "<br><br>";
                echo "</div>";
                echo '</div></div>';
                         }
            } else {
                echo "Belum ada menu yang ditambahkan.";
                    }

        $conn->close();
            ?>
      </div>
    </div>
  </div>
</section>

  <!-- Grafik Penjualan -->
<section id="grafik" class="py-5">
  <div class="container">
    <h2 class="fw-bold text-center mb-4">Grafik Penjualan Soto Bude Tri</h2>
    <p class="mb-5 text-muted text-center">Data penjualan bulanan selama tahun 2025</p>
    
    <div class="row align-items-center g-4">
      <!-- Grafik -->
      <div class="col-md-7">
        <div class="chart-container mx-auto shadow-lg rounded-4 p-4 bg-white">
          <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
      </div>

      <!-- Keterangan -->
      <div class="col-md-5">
        <div class="chart-info text-start p-3 bg-light rounded-4 shadow-sm">
          <h4 class="fw-bold mb-3 text-warning">Keterangan Grafik:</h4>
          <div id="info-dinamis">
            <p class="text-muted">Memuat data penjualan...</p>
          </div>
          <p class="text-secondary fst-italic mt-3">
            Data ini membantu pemilik warung memantau tren penjualan dan menentukan stok bahan baku dengan lebih efisien.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script Grafik Dinamis -->
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(255, 206, 86, 0.9)');
gradient.addColorStop(1, 'rgba(255, 239, 186, 0.3)');

let chart; // variabel global untuk chart

// Fungsi untuk memuat data dari PHP (tanpa reload)
async function loadData() {
  const response = await fetch('get_grafik.php');
  const data = await response.json();

  const labels = data.map(item => item.bulan);
  const values = data.map(item => item.jumlah);

  // Buat atau perbarui grafik
  if (chart) {
    chart.data.labels = labels;
    chart.data.datasets[0].data = values;
    chart.update();
  } else {
    chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Penjualan (Porsi)',
          data: values,
          backgroundColor: gradient,
          borderColor: '#d6a800',
          borderWidth: 2,
          borderRadius: 8,
          hoverBackgroundColor: '#ffcd38'
        }]
      },
      options: {
        scales: {
          y: { beginAtZero: true },
          x: { grid: { display: false } }
        },
        plugins: {
          legend: { display: true, position: 'top' }
        }
      }
    });
  }

  // 🔥 Update Keterangan Grafik berdasarkan data terbaru
  updateInfo(data);
}

// Fungsi untuk menampilkan keterangan dinamis
function updateInfo(data) {
  const infoDiv = document.getElementById('info-dinamis');
  if (data.length === 0) {
    infoDiv.innerHTML = "<p class='text-danger'>Tidak ada data grafik!</p>";
    return;
  }

  // Hitung bulan tertinggi & terendah
  const maxData = data.reduce((max, item) => item.jumlah > max.jumlah ? item : max);
  const minData = data.reduce((min, item) => item.jumlah < min.jumlah ? item : min);

  // Buat daftar semua bulan
  let list = "<ul class='text-muted'>";
  data.forEach(item => {
    list += `<li><strong>${item.bulan}:</strong> ${item.jumlah} porsi</li>`;
  });
  list += "</ul>";

  // Tampilkan hasil
  infoDiv.innerHTML = `
    <p class="text-muted">Berikut adalah jumlah penjualan tiap bulan:</p>
    ${list}
    <p><strong>Bulan tertinggi:</strong> ${maxData.bulan} (${maxData.jumlah} porsi)</p>
    <p><strong>Bulan terendah:</strong> ${minData.bulan} (${minData.jumlah} porsi)</p>
  `;
}

// Jalankan pertama kali
loadData();

// 🔁 Perbarui otomatis setiap 3 detik
setInterval(loadData, 3000);
</script>



<!-- Script Chart dari Database -->
<?php
include("koneksi.php");

$dataBulan = [];
$dataJumlah = [];

$query = mysqli_query($conn, "SELECT * FROM grafik ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($query)) {
  $dataBulan[] = ucfirst($row['bulan']);
  $dataJumlah[] = (int)$row['jumlah'];
}
?>

<!-- Script Grafik Dinamis -->
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(255, 206, 86, 0.9)');
gradient.addColorStop(1, 'rgba(255, 239, 186, 0.3)');

let chart; // variabel global untuk chart

// Fungsi untuk memuat data dari PHP (tanpa reload)
async function loadData() {
  const response = await fetch('get_grafik.php');
  const data = await response.json();

  const labels = data.map(item => item.bulan);
  const values = data.map(item => item.jumlah);

  if (chart) {
    // Jika chart sudah ada, perbarui datanya
    chart.data.labels = labels;
    chart.data.datasets[0].data = values;
    chart.update();
  } else {
    // Jika chart belum ada, buat chart baru
    chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Penjualan (Porsi)',
          data: values,
          backgroundColor: gradient,
          borderColor: '#d6a800',
          borderWidth: 2,
          borderRadius: 8,
          hoverBackgroundColor: '#ffcd38'
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(200,200,200,0.2)' },
            ticks: { color: '#555', font: { size: 14 } }
          },
          x: {
            grid: { display: false },
            ticks: { color: '#555', font: { size: 14 } }
          }
        },
        plugins: {
          legend: { display: true, position: 'top', labels: { color: '#333', font: { size: 15 } } },
          tooltip: {
            backgroundColor: '#ffcd38',
            titleColor: '#000',
            bodyColor: '#000',
            borderWidth: 1,
            borderColor: '#fff'
          }
        },
        animation: {
          duration: 1200,
          easing: 'easeOutQuart'
        }
      }
    });
  }
}

// Muat data pertama kali
loadData();

// Perbarui grafik otomatis setiap 2 detik
setInterval(loadData, 2000);
</script>


  <section id="lokasi" class="py-5">
    <div class="container">
      <h2 class="fw-bold text-center mb-4">Lokasi Kami</h2>
      <div class="row g-4 align-items-center">
        <div class="col-md-7">
          <div class="map-container shadow-sm">
            <iframe
              src="https://www.google.com/maps/embed?pb=!3m2!1sen!2sid!4v1759471045970!5m2!1sen!2sid!6m8!1m7!1s6saHwvP8S3qkGhwezrHL4Q!2m2!1d-4.905304340259407!2d105.2117091834391!3f265.58645454130556!4f-2.930065227547658!5f0.4000000000000002"
              width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card lokasi-card shadow-sm p-4">
            <h4>Soto Seger Bude Tri</h4>
            <p>Jl. Lintas Sumatra</p>
            <p><strong>Jam Buka:</strong><br> 08:00 - 17.00 WIB<br>Jum'at tutup</p>
            <a href="https://maps.app.goo.gl/HRHC5MAW6XXGiwMA9" target="_blank" class="btn btn-dark mt-2">
              Buka di Google Maps
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold mb-4">Kontak Kami</h2>
      <p><strong>Telp/WA:</strong> 0812-3456-7890</p>
      <p><strong>Instagram:</strong> @sotosegerbudetri</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© 2025 Soto Bude Tri | Lampung Tengah</p>
  </footer>
</body>
</html>
