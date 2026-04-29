$(function () {
  'use strict'
  
  var colors = {
    primary: "#6571ff",
    secondary: "#7987a1",
    success: "#05a34a",
    info: "#66d1d1",
    warning: "#fbbc06",
    danger: "#ff3366",
    light: "#e9ecef",
    dark: "#060c17",
    muted: "#7987a1",
    gridBorder: "rgba(77, 138, 240, .15)",
    bodyColor: "#000",
    cardBg: "#fff"
  }

  var fontFamily = "'Roboto', Helvetica, sans-serif"

  // Date Picker Start
  if ($('#dashboardDate').length) {
    flatpickr("#dashboardDate", {
      wrap: true,
      dateFormat: "d-M-Y",
      defaultDate: "today",
    });
  }
  // Date Picker End

  $('#studentsTable tbody').on('click', 'tr', function() {
    window.location.href = $(this).attr('data-href');
  });

  // Get Months Start
  function generateMonthNames() {
    var months = [];
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    for (var i = 0; i < 12; i++) {
      months.push(monthNames[i]);
    }
    return months;
  }
  // Get Months End

  // Fee Collection Apex Chart Start
  if ($('#feeCollectionChart').length) {
    var options = {
      chart: {
        type: "area",
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
        stacked: false,
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light',
        x: {
          format: "MMM"
        },
      },
      colors: ['#FFA201', '#000865'], // Custom colors for the two series
      stroke: {
        curve: "smooth",
        width: 3
      },
      dataLabels: {
        enabled: false
      },
      series: [
        {
          name: 'Total Collection',
          data: totalOfMonthlyFeeSchedules // Generate data for all 12 months for series 1
        }, {
          name: 'Fee Collection',
          data: totalOfMonthlyPaidFeeCollections // Generate data for all 12 months for series 2
        }
      ],
      xaxis: {
        type: "category",
        categories: generateMonthNames(),
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        tickAmount: 10, // Adjust as needed
        min: 0,
        labels: {
          formatter: function (value) {
            if (value >= 1000) {
              return (value / 1000).toFixed(0) + 'k'; // Convert to '25k', '50k', '75k', etc.
            }
            return value;
          }
        },
        tooltip: {
          enabled: true
        }
      },
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      fill: {
        type: 'solid',
        opacity: [0.4, 0.25],
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: fontFamily,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
    };

    var feeCollectionChart = new ApexCharts(document.querySelector("#feeCollectionChart"), options);
    feeCollectionChart.render();
  }
  // Fee Collection Apex Chart End

  // Expense Bar Chart Start
  if ($('#expenseChart').length) {
    var options = {
      chart: {
        type: 'bar',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary],
      fill: {
        opacity: .9
      },
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [{
        name: 'Expenses',
        data: totalOfMonthlyPaidExpenses
      }],
      xaxis: {
        type: 'month',
        categories: generateMonthNames(),
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        tickAmount: 10, // Adjust as needed
        title: {
          text: 'Expenses',
          style: {
            size: 9,
            color: colors.muted
          }
        },
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: fontFamily,
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: fontFamily,
        },
        offsetY: -27
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'center',
            orientation: 'vertical',
          }
        },
      },
    }

    var expenseChart = new ApexCharts(document.querySelector("#expenseChart"), options);
    expenseChart.render();
  }
  // Expense Bar Chart End

  // Gender Donut Chart Start 
  if ($('#genderChart').length) {
    var options = {
      chart: {
        height: 350,
        type: "donut",
        foreColor: '#333',
        background: '#fff',
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      stroke: {
        colors: ['rgba(0,0,0,0)']
      },
      colors: ['#FFA201', '#000865'],
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: 'Arial, sans-serif',
        itemMargin: {
          horizontal: 12,
          vertical: 0
        },
      },
      dataLabels: {
        enabled: false,
        // style: {
        //   fontSize: '12px',
        //   colors: ["#fff"]
        // }
      },
      series: [],
      labels: []
    };
    
    options.series = [studentFemale, studentMale];
    options.labels = ['Female', 'Male'];

    var genderChart = new ApexCharts(document.querySelector("#genderChart"), options);
    genderChart.render();
  }
  // Gender Donut Chart End
});