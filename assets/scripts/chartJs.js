import Chart, { elements } from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
  const myDate = initData(window.jsonDates);
  const data = generateData(myDate);
  const barChart = initChart(data);
});

const initData = (json) => {
  const jsonDates = JSON.parse(json);
  const data = Object.entries(jsonDates);
  return data;
};

const generateData = (myDate) => {
  const data = {
    labels: [
      myDate[0][0],
      myDate[1][0],
      myDate[2][0],
      myDate[3][0],
      myDate[4][0],
      myDate[5][0],
      myDate[6][0],
    ],
    datasets: [
      {
        data: [
          myDate[0][1],
          myDate[1][1],
          myDate[2][1],
          myDate[3][1],
          myDate[4][1],
          myDate[5][1],
          myDate[6][1],
        ],
        backgroundColor: [
          "crimson",
          "lightgreen",
          "lightblue",
          "lightgreen",
          "crimson",
        ],
      },
    ],
  };

  return data;
};

const retrieveData = (date) => {
  return Math.floor(Math.random() * 1000);
};

const initChart = (data) => {
  let maxY = 1;
  let dataCounts = data.datasets[0].data;
  dataCounts.forEach((element) => {
    if (element > maxY) {
      maxY = element;
    }
  });
  const barCanvas = document.getElementById("barCanvas");

  const barChart = new Chart(barCanvas, {
    type: "bar",
    data: data,
    options: {
      scales: {
        y: {
          suggestedMax: maxY,
          ticks: {
            font: {
              size: 20,
            },
          },
        },
        x: {
          ticks: {
            font: {
              size: 20,
            },
          },
        },
      },
    },
  });

  return barChart;
};
