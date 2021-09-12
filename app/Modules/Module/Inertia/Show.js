import React, { useState } from "react";
import Layout from "@/Shared/Templates/Layout";
import { InertiaLink, usePage, useForm } from "@inertiajs/inertia-react";
import BackButton from "@/Shared/components/BackButton";

const Show = ({ data, routes }) => {
  return (
    <React.Fragment>
      <div className="page-inner">
        <div className="page-header row">
          <div className="col-6">
            <h4 className="page-title">Detail Module</h4>
          </div>
          <div className="col-6 text-right">
            <BackButton>{routes.backUrl}</BackButton>
          </div>
        </div>
        <div className="row">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header row">
                <div className="col-6">
                  <div className="card-title">Detail Rincian Data</div>
                </div>
                <div className="col-6 text-right"></div>
              </div>
              <div className="card-body">
                <div className="container  pb-3">
                  <table>
                    <tbody>
                      <tr>
                        <td className="px-4 py-2 align-top">Name</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.name}</td>
                      </tr>

                      <tr>
                        <td className="px-4 py-2 align-top">Icon</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.icon}</td>
                      </tr>

                      <tr>
                        <td className="px-4 py-2 align-top">Slug</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.slug}</td>
                      </tr>

                      <tr>
                        <td className="px-4 py-2 align-top">Is Show</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.is_show}</td>
                      </tr>

                      <tr>
                        <td className="px-4 py-2 align-top">Menu Grup</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.id_menu_grup}</td>
                      </tr>

                      <tr>
                        <td className="px-4 py-2 align-top">Urutan</td>
                        <td className="px-4 py-2 align-top" width="10px">
                          :
                        </td>
                        <td className="px-4 py-2">{data.urutan}</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

Show.layout = (page) => <Layout children={page} title="Detail Module" />;
export default Show;
