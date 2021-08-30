import React from "react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import { runInContext } from "lodash";

function Notification() {
  const props = usePage().props;
  const { auth } = usePage().props;
  return (
    <React.Fragment>
      <li className="nav-item dropdown hidden-caret mr-4">
        <a
          className="nav-link dropdown-toggle"
          href="#"
          id="notifDropdown"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i className="fa fa-user-tag" />
        </a>
        <ul
          className="dropdown-menu notif-box animated fadeIn"
          aria-labelledby="notifDropdown"
        >
          <li>
            <div className="dropdown-title">
              {auth.active_role.role_name} aktif
            </div>
          </li>
          {auth.roles.length > 0
            ? auth.roles.map((items, index) => {
                return (
                  <li key={index}>
                    <div className="notif-scroll scrollbar-outer">
                      <div className="notif-center">
                        <InertiaLink href={(auth.active_role.id_role == items.id_role ? "#" : route('dashboard.change-role.update',items.id_role))}>
                          <div className="notif-icon notif-primary">
                            <i className="fa fa-tag" />
                          </div>
                          <div className="notif-content">
                            <span className="block">{items.role_name}</span>
                            <span className="time">
                              {(auth.active_role.id_role == items.id_role ? "Active" : "Ubah ke "+items.role_name)}
                            </span>
                          </div>
                        </InertiaLink>
                      </div>
                    </div>
                  </li>
                );
              })
            : ""}
        </ul>
      </li>
    </React.Fragment>
  );
}

export default Notification;
