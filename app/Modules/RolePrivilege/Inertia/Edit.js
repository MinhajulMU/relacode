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
import Form from "../../../Modules/RolePrivilege/Inertia/Form";

const Edit = () => {
  const props = usePage().props;
  const { data, setData, errors, put, processing } = useForm({
    can_create : props.rolePrivilege.can_create || "",
can_delete : props.rolePrivilege.can_delete || "",
can_read : props.rolePrivilege.can_read || "",
can_update : props.rolePrivilege.can_update || "",
can_validate : props.rolePrivilege.can_validate || "",
id_module : props.rolePrivilege.id_module || "",
id_role : props.rolePrivilege.id_role || "",
  });
  function handleSubmit(e) {
    e.preventDefault();
    put(route('role-privilege.update', props.rolePrivilege.id_role_privilege));
  }

  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-12">
            <FlashMessages />
          </div>
          <div className="col-12 col-sm-6">
            <h4 className="page-title">Edit Role Privilege</h4>
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
                  <div className="card-title">Form Role Privilege</div>
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

Edit.layout = page => <Layout children={page} title="Edit Role Privilege" />;
export default Edit;
