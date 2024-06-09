var transparent = true;
var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;
var backgroundOrange = false;
var sidebar_mini_active = false;
var toggle_initialized = false;

var $html = $('html');
var $body = $('body');
var $navbar_minimize_fixed = $('.navbar-minimize-fixed');
var $collapse = $('.collapse');
var $navbar = $('.navbar');
var $tagsinput = $('.tagsinput');
var $selectpicker = $('.selectpicker');
var $navbar_color = $('.navbar[color-on-scroll]');
var $full_screen_map = $('.full-screen-map');
var $datetimepicker = $('.datetimepicker');
var $datepicker = $('.datepicker');
var $timepicker = $('.timepicker');

var seq = 0,
  delays = 80,
  durations = 500;
var seq2 = 0,
  delays2 = 80,
  durations2 = 500;

/*!

 =========================================================
 * Black Dashboard - v1.0.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/black-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com) & UPDIVISION (https://updivision.com)

 * Coded by www.creative-tim.com

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */

(function() {
  var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;

  if (isWindows) {
    // if we are on windows OS we activate the perfectScrollbar function
    if ($('.main-panel').length != 0) {
      var ps = new PerfectScrollbar('.main-panel', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20,
        suppressScrollX: true
      });
    }

    if ($('.sidebar .sidebar-wrapper').length != 0) {

      var ps1 = new PerfectScrollbar('.sidebar .sidebar-wrapper');
      $('.table-responsive').each(function() {
        var ps2 = new PerfectScrollbar($(this)[0]);
      });
    }



    $html.addClass('perfect-scrollbar-on');
  } else {
    $html.addClass('perfect-scrollbar-off');
  }
})();

$(document).ready(function() {

  var scroll_start = 0;
  var startchange = $('.row');
  var offset = startchange.offset();
  var scrollElement = navigator.platform.indexOf('Win') > -1 ? $(".ps") : $(window);
  scrollElement.scroll(function() {

    scroll_start = $(this).scrollTop();

    if (scroll_start > 50) {
      $(".navbar-minimize-fixed").css('opacity', '1');
    } else {
      $(".navbar-minimize-fixed").css('opacity', '0');
    }
  });


  $(document).scroll(function() {
    scroll_start = $(this).scrollTop();
    if (scroll_start > offset.top) {
      $(".navbar-minimize-fixed").css('opacity', '1');
    } else {
      $(".navbar-minimize-fixed").css('opacity', '0');
    }
  });

  if ($('.full-screen-map').length == 0 && $('.bd-docs').length == 0) {
    // On click navbar-collapse the menu will be white not transparent
    $('.collapse').on('show.bs.collapse', function() {
      $(this).closest('.navbar').removeClass('navbar-transparent').addClass('bg-white');
    }).on('hide.bs.collapse', function() {
      $(this).closest('.navbar').addClass('navbar-transparent').removeClass('bg-white');
    });
  }

  blackDashboard.initMinimizeSidebar();

  $navbar = $('.navbar[color-on-scroll]');
  scroll_distance = $navbar.attr('color-on-scroll') || 500;

  // Check if we have the class "navbar-color-on-scroll" then add the function to remove the class "navbar-transparent" so it will transform to a plain color.
  if ($('.navbar[color-on-scroll]').length != 0) {
    blackDashboard.checkScrollForTransparentNavbar();
    $(window).on('scroll', blackDashboard.checkScrollForTransparentNavbar)
  }

  $('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
  });

  // Activate bootstrapSwitch
  $('.bootstrap-switch').each(function() {
    $this = $(this);
    data_on_label = $this.data('on-label') || '';
    data_off_label = $this.data('off-label') || '';

    $this.bootstrapSwitch({
      onText: data_on_label,
      offText: data_off_label
    });
  });
});

$(document).on('click', '.navbar-toggle', function() {
  var $toggle = $(this);

  if (blackDashboard.misc.navbar_menu_visible == 1) {
    $html.removeClass('nav-open');
    blackDashboard.misc.navbar_menu_visible = 0;
    setTimeout(function() {
      $toggle.removeClass('toggled');
      $('.bodyClick').remove();
    }, 550);

  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 580);

    var div = '<div class="bodyClick"></div>';
    $(div).appendTo('body').click(function() {
      $html.removeClass('nav-open');
      blackDashboard.misc.navbar_menu_visible = 0;
      setTimeout(function() {
        $toggle.removeClass('toggled');
        $('.bodyClick').remove();
      }, 550);
    });

    $html.addClass('nav-open');
    blackDashboard.misc.navbar_menu_visible = 1;
  }
});

$(window).resize(function() {
  // reset the seq for charts drawing animations
  seq = seq2 = 0;

  if ($full_screen_map.length == 0 && $('.bd-docs').length == 0) {
    var isExpanded = $navbar.find('[data-toggle="collapse"]').attr("aria-expanded");
    if ($navbar.hasClass('bg-white') && $(window).width() > 991) {
      $navbar.removeClass('bg-white').addClass('navbar-transparent');
    } else if ($navbar.hasClass('navbar-transparent') && $(window).width() < 991 && isExpanded != "false") {
      $navbar.addClass('bg-white').removeClass('navbar-transparent');
    }
  }
});

blackDashboard = {
  misc: {
    navbar_menu_visible: 0
  },

  initMinimizeSidebar: function() {
    if ($('.sidebar-mini').length != 0) {
      sidebar_mini_active = true;
    }

    $('#minimizeSidebar').click(function() {
      var $btn = $(this);

      if (sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        sidebar_mini_active = false;
        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
      } else {
        $('body').addClass('sidebar-mini');
        sidebar_mini_active = true;
        blackDashboard.showSidebarMessage('Sidebar mini activated...');
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
  },

  showSidebarMessage: function(message) {
    try {
      $.notify({
        icon: "tim-icons ui-1_bell-53",
        message: message
      }, {
        type: 'info',
        timer: 4000,
        placement: {
          from: 'top',
          align: 'right'
        }
      });
    } catch (e) {
      console.log('Notify library is missing, please make sure you have the notifications library added.');
    }

  }

};

function hexToRGB(hex, alpha) {
  var r = parseInt(hex.slice(1, 3), 16),
    g = parseInt(hex.slice(3, 5), 16),
    b = parseInt(hex.slice(5, 7), 16);

  if (alpha) {
    return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
  } else {
    return "rgb(" + r + ", " + g + ", " + b + ")";
  }
}

$(function () {


  // -----------------------------------------------------------------------
  // Subscriptions
  // -----------------------------------------------------------------------
  var chart = {
    series: [
      {
        name: "2024",
        data: [1.2, 2.7, 1, 3.6, 2.1, 2.7, 2.2, 1.3, 2.5],
      },
      {
        name: "2023",
        data: [-2.8, -1.1, -2.5, -1.5, -2.3, -1.9, -1, -2.1, -1.3],
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "bar",
      fontFamily: "inherit",
      foreColor: "#adb0bb",
      height: 270,
      stacked: true,
      offsetX: -15,
    },
    colors: ["var(--bs-primary)", "var(--bs-danger)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "15%",
        borderRadius: [6],
        borderRadiusApplication: "end",
        borderRadiusWhenStacked: "all",
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    grid: {
      show: true,
      padding: {
        top: 0,
        bottom: 0,
        right: 0,
      },
      borderColor: "rgba(0,0,0,0.05)",
      xaxis: {
        lines: {
          show: true,
        },
      },
      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    yaxis: {
      min: -5,
      max: 5,
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "July",
        "Aug",
        "Sep",
      ],
      labels: {
        style: { fontSize: "13px", colors: "#adb0bb", fontWeight: "400" },
      },
    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#revenue-forecast"),
    chart
  );
  chart.render();


  // -----------------------------------------------------------------------
  // Total Income
  // -----------------------------------------------------------------------
  var customers = {
    chart: {
      id: "sparkline3",
      type: "line",
      fontFamily: "inherit",
      foreColor: "#adb0bb",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
    },
    series: [
      {
        name: "Income",
        color: "var(--bs-danger)",
        data: [30, 25, 35, 20, 30, 40],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#total-income"), customers).render();

})