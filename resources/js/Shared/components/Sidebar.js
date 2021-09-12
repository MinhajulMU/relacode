import React from "react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
import { runInContext } from "lodash";
function Sidebar() {
  const { auth } = usePage().props;
  let pathname = window.location.pathname;
  pathname.indexOf(1);
  pathname.toLowerCase();
  pathname = pathname.split("/")[1];
  return (
    <React.Fragment>
      <div className="sidebar">
        <div className="sidebar-wrapper scrollbar scrollbar-inner">
          <div className="sidebar-content">
            <div className="user">
              <div className="avatar-sm float-left mr-2">
                <img
                  src="/images/profile.jpg"
                  alt="..."
                  className="avatar-img rounded-circle"
                />
              </div>
              <div className="info">
                <a
                  data-toggle="collapse"
                  href="#collapseExample"
                  aria-expanded="true"
                >
                  <span>
                    {auth.user.name}
                    <span className="user-level">
                      {auth.active_role.role_name}
                    </span>
                    <span className="caret" />
                  </span>
                </a>
                <div className="clearfix" />
                <div className="collapse in" id="collapseExample">
                  <ul className="nav">
                    <li>
                      <InertiaLink href={route("dashboard.profile.index")}>
                        <span className="link-collapse">My Profile</span>
                      </InertiaLink>
                    </li>
                    <li>
                      <a href="#edit">
                        <span className="link-collapse">Edit Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="#settings">
                        <span className="link-collapse">Settings</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            {auth.menu != null && (
              <ul className="nav nav-primary">
                {auth.menu.grup_menu.length > 0 &&
                  auth.menu.grup_menu.map((items, index) => {
                    return (
                      <React.Fragment key={index}>
                        <li className="nav-section">
                          <span className="sidebar-mini-icon">
                            <i className="fa fa-ellipsis-h" />
                          </span>
                          <h4 className="text-section">{items.nm} </h4>
                        </li>
                        {items.menu_utama.length > 0 &&
                          items.menu_utama.map((items_menu, index_menu) => {
                            return (
                              <li
                                className={
                                  "nav-item " +
                                  (items_menu.slug == pathname ? "active" : "")
                                }
                                key={index_menu}
                              >
                                {items_menu.submenu == null ? (
                                  <InertiaLink href={items_menu.url}>
                                    <i className={items_menu.icon} />
                                    <p>{items_menu.nm} </p>
                                  </InertiaLink>
                                ) : (
                                  <React.Fragment>
                                    <a
                                      data-toggle="collapse"
                                      href={"#base" + index_menu}
                                    >
                                      <i className={items_menu.icon} />
                                      <p>{items_menu.nm}</p>
                                      <span className="caret" />
                                    </a>
                                    <div
                                      className={"collapse"}
                                      id={"base" + index_menu}
                                    >
                                      <ul className="nav nav-collapse">
                                        {items_menu.submenu.map(
                                          (items_submenu, index_submenu) => {
                                            return (
                                              <li key={index_submenu}>
                                                <InertiaLink
                                                  href={items_submenu.url}
                                                >
                                                  <span className="sub-item">
                                                    {items_submenu.nm}
                                                  </span>
                                                </InertiaLink>
                                              </li>
                                            );
                                          }
                                        )}
                                      </ul>
                                    </div>
                                  </React.Fragment>
                                )}
                              </li>
                            );
                          })}
                      </React.Fragment>
                    );
                  })}
              </ul>
            )}
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}

export default Sidebar;
