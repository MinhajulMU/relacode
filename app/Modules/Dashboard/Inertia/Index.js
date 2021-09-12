import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import FlashMessages from "@/Shared/components/FlashMessages";
import { Inertia } from "@inertiajs/inertia";

const Index = () => {
  const props = usePage().props;
  return (
    <React.Fragment>
      <div className="panel-header bg-primary-gradient">
        <div className="page-inner py-5">
          <div className="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
              <h2 className="text-white pb-2 fw-bold">Dashboard</h2>
            </div>
            <div className="ml-md-auto py-2 py-md-0"></div>
          </div>
        </div>
      </div>
      <div className="page-inner mt--5">
        <div className="row row-card-no-pd mt--2">
          <div className="col-sm-12 col-md-12">
            <div className="card card-stats card-round">
              <div className="card-body">
                <FlashMessages></FlashMessages>
                <div className="numbers">
                  <h4 className="card-title">
                    Hi <b>{props.auth.user.name}!</b>, Selamat Datang di {process.env.MIX_APP_NAME}.
                    Anda login sebagai <b>{props.auth.active_role.role_name}</b>
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

Index.layout = (page) => <Layout children={page} title="Dashboard" />;
export default Index;
