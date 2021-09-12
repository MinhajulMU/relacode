import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import FlashMessages from "@/Shared/components/FlashMessages";
import { Inertia } from "@inertiajs/inertia";

const Profil = () => {
  const props = usePage().props;
  console.log(props);
  return (
    <React.Fragment>
      <div className="panel-header bg-primary-gradient">
        <div className="page-inner py-5">
          <div className="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
              <h2 className="text-white pb-2 fw-bold">Profile</h2>
            </div>
            <div className="ml-md-auto py-2 py-md-0"></div>
          </div>
        </div>
      </div>
      <div className="page-inner mt--5">
        <div className="row">
          <div className="col-md-4">
            <div className="row row-card-no-pd mt--2">
              <div className="col-sm-12 col-md-12">
                <div className="card card-stats card-round">
                  <div className="card-body">
                    <div className="row">
                      <div className="col-md-12">
                        <div className="card card-profile">
                          <div
                            className="card-header"
                            style={{
                              backgroundImage:
                                'url("/images/img/blogpost.jpg")',
                            }}
                          >
                            <div className="profile-picture">
                              <div className="avatar avatar-xl">
                                <img
                                  src="/images/profile.jpg"
                                  alt="..."
                                  className="avatar-img rounded-circle"
                                />
                              </div>
                            </div>
                          </div>
                          <div className="card-body">
                            <div className="user-profile text-center pt-5">
                              <div className="name">{props.auth.user.name}</div>
                              <div className="job">Frontend Developer</div>
                              <div className="desc">
                              {props.auth.user.email}
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="col-md-8">
            <div className="row row-card-no-pd mt--2">
              <div className="col-sm-12 col-md-12">
                <div className="card card-stats card-round">
                  <div className="card-body">
                    <div>
                      <ul
                        className="nav nav-pills nav-secondary"
                        id="pills-tab"
                        role="tablist"
                      >
                        <li className="nav-item">
                          <a
                            className="nav-link active"
                            id="pills-home-tab"
                            data-toggle="pill"
                            href="#pills-home"
                            role="tab"
                            aria-controls="pills-home"
                            aria-selected="true"
                          >
                            Log
                          </a>
                        </li>
                        <li className="nav-item">
                          <a
                            className="nav-link"
                            id="pills-profile-tab"
                            data-toggle="pill"
                            href="#pills-profile"
                            role="tab"
                            aria-controls="pills-profile"
                            aria-selected="false"
                          >
                            Edit Profile
                          </a>
                        </li>
                      </ul>
                      <hr></hr>
                      <div
                        className="tab-content mt-2 mb-3"
                        id="pills-tabContent"
                      >
                        <div
                          className="tab-pane fade show active"
                          id="pills-home"
                          role="tabpanel"
                          aria-labelledby="pills-home-tab"
                        >
                          <ul className="timeline">
                            <li>
                              <div className="timeline-badge warning">
                                <i className="flaticon-alarm-1" />
                              </div>
                              <div className="timeline-panel">
                                <div className="timeline-heading">
                                  <h4 className="timeline-title">
                                    Mussum ipsum cacilds
                                  </h4>
                                  <p>
                                    <small className="text-muted">
                                      <i className="flaticon-message" /> 11
                                      hours ago via Twitter
                                    </small>
                                  </p>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                        <div
                          className="tab-pane fade"
                          id="pills-profile"
                          role="tabpanel"
                          aria-labelledby="pills-profile-tab"
                        >
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

Profil.layout = (page) => <Layout children={page} title="Profile" />;
export default Profil;
