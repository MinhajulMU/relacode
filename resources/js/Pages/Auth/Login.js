import React, { useState, useEffect } from "react";
import { Inertia } from "@inertiajs/inertia";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import { useForm } from "@inertiajs/inertia-react";
import { Helmet } from "react-helmet";
import "react-jquery-plugin";
import "@fortawesome/fontawesome-free/css/all.min.css";
import "../../../assets/bootstrap-dist/css/bootstrap.min.css";
import "../../../assets/css/azzara/azzara.min.css";
require("popper.js");
require("../../../assets/bootstrap-dist/js/bootstrap.bundle.min.js");
require("../../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js");

const Login = () => {
  useEffect(() => {
    require("../../../assets/js/ready.js");
  });
  const { data, setData, errors, post, processing } = useForm({
    email: "",
    password: "",
    remember: false,
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route("login.attempt"));
  }
  return (
    <React.Fragment>
      <Helmet title={"Login | " + process.env.MIX_APP_NAME} />
      <div className="login">
        <div className="wrapper wrapper-login">
          <div className="container container-login animated fadeIn">
            <h3 className="text-center">
              Sign In To {process.env.MIX_APP_NAME}
            </h3>
            <form onSubmit={handleSubmit}>
              <div className="login-form mt-5">
                <div
                  className={`form-group form-floating-label ${
                    errors.email ? "has-error" : ""
                  }`}
                >
                  <input
                    id="username"
                    name="username"
                    type="text"
                    className="form-control input-border-bottom"
                    value={data.email}
                    onChange={(e) => setData("email", e.target.value)}
                  />
                  <label htmlFor="username" className="placeholder">
                    Username
                  </label>
                  {errors.email && (
                    <div className="form-text text-muted text-danger">
                      {errors.email}
                    </div>
                  )}
                </div>
                <div
                  className={`form-group form-floating-label mt-2 ${
                    errors.email ? "has-error" : ""
                  }`}
                >
                  <input
                    id="password"
                    name="password"
                    type="password"
                    className="form-control input-border-bottom"
                    value={data.password}
                    onChange={(e) => setData("password", e.target.value)}
                  />
                  <label htmlFor="password" className="placeholder">
                    Password
                  </label>
                  <div className="show-password">
                    <i className="fa fa-eye text-sm" />
                  </div>
                  {errors.password && (
                    <div className="form-text text-muted text-danger">
                      {errors.password}
                    </div>
                  )}
                </div>
                <div className="row form-sub m-0">
                  <div className="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      className="custom-control-input"
                      id="rememberme"
                      checked={data.remember}
                      onChange={(e) => setData("remember", e.target.checked)}
                    />
                    <label
                      className="custom-control-label"
                      htmlFor="rememberme"
                    >
                      Remember Me
                    </label>
                  </div>
                  <a href="#" className="link float-right">
                    Forget Password ?
                  </a>
                </div>
                <div className="form-action mb-3">
                  <button
                    disabled={processing}
                    type="submit"
                    className="btn btn-primary btn-rounded btn-login"
                  >
                    {processing && (
                      <div
                        className="spinner-border spinner-border-sm mr-2"
                        role="status"
                      >
                        <span className="sr-only">Loading...</span>
                      </div>
                    )}
                    Sign In
                  </button>
                </div>
                <div className="login-account">
                  <span className="msg mr-1">Don't have an account yet ?</span>
                  <a href="#" className="link">
                    Sign Up
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};
export default Login;
