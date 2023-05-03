const chartData = {
    labels: ["Done", "Failed", "To Do", "Waiting"],
    data: [40, 20, 10, 30],
    
  };
  
  const myChart = document.querySelector(".my-chart");
  const ul = document.querySelector(".studentStats .details ul");
  
  new Chart(myChart, {
    type: "doughnut",
    data: {
      labels: chartData.labels,
      datasets: [
        {
          label: "  Results in percent: ",
          data: chartData.data,
          backgroundColor: [
            "#93ccad",
            "#e96d7f",
            "#34a1eb",
            "#f5e342"
          ]
          
        },
      ],
    },

    options: {
        responsive: true,
      borderWidth: 10,
      borderRadius: 2,
      hoverBorderWidth: 0,
      plugins: {
        legend: {
          
          position: 'bottom',
        },
      },
    },
  });
  
  const populateUl = () => {
    chartData.labels.forEach((l, i) => {
      let li = document.createElement("li");
      li.innerHTML = `${l}: <span class='percentage'>${chartData.data[i]}%</span>`;
      ul.appendChild(li);
    });
  };
  
  populateUl();