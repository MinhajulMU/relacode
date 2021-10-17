import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import FlashMessages from "@/Shared/components/FlashMessages";
import { Inertia } from "@inertiajs/inertia";
import TextInput from "@/Shared/Form/TextInput";
import FileInput from "@/Shared/Form/FileInput";
import SubmitButton from "@/Shared/Form/SubmitButton";
import Moment from "react-moment";
import ReactHtmlParser from "react-html-parser";

const Profil = () => {
  const props = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    name: props.user.name || "",
    email: props.user.email || "",
    photo: "",
    _method: "PUT",
  });
  const doDarkMode = (event) => {
    let isChecked = event.target.checked;
    if (isChecked == true) {
      let bodyclass =  document.querySelector('body');
      bodyclass.removeAttribute('data-background-color');
      bodyclass.removeAttribute('data-background-full');
    	bodyclass.setAttribute('data-background-color', 'dark');
      bodyclass.setAttribute('data-background-full', 'dark');
      let logo_header = document.querySelector('.logo-header');
      logo_header.removeAttribute('data-background-color');
      logo_header.setAttribute('data-background-color', 'dark2');
      let topbar = document.querySelector('.main-header .navbar-header');
      topbar.removeAttribute('data-background-color');
      topbar.setAttribute('data-background-color', 'dark');
      let sidebar = document.querySelector('.sidebar');
      sidebar.removeAttribute('data-background-color');
      sidebar.setAttribute('data-background-color', 'dark2');
    }else{
      let bodyclass =  document.querySelector('body');
      bodyclass.removeAttribute('data-background-color');
      bodyclass.removeAttribute('data-background-full');
    	bodyclass.setAttribute('data-background-color', 'bg1');
      bodyclass.setAttribute('data-background-full', 'bg1');
      let logo_header = document.querySelector('.logo-header');
      logo_header.removeAttribute('data-background-color');
      logo_header.setAttribute('data-background-color', 'blue');
      let topbar = document.querySelector('.main-header .navbar-header');
      topbar.removeAttribute('data-background-color');
      topbar.setAttribute('data-background-color', 'blue2');
      let sidebar = document.querySelector('.sidebar');
      sidebar.removeAttribute('data-background-color');
      sidebar.setAttribute('data-background-color', 'white');
    }
    console.log(isChecked);
  }
  function handleSubmit(e) {
    e.preventDefault();
    post(route("dashboard.profile-update.update", props.user.id_user));
  }
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
                                  src={props.auth.profile_photo}
                                  alt="..."
                                  className="avatar-img rounded-circle"
                                />
                              </div>
                            </div>
                          </div>
                          <div className="card-body">
                            <div className="user-profile text-center pt-5">
                              <div className="name">{props.auth.user.name}</div>
                              <div className="job">
                                {props.role.length > 0 &&
                                  props.role.map((items, index) => (
                                    <span
                                      className="badge badge-success mr-1"
                                      key={index}
                                    >
                                      {items.role_name}
                                    </span>
                                  ))}
                              </div>
                              <div className="desc">
                                {props.auth.user.email}
                              </div>
                            </div>
                          </div>
                          {/* <hr></hr>
                          <div className="row">
                            <div className="col-6">
                              <b>Darkmode</b>
                            </div>
                            <div className="col-6 text-right">
                              <div className="custom-control custom-switch">
                                <input
                                  type="checkbox"
                                  className="custom-control-input"
                                  id="customSwitch1"
                                  data-onstyle="dark"
                                  data-offstyle="light"
                                  onChange={(e) => {
                                    doDarkMode(e);
                                  }}
                                />
                                <label
                                  className="custom-control-label"
                                  htmlFor="customSwitch1"
                                ></label>
                              </div>
                            </div>
                          </div> */}
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
                    <FlashMessages />
                    <div>
                      <ul
                        className="nav nav-pills nav-secondary"
                        id="pills-tab"
                        role="tablist"
                      >
                        <li className="nav-item">
                          <a
                            className="nav-link active"
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
                        <li className="nav-item">
                          <a
                            className="nav-link"
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
                      </ul>
                      <hr></hr>
                      <div
                        className="tab-content mt-2 mb-3"
                        id="pills-tabContent"
                      >
                        <div
                          className="tab-pane fade "
                          id="pills-home"
                          role="tabpanel"
                          aria-labelledby="pills-home-tab"
                        >
                          <ul className="timeline">
                            {props.log.length > 0 &&
                              props.log.map((items, index) => {
                                return (
                                  <li
                                    key={index}
                                    className={
                                      index % 2 == 0 ? "timeline-inverted" : ""
                                    }
                                  >
                                    <div className="timeline-badge warning">
                                      <i className="flaticon-alarm-1" />
                                    </div>
                                    <div className="timeline-panel">
                                      <div className="timeline-heading">
                                        <h4 className="timeline-title">
                                          {items.aktifitas}
                                        </h4>
                                        <p>
                                          <small className="text-muted">
                                            <i className="flaticon-message" />{" "}
                                            <Moment
                                              locale="id"
                                              format="dddd, LLL"
                                            >
                                              {items.created_at}
                                            </Moment>
                                          </small>
                                        </p>
                                      </div>
                                    </div>
                                  </li>
                                );
                              })}
                          </ul>
                        </div>
                        <div
                          className="tab-pane fade show active"
                          id="pills-profile"
                          role="tabpanel"
                          aria-labelledby="pills-profile-tab"
                        >
                          <form onSubmit={handleSubmit}>
                            <TextInput
                              type="text"
                              label="Nama Lengkap"
                              name="name"
                              errors={props.errors.name}
                              value={data.name}
                              placeholder="Masukkan nama lengkap"
                              onChange={(e) => setData("name", e.target.value)}
                            />
                            <TextInput
                              type="email"
                              label="Email Address"
                              name="email"
                              errors={props.errors.email}
                              value={data.email}
                              placeholder="Masukkan email address"
                              onChange={(e) => setData("email", e.target.value)}
                            />
                            <FileInput
                              className="w-full pb-8 pr-6 lg:w-1/2"
                              label="Photo"
                              name="photo"
                              accept="image/*"
                              errors={props.errors.photo}
                              value={data.photo}
                              onChange={(photo) => setData("photo", photo)}
                            />
                            {props.dokumen != null
                              ? ReactHtmlParser(
                                  "<span class='badge badge-success'>" +
                                    props.dokumen.file_name +
                                    "</span>"
                                )
                              : ""}
                            <div className="form-group">
                              <SubmitButton
                                name="Simpan"
                                isLoading={processing}
                              ></SubmitButton>
                            </div>
                          </form>
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
