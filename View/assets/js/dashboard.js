(function ($) {
  'use strict';

  if ($("#visit-sale-chart").length) {
    const ctx = document.getElementById('visit-sale-chart');

    var graphGradient1 = ctx.getContext("2d");
    var graphGradient2 = ctx.getContext("2d");
    var graphGradient3 = ctx.getContext("2d");

    var gradientStrokeViolet = graphGradient1.createLinearGradient(0, 0, 0, 181);
    gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
    gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');

    var gradientStrokeBlue = graphGradient2.createLinearGradient(0, 0, 0, 360);
    gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
    gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');

    var gradientStrokeRed = graphGradient3.createLinearGradient(0, 0, 0, 300);
    gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
    gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');

    const bgColor1 = ["rgba(218, 140, 255, 1)"];
    const bgColor2 = ["rgba(54, 215, 232, 1)"];
    const bgColor3 = ["rgba(255, 191, 150, 1)"];

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG'],
        datasets: [
          {
            label: "CHN",
            borderColor: gradientStrokeViolet,
            backgroundColor: gradientStrokeViolet,
            fillColor: bgColor1,
            hoverBackgroundColor: gradientStrokeViolet,
            borderWidth: 1,
            data: [20, 40, 15, 35, 25, 50, 30, 20],
            barPercentage: 0.5,
            categoryPercentage: 0.5,
          },
          {
            label: "USA",
            borderColor: gradientStrokeRed,
            backgroundColor: gradientStrokeRed,
            hoverBackgroundColor: gradientStrokeRed,
            fillColor: bgColor2,
            borderWidth: 1,
            data: [40, 30, 20, 10, 50, 15, 35, 40],
            barPercentage: 0.5,
            categoryPercentage: 0.5,
          },
          {
            label: "UK",
            borderColor: gradientStrokeBlue,
            backgroundColor: gradientStrokeBlue,
            hoverBackgroundColor: gradientStrokeBlue,
            fillColor: bgColor3,
            borderWidth: 1,
            data: [70, 10, 30, 40, 25, 50, 15, 30],
            barPercentage: 0.5,
            categoryPercentage: 0.5,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          y: {
            display: false
          },
          x: {
            display: true
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  }

  if ($("#traffic-chart").length) {
    const ctx = document.getElementById('traffic-chart');

    var graphGradient1 = ctx.getContext('2d');
    var graphGradient2 = ctx.getContext('2d');
    var graphGradient3 = ctx.getContext('2d');

    var gradientStrokeBlue = graphGradient1.createLinearGradient(0, 0, 0, 181);
    gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
    gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');

    var gradientStrokeRed = graphGradient2.createLinearGradient(0, 0, 0, 50);
    gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
    gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');

    var gradientStrokeGreen = graphGradient3.createLinearGradient(0, 0, 0, 300);
    gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
    gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Search Engines 30%', 'Direct Click 30%', 'Bookmarks Click 40%'],
        datasets: [{
          data: [30, 30, 40],
          backgroundColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ]
        }]
      },
      options: {
        cutout: 50,
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  }

  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true
    });
  }

  /* ---------- FIX DEL ERROR DE classList ---------- */

  const proBanner = document.querySelector('#proBanner');
  const navbar = document.querySelector('.navbar');
  const pageWrapper = document.querySelector('.page-body-wrapper');
  const bannerClose = document.querySelector('#bannerClose');

  if (proBanner && navbar) {

    if ($.cookie('purple-pro-banner') != "true") {
      proBanner.classList.add('d-flex');
      navbar.classList.remove('fixed-top');
    } else {
      proBanner.classList.add('d-none');
      navbar.classList.add('fixed-top');
    }

  }

  if (navbar && pageWrapper) {

    if (navbar.classList.contains("fixed-top")) {
      pageWrapper.classList.remove('pt-0');
      navbar.classList.remove('pt-5');
    } else {
      pageWrapper.classList.add('pt-0');
      navbar.classList.add('pt-5');
      navbar.classList.add('mt-3');
    }

  }

  if (bannerClose) {

    bannerClose.addEventListener('click', function () {

      if (proBanner) {
        proBanner.classList.add('d-none');
        proBanner.classList.remove('d-flex');
      }

      if (navbar) {
        navbar.classList.remove('pt-5');
        navbar.classList.add('fixed-top');
        navbar.classList.remove('mt-3');
      }

      if (pageWrapper) {
        pageWrapper.classList.add('proBanner-padding-top');
      }

      var date = new Date();
      date.setTime(date.getTime() + 24 * 60 * 60 * 1000);

      $.cookie('purple-pro-banner', "true", {
        expires: date
      });

    });

  }

})(jQuery);