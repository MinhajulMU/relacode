import React, { useState } from "react";
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
import { Inertia } from "@inertiajs/inertia";
import BackButton from "@/Shared/components/BackButton";

const Index = () => {
  const props = usePage().props;
  const { headerField, data, order_field, order_mode } = usePage().props;
  const [deleteModal, setDeleteModal] = useState({
    show: false,
    url: "",
  });

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

  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-12">
            <FlashMessages />
          </div>
          <div className="col-6">
            <h4 className="page-title">Module</h4>
          </div>
          <div className="col-6 text-right">
            {props.parent_id != 0 && (
              <BackButton>{route("module.index")}</BackButton>
            )}
          </div>
        </div>
        <div className="row">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header row">
                <div className="col-6">
                  <div className="card-title">Manajemen Data Module</div>
                  <div className="card-category">Tabel Module</div>
                </div>
                <div className="col-6 text-right">
                  <AllowAction module="module" action="create">
                    <InertiaLink
                      href={
                        route("module.create") + "?parent_id=" + props.parent_id
                      }
                    >
                      <button className="btn btn-primary btn-round ml-auto">
                        <i className="fa fa-plus"></i> Tambah Module
                      </button>
                    </InertiaLink>
                  </AllowAction>
                </div>
              </div>
              <div className="card-body">
                <div className="table-responsive">
                  <FilterDatatable></FilterDatatable>
                  <table
                    id="add-row"
                    className="display table table-striped table-hover"
                  >
                    <thead>
                      <DatatableHeader
                        headerField={headerField}
                        order_field={order_field}
                        order_mode={order_mode}
                      ></DatatableHeader>
                    </thead>
                    <tbody>
                      {data.data.length > 0 ? (
                        data.data.map((items, index) => (
                          <tr key={index}>
                            <td>
                              {(data.current_page - 1) * data.per_page +
                                index +
                                1}
                            </td>
                            <td>{items.name}</td>
                            <td>{items.id_menu_grup}</td>
                            <td>{items.urutan}</td>
                            <td>
                              <i className={items.icon}></i>{" "}
                            </td>
                            <td>{items.slug}</td>
                            <td>{items.is_show == 1 ? "Ya" : "Tidak"}</td>
                            <td>
                              {props.parent_id == 0 ? (
                                <InertiaLink
                                  href={
                                    route("module.index") +
                                    "?parent_id=" +
                                    items.id_module
                                  }
                                >
                                  <button className="btn btn-primary btn-sm">
                                    <i className="fa fa-bars"></i> Submenu
                                  </button>
                                </InertiaLink>
                              ) : (
                                <button className="btn btn-secondary btn-sm">
                                  <i className="fa fa-bars"></i> Submenu
                                </button>
                              )}
                            </td>
                            <td>
                              <div className="form-button-action">
                                <AllowAction module="module" action="read">
                                  <Detail>
                                    {route("module.show", items.id_module)}
                                  </Detail>
                                </AllowAction>

                                <AllowAction module="module" action="update">
                                  <Edit>
                                    {route("module.edit", items.id_module)}
                                  </Edit>
                                </AllowAction>

                                <AllowAction module="module" action="delete">
                                  <Delete
                                    url={route(
                                      "module.destroy",
                                      items.id_module
                                    ).toString()}
                                    handleShowDeleteModal={
                                      handleShowDeleteModal
                                    }
                                  ></Delete>
                                </AllowAction>
                              </div>
                            </td>
                          </tr>
                        ))
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
                  <Pagination
                    data={data.links}
                    from={data.from}
                    to={data.to}
                    total={data.total}
                  ></Pagination>
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

Index.layout = (page) => <Layout children={page} title="Module" />;
export default Index;
