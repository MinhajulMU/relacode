import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import FlashMessages from "@/Shared/components/FlashMessages";
import Select2 from "@/Shared/Form/Select2";
import SubmitButton from "@/Shared/Form/SubmitButton";
import { Inertia } from "@inertiajs/inertia";

const Index = () => {
  const props = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    id_user: "",
  });
  function handleSubmit(e) {
    e.preventDefault();
    post(route("kamuflase.store"));
  }
  return (
    <React.Fragment>
      <div className="panel-header bg-primary-gradient">
        <div className="page-inner py-5">
          <div className="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
              <h2 className="text-white pb-2 fw-bold">Kamuflase</h2>
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
                  <form onSubmit={handleSubmit}>
                    <Select2
                      label="Pilih pengguna yang akan anda kamuflase:"
                      name="id_user"
                      errors={props.errors.id_user}
                      data={props.ref_user}
                      selected={data.id_user}
                      onChange={(selectedOption) =>
                        setData("id_user", selectedOption.value)
                      }
                    ></Select2>
                    <div className="pl-2">
                      <SubmitButton
                        name="Kamuflase"
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
    </React.Fragment>
  );
};

Index.layout = (page) => <Layout children={page} title="Dashboard" />;
export default Index;
