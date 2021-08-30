import React from "react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
function Sidebar() {
  const { auth } = usePage().props;
  console.log(auth);
  return (
    <React.Fragment>
      <div className="sidebar sidebar-style-2">
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
                      <a href="#profile">
                        <span className="link-collapse">My Profile</span>
                      </a>
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
                              <li className="nav-item" key={index_menu}>
                                <InertiaLink
                                  href={items_menu.url}
                                  data-toggle={"collapse"+index_menu}
                                >
                                  <i className="fas fa-home" />
                                  <p>{items_menu.nm}</p>
                                  {items_menu.submenu != null && (
                                    <span className="caret" />
                                  )}
                                </InertiaLink>
                                {items_menu.submenu != null && (
                                  <div className={"collapse"+index_menu} id="base">
                                    <ul className="nav nav-collapse">
                                      {items_menu.submenu.map(
                                        (items_submenu, index_submenu) => {
                                          return (
                                            <li key={index_submenu}>
                                              <InertiaLink href={items_submenu.url}>
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
                                )}
                              </li>
                            );
                          })}
                      </React.Fragment>
                    );
                  })}

                <li className="nav-item">
                  <a data-toggle="collapse" href="#base">
                    <i className="fas fa-layer-group" />
                    <p>Base</p>
                    <span className="caret" />
                  </a>
                  <div className="collapse" id="base">
                    <ul className="nav nav-collapse">
                      <li>
                        <a href="components/avatars.html">
                          <span className="sub-item">Avatars</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            )}
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}

export default Sidebar;
