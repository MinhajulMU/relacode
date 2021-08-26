import React, { useState, useEffect } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { Helmet } from 'react-helmet';
import 'react-jquery-plugin';
import '@fortawesome/fontawesome-free/css/all.min.css';
require('../../../assets/js/plugin/webfont/webfont.min.js');
import '../../../assets/css/bootstrap.min.css';
import '../../../assets/css/atlantis.min.css';
require('popper.js');
require('../../../assets/js/core/bootstrap.min.js');
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

const Index = ({title,children}) => {
  useEffect(() => {
    require('../../../assets/js/atlantis.min.js');
  });
  return (
    <React.Fragment>
      <Helmet>
        <title>{title+" | "+process.env.MIX_APP_NAME}</title>
      </Helmet>
      <div className="wrapper overlay-sidebar">
        <div className="main-header">
          {/* Logo Header */}
          <div className="logo-header" data-background-color="blue2">
            <a href="index.html" className="logo">
              <img src="/images/logo.svg" alt="navbar brand" className="navbar-brand" />
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
                <i className="icon-menu" />
              </span>
            </button>
            <button className="topbar-toggler more">
              <i className="fa fa-bars" />
            </button>
            <div className="nav-toggle">
              <button className="btn btn-toggle sidenav-overlay-toggler">
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
          <div className="content">
            <div className="page-inner">
              <div className="page-header">
                <h4 className="page-title">Icons</h4>
                {children}
                <ul className="breadcrumbs">
                  <li className="nav-home">
                    <a href="#">
                      <i className="flaticon-home" />
                    </a>
                  </li>
                  <li className="separator">
                    <i className="flaticon-right-arrow" />
                  </li>
                  <li className="nav-item">
                    <a href="#">Base</a>
                  </li>
                  <li className="separator">
                    <i className="flaticon-right-arrow" />
                  </li>
                  <li className="nav-item">
                    <a href="#">Flaticons</a>
                  </li>
                </ul>
              </div>
              <div className="row">
                <div className="col-md-12">
                  <div className="card">
                    <div className="card-header">
                      <div className="card-title">Flaticons</div>
                      <div className="card-category">
                        Flat Icons 
                      </div>
                    </div>
                    <div className="card-body">
                      <div id="row-demo-icon" className="row" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <Footer></Footer>
        </div>
      </div>
    </React.Fragment>
  );
};
export default Index;