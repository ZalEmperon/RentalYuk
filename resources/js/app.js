// import "./bootstrap";
// import Chart from "chart.js/auto";
// import 'flowbite';

// const chartElement = document.getElementById("transactionsChart");
// const ctx = document.getElementById("transactionsChart").getContext("2d");
// const transactionsChart = new Chart(ctx, {
//     type: "line",
//     data: {
//         labels: ["Maret", "April", "Mei", "Juni", "Juli", "Agustus"],
//         datasets: [
//             {
//                 label: "Pendapatan (Rp)",
//                 data: [850000, 1200000, 1100000, 1350000, 1250000, 1550000],
//                 backgroundColor: "rgba(79, 70, 229, 0.1)",
//                 borderColor: "rgba(79, 70, 229, 1)",
//                 borderWidth: 2,
//                 tension: 0.4,
//             },
//         ],
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//         responsive: true,
//         plugins: {
//             legend: {
//                 display: false,
//             },
//         },
//     },
// });
// resources/js/app.js
import "./bootstrap";
import Chart from "chart.js/auto";
import 'flowbite';

// --- Ganti seluruh kode Chart.js Anda dengan ini ---
const chartElement = document.getElementById("transactionsChart");

if (chartElement) {
    // Ambil data dari API yang baru kita buat
    window.axios.get('/api/admin/chart-data')
        .then(response => {
            const chartData = response.data;
            const ctx = chartElement.getContext("2d");

            new Chart(ctx, {
                type: "line",
                data: {
                    labels: chartData.labels, // Gunakan label dari API
                    datasets: [{
                        label: "Pendapatan (Rp)",
                        data: chartData.data, // Gunakan data dari API
                        backgroundColor: "rgba(79, 70, 229, 0.1)",
                        borderColor: "rgba(79, 70, 229, 1)",
                        borderWidth: 2,
                        tension: 0.4,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        })
        .catch(error => {
            console.error("Gagal memuat data statistik:", error);
            chartElement.parentElement.innerHTML = '<p class="text-center text-red-500">Gagal memuat data statistik.</p>';
        });
}
