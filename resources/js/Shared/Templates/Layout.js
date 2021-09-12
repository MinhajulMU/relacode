import React, { useState, useEffect } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { Helmet } from 'react-helmet';
import 'react-jquery-plugin';
import '@fortawesome/fontawesome-free/css/all.min.css';
require('../../../assets/js/plugin/webfont/webfont.min.js');
// import '../../../assets/css/bootstrap.min.css';
import '../../../assets/bootstrap-dist/css/bootstrap.min.css';
import '../../../assets/css/atlantis.min.css';
require('popper.js');
// require('../../../assets/js/core/bootstrap.min.js');
require('../../../assets/bootstrap-dist/js/bootstrap.bundle.min.js');
require('../../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js');
require('../../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js');
require('../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js');
require('../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js');
require('../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js');
require('../../../assets/js/plugin/jqvmap/jquery.vmap.min.js');

//component
import SearchHeader from '@/Shared/components/SearchHeader';
import Sidebar from '@/Shared/components/Sidebar';
import Notification from '@/Shared/components/Notification';
import Profile from '@/Shared/components/Profile';
import Footer from '@/Shared/components/Footer';

const Index = ({ title, children }) => {
  useEffect(() => {
    require('../../../assets/js/atlantis.min.js');
  });
  return (
    <React.Fragment>
      <Helmet>
        <title>{title + ' | ' + process.env.MIX_APP_NAME}</title>
      </Helmet>
      <div className="wrapper">
        <div className="main-header">
          {/* Logo Header */}
          <div className="logo-header" data-background-color="blue2">
            <a href="index.html" className="logo">
              <img
                src="/images/logo.svg"
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
