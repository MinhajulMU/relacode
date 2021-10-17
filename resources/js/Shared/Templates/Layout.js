import React, { useState, useLayoutEffect, useEffect } from "react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import { Helmet } from "react-helmet";
import { $ } from "react-jquery-plugin";
import "@fortawesome/fontawesome-free/css/all.min.css";
// import '../../../assets/css/bootstrap.min.css';
import "../../../assets/bootstrap-dist/css/bootstrap.min.css";
import "../../../assets/css/atlantis.min.css";
require("popper.js");
// require('../../../assets/js/core/bootstrap.min.js');
require("../../../assets/bootstrap-dist/js/bootstrap.bundle.min.js");
require("../../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js");
require("../../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js");
require("../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js");
require("../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js");
require("../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js");
require("../../../assets/js/plugin/jqvmap/jquery.vmap.min.js");
// import '../../../assets/js/atlantis-convert.js';
//component
import SearchHeader from "@/Shared/components/SearchHeader";
import Sidebar from "@/Shared/components/Sidebar";
import Notification from "@/Shared/components/Notification";
import Profile from "@/Shared/components/Profile";
import Footer from "@/Shared/components/Footer";

const Index = ({ title, children }) => {
  useEffect(() => {
    var a = $(".sidebar .scrollbar");
    a.length > 0 && a.scrollbar();
    var s = $(".messages-scroll");
    s.length > 0 && s.scrollbar();
    var o = $(".tasks-scroll");
    o.length > 0 && o.scrollbar();
    var i = $(".quick-scroll");
    i.length > 0 && i.scrollbar();
    var n = $(".message-notif-scroll");
    n.length > 0 && n.scrollbar();
    var r = $(".notif-scroll");
    r.length > 0 && r.scrollbar();
    var l = $(".quick-actions-scroll");
    l.length > 0 && l.scrollbar();
    var t = $(".dropdown-user-scroll");
    t.length > 0 && t.scrollbar(), $(".scroll-bar").draggable();
    var c = !1,
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
      (C = $(".sidenav-toggler")).on("click", function () {
        1 == h
          ? ($("html").removeClass("nav_open"),
            C.removeClass("toggled"),
            (h = 0))
          : ($("html").addClass("nav_open"), C.addClass("toggled"), (h = 1));
      }),
        (c = !0);
    }
    if (!m) {
      var C = $(".quick-sidebar-toggler");
      C.on("click", function () {
        1 == h
          ? ($("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-overlay").remove(),
            C.removeClass("toggled"),
            (m = 0))
          : ($("html").addClass("quick_sidebar_open"),
            C.addClass("toggled"),
            $('<div class="quick-sidebar-overlay"></div>').insertAfter(
              ".quick-sidebar"
            ),
            (m = 1));
      }),
        $(".wrapper").mouseup(function (a) {
          var e = $(".quick-sidebar");
          a.target.className == e.attr("class") ||
            e.has(a.target).length ||
            ($("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-toggler").removeClass("toggled"),
            $(".quick-sidebar-overlay").remove(),
            (m = 0));
        }),
        $(".close-quick-sidebar").on("click", function () {
          $("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-toggler").removeClass("toggled"),
            $(".quick-sidebar-overlay").remove(),
            (m = 0);
        }),
        (m = !0);
    }
    if (!d) {
      var w = $(".topbar-toggler");
      w.on("click", function () {
        1 == u
          ? ($("html").removeClass("topbar_open"),
            w.removeClass("toggled"),
            (u = 0))
          : ($("html").addClass("topbar_open"), w.addClass("toggled"), (u = 1));
      }),
        (d = !0);
    }
    if (!g) {
      var k = $(".toggle-sidebar");
      $(".wrapper").hasClass("sidebar_minimize") &&
        ((v = 1),
        k.addClass("toggled"),
        k.html('<i class="fa fa-ellipsis-v"></i>')),
        k.on("click", function () {
          1 == v
            ? ($(".wrapper").removeClass("sidebar_minimize"),
              k.removeClass("toggled"),
              k.html('<i class="fa fa-bars"></i>'),
              (v = 0))
            : ($(".wrapper").addClass("sidebar_minimize"),
              k.addClass("toggled"),
              k.html('<i class="fa fa-ellipsis-v"></i>'),
              (v = 1)),
            $(window).resize();
        }),
        (g = !0);
    }
  });

  return (
    <React.Fragment>
      <Helmet>
        <title>{title + " | " + process.env.MIX_APP_NAME}</title>
      </Helmet>
      <div className="wrapper">
        <div className="main-header">
          {/* Logo Header */}
          <div className="logo-header" data-background-color="blue">
            <a href={route("dashboard.index")} className="logo">
              <img
                src={process.env.MIX_APP_LOGO}
                alt="navbar brand"
                className="navbar-brand"
              />
            </a>
            <button
              className="navbar-toggler sidenav-toggler ml-auto"
              type="button"
              data-toggle="collapse"
              data-target="collapse"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="navbar-toggler-icon">
                <i className="fa fa-bars" />
              </span>
            </button>
            <button className="topbar-toggler more">
              <i className="fa fa-ellipsis-v" />
            </button>
            <div className="nav-toggle">
              <button className="btn btn-toggle  toggle-sidebar">
                <i className="fa fa-bars" />
              </button>
            </div>
          </div>
          {/* End Logo Header */}
          {/* Navbar Header */}
          <nav
            className="navbar navbar-header navbar-expand-lg"
            data-background-color="blue2"
          >
            <div className="container-fluid">
              <ul className="navbar-nav topbar-nav ml-md-auto align-items-center">
                <Notification></Notification>
                <Profile></Profile>
              </ul>
            </div>
          </nav>
          {/* End Navbar */}
        </div>
        {/* Sidebar */}
        <Sidebar></Sidebar>
        {/* End Sidebar */}
        <div className="main-panel">
          <div className="content">{children}</div>
          <Footer></Footer>
        </div>
      </div>
    </React.Fragment>
  );
};
export default Index;
