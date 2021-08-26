import React from 'react';

function Sidebar() {
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
                    Hizrian
                    <span className="user-level">Administrator</span>
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
            <ul className="nav nav-primary">
              <li className="nav-item">
                <a href="#dashboard">
                  <i className="fas fa-home" />
                  <p>Dashboard</p>
                </a>
              </li>
              <li className="nav-section">
                <span className="sidebar-mini-icon">
                  <i className="fa fa-ellipsis-h" />
                </span>
                <h4 className="text-section">Components</h4>
              </li>
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
          </div>
        </div>
      </div>
    </React.Fragment>
  );
}

export default Sidebar;
