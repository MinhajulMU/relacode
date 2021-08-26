import React from 'react';

function Notification() {
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
          <i className="fa fa-bell" />
        </a>
        <ul
          className="dropdown-menu notif-box animated fadeIn"
          aria-labelledby="notifDropdown"
        >
          <li>
            <div className="dropdown-title">You have 4 new notification</div>
          </li>
          <li>
            <div className="notif-scroll scrollbar-outer">
              <div className="notif-center">
                <a href="#">
                  <div className="notif-icon notif-primary">
                    {' '}
                    <i className="fa fa-tag" />{' '}
                  </div>
                  <div className="notif-content">
                    <span className="block">New user registered</span>
                    <span className="time">5 minutes ago</span>
                  </div>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </li>
    </React.Fragment>
  );
}

export default Notification;
