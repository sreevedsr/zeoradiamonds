/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */

document.addEventListener("DOMContentLoaded", () => {
  const pieCtx = document.getElementById("pie");

  // Prevent Chart.js from running before the canvas exists
  if (!pieCtx) return;

  const pieConfig = {
    type: "doughnut",
    data: {
      datasets: [
        {
          data: [33, 33, 33],
          /**
           * These colors come from Tailwind CSS palette
           * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
           */
          backgroundColor: ["#0694a2", "#1c64f2", "#7e3af2"],
          label: "Dataset 1",
        },
      ],
      labels: ["Shoes", "Shirts", "Bags"],
    },
    options: {
      responsive: true,
      // For Chart.js v4, the "cutoutPercentage" option was replaced by "cutout"
      cutout: "80%",
      plugins: {
        legend: {
          display: false,
        },
      },
    },
  };

  // Create the chart once DOM is ready
  window.myPie = new Chart(pieCtx, pieConfig);
});
