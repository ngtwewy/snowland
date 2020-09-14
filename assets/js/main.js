window.onload = function () {
  // 幻灯
  var swiper = new Swiper('.swiper-container', {
    pagination: {
      el: '.swiper-pagination',
    },
  });

  // 回到顶部
  var btn = document.querySelector(".to-top");
  var clientHeight = document.documentElement.clientHeight;
  var timer = null;
  var istop = true;

  window.onscroll = function () {
    var dtop = document.documentElement.scrollTop;
    if (dtop >= (clientHeight * 0.1)) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
    if (!istop) {
      clearInterval(timer);
    }
    istop = false;
  }

  btn.onclick = function () {
    timer = setInterval(function () {
      var dtop = document.documentElement.scrollTop;
      var speed = Math.floor(-dtop / 10);
      document.documentElement.scrollTop = dtop + speed;
      istop = true;
      if (dtop == 0) {
        clearInterval(timer);
      }
    }, 15)
  }
}