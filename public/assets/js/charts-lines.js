/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 * This script defines a reusable function to draw a line chart.
 */

function initSalesChart(canvasId, labels, values) {
  const ctx = document.getElementById(canvasId);
  if (!ctx) return;

  const lineConfig = {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Sales (INR)',
          backgroundColor: '#0694a2',
          borderColor: '#0694a2',
          data: values,
          fill: false,
          tension: 0.3,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function (context) {
              const val = context.parsed.y || 0;
              return '₹' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            },
          },
        },
      },
      interaction: {
        mode: 'nearest',
        intersect: true,
      },
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Month',
          },
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Sales (INR)',
          },
          ticks: {
            callback: function (value) {
              return '₹' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            },
          },
        },
      },
    },
  };

  new Chart(ctx, lineConfig);
}
