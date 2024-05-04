const API_URL = 'https://sheetdb.io/api/v1/dbhfiy2nctub3';

async function fetchData() {
  try {
    const response = await fetch(API_URL);
    const data = await response.json();
    updateTable(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

function updateTable(data) {
  const table = document.getElementById("tugasTable");
  table.innerHTML = "<tr><th>No</th><th>Tugas</th><th>Status</th><th>Tanggal</th><th>Jawaban</th></tr>";

  data.forEach((item, index) => {
    let row = table.insertRow();
    let noCell = row.insertCell(0);
    let tugasCell = row.insertCell(1);
    let statusCell = row.insertCell(2);
    let tanggalCell = row.insertCell(3);
    let jawabanCell = row.insertCell(4);

    noCell.textContent = index + 1;
    tugasCell.textContent = item.Tugas;
    statusCell.textContent = item.Status;
    tanggalCell.textContent = item.Tanggal;

    if (item.Status === "Selesai") {
      statusCell.classList.add('status-selesai');
    } else {
      statusCell.classList.add('status-belum');
    }

    let viewButton = document.createElement('button');
    viewButton.textContent = "View";
    viewButton.classList.add('view-button');
    viewButton.onclick = () => {
      window.open(item.Jawaban, '_blank');
    };
    jawabanCell.appendChild(viewButton);
  });
}

fetchData();

function updateTable(data) {
  const table = document.getElementById("tugasTable");
  table.innerHTML = "<tr><th>No</th><th>Tugas</th><th>Status</th><th>Tanggal</th><th>Jawaban</th></tr>";

  data.reverse(); // Balik urutan data

  data.forEach((item, index) => {
    let row = table.insertRow();
    let noCell = row.insertCell(0);
    let tugasCell = row.insertCell(1);
    let statusCell = row.insertCell(2);
    let tanggalCell = row.insertCell(3);
    let jawabanCell = row.insertCell(4);

    noCell.textContent = index + 1;
    tugasCell.textContent = item.Tugas;
    statusCell.textContent = item.Status;
    tanggalCell.textContent = item.Tanggal;

    if (item.Status === "Selesai") {
      statusCell.classList.add('status-selesai');
    } else {
      statusCell.classList.add('status-belum');
    }

    let viewButton = document.createElement('button');
    viewButton.textContent = "View";
    viewButton.classList.add('view-button');
    viewButton.onclick = () => {
      window.open(item.Jawaban, '_blank');
    };
    jawabanCell.appendChild(viewButton);
  });
}
