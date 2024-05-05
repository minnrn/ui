fetch('https://minnzz.my.id/ip/iploc.js')
  .then(response => {
    if (!response.ok) {
      throw new Error('Ada masalah dengan permintaan.');
    }
    return response.json();
  })
  .then(data => {
    // Lakukan sesuatu dengan data yang diterima, misalnya menampilkan pesan di halaman HTML
    console.log(data);
  })
  .catch(error => {
    console.error('Ada kesalahan:', error);
  });