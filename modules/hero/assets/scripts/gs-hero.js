(function () {

  var screen_width = window.innerWidth;
  var mobile_safe_vh_unit = function () {
    var vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--mobile-safe-vh-unit', vh + 'px');
  };
  window.addEventListener('resize', function () {
    if (window.innerWidth !== screen_width) {
      screen_width = window.innerWidth;
      mobile_safe_vh_unit();
    }
  });
  mobile_safe_vh_unit();

}());
