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
            <h4 className="page-title">Jenis Dokumen</h4>
          </div>
          <div className="col-6 text-right">{/* header content right */}</div>
        </div>
        <div className="row">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header row">
                <div className="col-6">
                  <div className="card-title">Manajemen Data Jenis Dokumen</div>
                  <div className="card-category">Tabel Jenis Dokumen</div>
                </div>
                <div className="col-6 text-right">
                  <AllowAction module="ref-jns-dokumen" action="create">
                    <InertiaLink href={route("ref-jns-dokumen.create")}>
                      <button className="btn btn-primary btn-round ml-auto">
                        <i className="fa fa-plus"></i> Tambah Jenis Dokumen
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
                                    <td>{items.nm_jns_dokumen}</td>
                            <td>
                              <div className="form-button-action">
                                <AllowAction module="ref-jns-dokumen" action="read">
                                  <Detail>
                                    {route("ref-jns-dokumen.show", items.id_jns_dokumen)}
                                  </Detail>
                                </AllowAction>

                                <AllowAction module="ref-jns-dokumen" action="update">
                                  <Edit>
                                    {route("ref-jns-dokumen.edit", items.id_jns_dokumen)}
                                  </Edit>
                                </AllowAction>

                                <AllowAction module="ref-jns-dokumen" action="delete">
                                  <Delete
                                    url={route(
                                      "ref-jns-dokumen.destroy",
                                      items.id_jns_dokumen
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

Index.layout = (page) => <Layout children={page} title="Jenis Dokumen" />;
export default Index;
