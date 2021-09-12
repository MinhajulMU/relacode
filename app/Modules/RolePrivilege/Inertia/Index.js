import React, { useState, useEffect } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import FlashMessages from "@/Shared/components/FlashMessages";
import DatatableHeader from "@/Shared/components/DatatableHeader";
import Pagination from "@/Shared/components/Pagination";
import FilterDatatable from "@/Shared/components/FilterDatatable";
import Detail from "@/Shared/components/Action/Detail";
import Edit from "@/Shared/components/Action/Edit";
import Delete from "@/Shared/components/Action/Delete";
import AllowAction from "@/Shared/components/AllowAction";
import DeleteModal from "@/Shared/components/DeleteModal";
import BackButton from "@/Shared/components/BackButton";
import { Inertia } from "@inertiajs/inertia";
import { usePrevious } from "react-use";
import axios from "axios";

const Index = () => {
  const props = usePage().props;
  const urlSearchParams = new URLSearchParams(window.location.search);
  const params = Object.fromEntries(urlSearchParams.entries());
  delete params["search"];
  const [deleteModal, setDeleteModal] = useState({
    show: false,
    url: "",
  });
  const [values, setValues] = useState({
    search: props.search || "",
  });
  const prevValues = usePrevious(values);
  useEffect(() => {
    const query = values;
    if (prevValues) {
      Inertia.get(
        route(route().current()),
        { ...values, ...params },
        {
          replace: true,
          preserveState: true,
        }
      );
    }
  }, [values]);
  const handleChange = (e) => {
    const key = e.target.name;
    const value = e.target.value;
    setValues((values) => ({
      ...values,
      [key]: value,
    }));
  };
  const handleCloseDeleteModal = () =>
    setDeleteModal({ ...deleteModal, show: false });
  const handleShowDeleteModal = (deleteUrl) => {
    setDeleteModal({
      url: deleteUrl,
      show: true,
    });
  };
  const handleDeleteAction = () => {
    Inertia.delete(deleteModal.url);
    setDeleteModal({
      show: false,
    });
  };
  const togglePermission = (id_module, action) => {
    axios
      .post(route("role-privilege.store"), {
        _token: props.csrf,
        id_module: id_module,
        action: action,
        id_role: props.role.id_role,
      })
      .then((res) => {
        console.log(res);
        if (res.data.success == true) {
          window.showNotification(null, "Berhasil merubah data!", null);
        } else {
          window.showNotification("error", "Gagal merubah data!", null);
        }
        Inertia.get(
          route(route().current()),
          { ...values, ...params },
          {
            replace: true,
            preserveState: true,
          }
        );
      });
  };

  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-12">
            <FlashMessages />
          </div>
          <div className="col-6">
            <h4 className="page-title">Role Privilege</h4>
          </div>
          <div className="col-6 text-right">
            <BackButton>{route("role.index")}</BackButton>
          </div>
        </div>
        <div className="row">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header row">
                <div className="col-6">
                  <div className="card-title">
                    Daftar privileges untuk Role : <b>{props.role.role_name}</b>
                  </div>
                </div>
                <div className="col-6 text-right"></div>
                <div className="col-12">
                  <input
                    type="text"
                    name="search"
                    className="form-control"
                    placeholder="Search Module ..."
                    value={values.search}
                    onChange={handleChange}
                  ></input>
                </div>
              </div>
              <div className="card-body">
                <div className="table-responsive">
                  <table
                    id="add-row"
                    className="display table table-striped table-hover"
                  >
                    <thead>
                      <tr>
                        <th>Module</th>
                        <th>Can Read</th>
                        <th>Can Create</th>
                        <th>Can Update</th>
                        <th>Can Delete</th>
                        <th>Can Validate</th>
                      </tr>
                    </thead>
                    <tbody>
                      {props.data != 0 ? (
                        Object.keys(props.data).map(function (index) {
                          return (
                            <tr key={index}>
                              <td>{props.data[index].name} </td>
                              {Object.keys(props.data[index].privileges).map(
                                function (key) {
                                  return (
                                    <React.Fragment key={key}>
                                      <td>
                                        {props.data[index].privileges[key] !=
                                        true ? (
                                          <button
                                            className="btn btn-danger"
                                            onClick={() =>
                                              togglePermission(
                                                props.data[index].id_module,
                                                key
                                              )
                                            }
                                          >
                                            <i className="fa fa-times"></i>{" "}
                                            Disabled
                                          </button>
                                        ) : (
                                          <button
                                            className="btn btn-success"
                                            onClick={() =>
                                              togglePermission(
                                                props.data[index].id_module,
                                                key
                                              )
                                            }
                                          >
                                            <i className="fa fa-check"></i>{" "}
                                            Enabled
                                          </button>
                                        )}
                                      </td>
                                    </React.Fragment>
                                  );
                                }
                              )}
                            </tr>
                          );
                        })
                      ) : (
                        <tr>
                          <td colSpan={"100%"} className="text-center h-96">
                            <div className="flex items-center justify-center h-96">
                              <div className="space-y-10">
                                <i className="fa fa-sad-tear fa-3x"></i>
                                <br></br>
                                Can't find any Data
                              </div>
                            </div>
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <DeleteModal
        show={deleteModal.show}
        handleCloseDeleteModal={handleCloseDeleteModal}
        handleDeleteAction={handleDeleteAction}
      ></DeleteModal>
    </React.Fragment>
  );
};

Index.layout = (page) => <Layout children={page} title="Role Privilege" />;
export default Index;
