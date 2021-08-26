import React from 'react';

function Profile() {
  return (
    <div>
      <li className="nav-item dropdown hidden-caret">
        <a
          className="dropdown-toggle profile-pic"
          data-toggle="dropdown"
          href="#"
          aria-expanded="false"
        >
          <div className="avatar-sm">
            <img
              src="/images/profile.jpg"
              alt="..."
              className="avatar-img rounded-circle"
            />
          </div>
        </a>
        <ul className="dropdown-menu dropdown-user animated fadeIn">
          <div className="dropdown-user-scroll scrollbar-outer">
            <li>
              <div className="user-box">
                <div className="avatar-lg">
                  <img
                    src="/images/profile.jpg"
                    alt="image profile"
                    className="avatar-img rounded"
                  />
                </div>
                <div className="u-text">
                  <h4>Hizrian</h4>
                  <p className="text-muted">hello@example.com</p>
                  <a
                    href="profile.html"
                    className="btn btn-xs btn-secondary btn-sm"
                  >
                    View Profile
                  </a>
                </div>
              </div>
            </li>
            <li>
              <div className="dropdown-divider" />
              <a className="dropdown-item" href="#">
                My Profile
              </a>
              <a className="dropdown-item" href="#">
                My Balance
              </a>
              <a className="dropdown-item" href="#">
                Inbox
              </a>
              <div className="dropdown-divider" />
              <a className="dropdown-item" href="#">
                Account Setting
              </a>
              <div className="dropdown-divider" />
              <a className="dropdown-item" href="#">
                Logout
              </a>
            </li>
          </div>
        </ul>
      </li>
    </div>
  );
}

export default Profile;
