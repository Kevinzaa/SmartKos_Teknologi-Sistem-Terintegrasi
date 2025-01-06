const apiUrl = "http://localhost:8080/report";

async function fetchWithAuth(url, options = {}) {
    const token = localStorage.getItem('authToken');
    if (!options.headers) {
        options.headers = {};
    }
    options.headers['Authorization'] = `Bearer ${token}`;
    const response = await fetch(url, options);

    if (response.status === 401) {
        alert('Session expired. Please log in again.');
        showLoginPage();
    }

    return response;
}

document.getElementById('createForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    try {
        const response = await fetchWithAuth(`${apiUrl}/create`, {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        alert(result.message || "Failed to submit report.");
    } catch (error) {
        console.error(error);
        alert("An error occurred while submitting the report.");
    }
});

document.getElementById('viewReports').addEventListener('click', async () => {
    const response = await fetchWithAuth(apiUrl);
    const reports = await response.json();
    const list = document.getElementById('reportList');
    list.innerHTML = reports.map(report => `
        <div>
            <h3>${report.problem_type}</h3>
            <p><strong>Report ID :</strong> ${report.id}</p>
            <p><strong>Reported by :</strong> ${report.username}</p> <!-- Tampilkan username -->
            <p><strong>Description :</strong> ${report.description}</p>
            <p><strong>Room Location :</strong> ${report.room_location}</p>
            <p><strong>Status :</strong> ${report.status}</p>
            <img src="${report.photo_url}" alt="${report.problem_type}" style="width: 100%; max-width: 300px; margin-top: 10px;">
            <button onclick="deleteReport(${report.id})" class="delete-button">Delete</button>
        </div>
    `).join('');
});

async function deleteReport(id) {
    if (!confirm("Are you sure you want to delete this report?")) return;

    try {
        const response = await fetchWithAuth(`${apiUrl}/delete/${id}`, { method: 'DELETE' });
        const result = await response.json();
        alert(result.message || "Failed to delete report.");
        document.getElementById('viewReports').click();
    } catch (error) {
        console.error(error);
        alert("An error occurred while deleting the report.");
    }
}

document.getElementById('filterReports').addEventListener('click', async () => {
    const status = document.getElementById('statusFilter').value;

    try {
        const response = await fetchWithAuth(`${apiUrl}/status/${status}`);
        const result = await response.json();

        const list = document.getElementById('filteredReports');

        if (result.data.length === 0) {
            list.innerHTML = `
                <div class="no-report-message">
                    Tidak ada report dengan status: <strong>${status}</strong>
                </div>
            `;
            return;
        }

        list.innerHTML = result.data.map(report => `
            <div class="card">
                <h3>${report.problem_type}</h3>
                <p>${report.description}</p>
                <p><strong>Room Location:</strong> ${report.room_location}</p>
                <p><strong>Status:</strong> ${report.status}</p>
            </div>
        `).join('');
    } catch (error) {
        console.error("Error occurred:", error);
        alert("Terjadi kesalahan saat mengambil data.");
    }
});



document.getElementById('updateStatusForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const reportId = document.getElementById('reportId').value;
    const newStatus = document.getElementById('newStatus').value;

    try {
        const response = await fetchWithAuth(`${apiUrl}/updateStatus/${reportId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ status: newStatus }),
        });

        const result = await response.json();
        alert(result.message || "Failed to update status.");
    } catch (error) {
        console.error(error);
        alert("An error occurred while updating the report status.");
    }
});

document.getElementById('viewStats').addEventListener('click', async () => {
    const response = await fetchWithAuth(`${apiUrl}/stats`);
    const stats = await response.json();
    document.getElementById('stats').innerHTML = `
        <p><strong>Total Reports:</strong> ${stats.total_reports}</p>
        <p><strong>Pending:</strong> ${stats.pending}</p>
        <p><strong>In Process:</strong> ${stats.in_process}</p>
        <p><strong>Completed:</strong> ${stats.completed}</p>
    `;
});

document.getElementById('logoutButton').addEventListener('click', () => {
    localStorage.removeItem('authToken');
    alert('Logged out successfully.');
    window.location.href = '/register'; 
});
