import React, { useState } from 'react';
import Layout from '@/Shared/Templates/Layout';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import TextInput from '@/Shared/Form/TextInput';
import TextareaInput from '@/Shared/Form/TextareaInput';
import Select2 from '@/Shared/Form/Select2';
import FlashMessages from '@/Shared/components/FlashMessages';
import BackButton from '@/Shared/components/BackButton';
import Radio from '@/Shared/Form/Radio';
import SubmitButton from '@/Shared/Form/SubmitButton';
import Form from "../../../Modules/Log/Inertia/Form";

const Edit = () => {
  const props = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    id_user : props.log.id_user || "",
aktifitas : props.log.aktifitas || "",
  });
  function handleSubmit(e) {
    e.preventDefault();
    put(route('log.update', props.log.id_log));
  }

  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-12">
            <FlashMessages />
          </div>
          <div className="col-12 col-sm-6">
            <h4 className="page-title">Edit Log</h4>
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
                  <div className="card-title">Form Log</div>
                  <div className="card-category">
                    Isi semua form dibawah dengan benar
                  </div>
                </div>
                <div className="col-6 text-right"></div>
              </div>
              <div className="card-body">
                <form onSubmit={handleSubmit}>
                  <Form
                    data={data}
                    setData={setData}
                    processing={processing}
                  ></Form>
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

Edit.layout = page => <Layout children={page} title="Edit Log" />;
export default Edit;
