import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import TextInput from "@/Shared/Form/TextInput";
import TextareaInput from "@/Shared/Form/TextareaInput";
import Select2 from "@/Shared/Form/Select2";
import FlashMessages from "@/Shared/components/FlashMessages";
import BackButton from "@/Shared/components/BackButton";
import Radio from "@/Shared/Form/Radio";
import SubmitButton from "@/Shared/Form/SubmitButton";
import Form from "../../../Modules/BackupDb/Inertia/Form";
import FileInput from "@/Shared/Form/FileInput";

const Restore = () => {
  const props = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    database: "",
  });
  function handleSubmit(e) {
    e.preventDefault();
    post(route("backup-db.store"));
  }

  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-12">
            <FlashMessages />
          </div>
          <div className="col-12 col-sm-6">
            <h4 className="page-title">Restore DB</h4>
          </div>
          <div className="col-12 col-sm-6 text-right">
            <BackButton>{props.routes.backUrl}</BackButton>
          </div>
        </div>
        <div className="row">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header row">
                <div className="col-12">
                  <div className="card-title">Form Restore DB</div>
                  <div className="card-category">
                    Isi semua form dibawah dengan benar
                  </div>
                </div>
                <div className="col-6 text-right"></div>
              </div>
              <div className="card-body">
                <form onSubmit={handleSubmit}>
                  <FileInput
                    className="w-full pb-8 pr-6 lg:w-1/2"
                    label="Database"
                    name="database"
                    errors={props.errors.database}
                    value={data.database}
                    onChange={(database) => setData("database", database)}
                  />
                  <SubmitButton
                    name="Restore"
                    isLoading={processing}
                  ></SubmitButton>
                </form>
              </div>
              <div className="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

Restore.layout = (page) => <Layout children={page} title="Restore DB" />;
export default Restore;
