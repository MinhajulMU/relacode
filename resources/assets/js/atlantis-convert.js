'use strict';
  function legendClickCallback(a) {
    for (
      let e = (a = a || window.event).target || a.srcElement;
      'LI' !== e.nodeName;

    )
      e = e.parentElement;
    let s = e.parentElement,
      o = parseInt(s.classList[0].split('-')[0], 10),
      i = Chart.instances[o],
      n = Array.prototype.slice.call(s.children).indexOf(e);
    i.legend.options.onClick.call(i, a, i.legend.legendItems[n]),
      i.isDatasetVisible(n)
        ? e.classList.remove('hidden')
        : e.classList.add('hidden');

  }

  document.ready(function () {
    let a = $('.sidebar .scrollbar');
    a.length > 0 && a.scrollbar();
    let e = $('.main-panel .content-scroll');
    e.length > 0 && e.scrollbar();
    let s = document.getElementsByClassName("messages-scroll");
    s.length > 0 && s.scrollbar();
    let o = document.getElementsByClassName("tasks-scroll");
    o.length > 0 && o.scrollbar();
    let i = document.getElementsByClassName("quick-scroll");
    i.length > 0 && i.scrollbar();
    let n = document.getElementsByClassName("message-notif-scroll");
    n.length > 0 && n.scrollbar();
    let r = document.getElementsByClassName("notif-scroll");
    r.length > 0 && r.scrollbar();
    let l = document.getElementsByClassName("quick-actions-scroll");
    l.length > 0 && l.scrollbar();
    let t = document.getElementsByClassName("dropdown-user-scroll");
    t.length > 0 && t.scrollbar(),
      document.getElementsByClassName("scroll-bar").draggable(),
      document.getElementById("search-nav").on('shown.bs.collapse', function () {
        $('.nav-search .form-control').focus();
      });
    let c = !1,
      d = !1,
      g = !1,
      p = !1,
      h = 0,
      m = 0,
      u = 0,
      v = 0,
      f = 0,
      b = 0;
    if (!c) {
      (C = document.getElementByClassName("sidenav-toggler")).addEventListener('click', (e) => {
        1 == h
          ? ($('html').classList.remove("nav_open"),
            C.classList.remove("toggled"),
            (h = 0))
          : ($('html').classList.add("nav_open"), C.classList.add("toggled"), (h = 1));
      });,
        (c = !0);
    }
    if (!m) {
      let C = document.getElementByClassName("quick-sidebar-toggler");
      C.addEventListener('click', (e) => {
        1 == h
          ? ($('html').classList.remove("quick_sidebar_open"),
            let quick-sidebar-overlay = document.getElementByClassName("quick-sidebar-overlay");
	quick-sidebar-overlay.parentNode.removeChild(quick-sidebar-overlay);,
            C.classList.remove("toggled"),
            (m = 0))
          : ($('html').classList.add("quick_sidebar_open"),
            C.classList.add("toggled"),
            $('<div class="quick-sidebar-overlay"></div>').insertAfter(
              '.quick-sidebar'
            ),
            (m = 1));
      });,
        document.getElementByClassName("wrapper").mouseup(function (a) {
          let e = document.getElementByClassName("quick-sidebar");
          a.target.className == e.attr('class') ||
            e.has(a.target).length ||
            ($('html').classList.remove("quick_sidebar_open"),
            document.getElementByClassName("quick-sidebar-toggler").classList.remove("toggled"),
            let quick-sidebar-overlay = document.getElementByClassName("quick-sidebar-overlay");
	quick-sidebar-overlay.parentNode.removeChild(quick-sidebar-overlay);,
            (m = 0));
        }),
        document.getElementByClassName("close-quick-sidebar").addEventListener('click', (e) => {
          $('html').classList.remove("quick_sidebar_open"),
            document.getElementByClassName("quick-sidebar-toggler").classList.remove("toggled"),
            let quick-sidebar-overlay = document.getElementByClassName("quick-sidebar-overlay");
	quick-sidebar-overlay.parentNode.removeChild(quick-sidebar-overlay);,
            (m = 0);
        });,
        (m = !0);
    }
    if (!d) {
      let w = document.getElementByClassName("topbar-toggler");
      w.addEventListener('click', (e) => {
        1 == u
          ? ($('html').classList.remove("topbar_open"),
            w.classList.remove("toggled"),
            (u = 0))
          : ($('html').classList.add("topbar_open"), w.classList.add("toggled"), (u = 1));
      });,
        (d = !0);
    }
    if (!g) {
      let k = document.getElementByClassName("toggle-sidebar");
      document.getElementByClassName("wrapper").classList.contains("sidebar_minimize") &&
        ((v = 1),
        k.classList.add("toggled"),
        k.innerHTML = '<i class="fa fa-ellipsis-v"></i>'),
        k.addEventListener('click', (e) => {
          1 == v
            ? (document.getElementByClassName("wrapper").classList.remove("sidebar_minimize"),
              k.classList.remove("toggled"),
              k.innerHTML = '<i class="fa fa-bars"></i>',
              (v = 0))
            : (document.getElementByClassName("wrapper").classList.add("sidebar_minimize"),
              k.classList.add("toggled"),
              k.innerHTML = '<i class="fa fa-ellipsis-v"></i>',
              (v = 1)),
            window.resize();
        });,
        (g = !0);
    }
    if (!p) {
      let _ = document.getElementByClassName("page-sidebar-toggler");
      _.addEventListener('click', (e) => {
        1 == f
          ? ($('html').classList.remove("pagesidebar_open"),
            _.classList.remove("toggled"),
            (f = 0))
          : ($('html').classList.add("pagesidebar_open"),
            _.classList.add("toggled"),
            (f = 1));
      });
      $('.page-sidebar .back').addEventListener('click', (e) => {
        $('html').classList.remove("pagesidebar_open"),
          _.classList.remove("toggled"),
          (f = 0);
      });,
        (p = !0);
    }
    let y = document.getElementByClassName("sidenav-overlay-toggler");
    document.getElementByClassName("wrapper").classList.contains("is-show") &&
      ((b = 1),
      y.classList.add("toggled"),
      y.innerHTML = '<i class="fa fa-ellipsis-v"></i>'),
      y.addEventListener('click', (e) => {
        1 == b
          ? (document.getElementByClassName("wrapper").classList.remove("is-show"),
            y.classList.remove("toggled"),
            y.innerHTML = '<i class="fa fa-bars"></i>',
            (b = 0))
          : (document.getElementByClassName("wrapper").classList.add("is-show"),
            y.classList.add("toggled"),
            y.innerHTML = '<i class="fa fa-ellipsis-v"></i>',
            (b = 1)),
          window.resize();
      });,
      (g = !0),
      document.getElementByClassName("sidebar").hover(
        function () {
          document.getElementByClassName("wrapper").classList.contains("sidebar_minimize") &&
            document.getElementByClassName("wrapper").classList.add("sidebar_minimize_hover");
        },
        function () {
          document.getElementByClassName("wrapper").classList.contains("sidebar_minimize") &&
            document.getElementByClassName("wrapper").classList.remove("sidebar_minimize_hover");
        }
      ),
      document.querySelectorAll(".nav-item a").addEventListener('click', (e) => {
        this.parent().find('.collapse').classList.contains("show")
          ? this.parent().classList.remove("submenu")
          : this.parent().classList.add("submenu");
      });,
      $('.form-group-default .form-control')
        .focus(function () {
          this.parent().classList.add("active");
        })
        .blur(function () {
          this.parent().classList.remove("active");
        });
  });