const initSalesChart = (id, labels, values) => {
    const ctx = document.getElementById(id).getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                tension: 0.38,
                borderWidth: 3,
                pointRadius: 3,
                fill: true,
                backgroundColor: "rgba(59,130,246,0.15)",
                borderColor: "rgba(59,130,246,1)",
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxRotation: 0
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#111",
                    padding: 10,
                    titleFont: { size: 13 },
                    bodyFont: { size: 12 },
                }
            }
        }
    });
};
