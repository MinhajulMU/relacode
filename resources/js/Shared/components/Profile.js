import React from "react";
import { InertiaLink, usePage } from "@inertiajs/inertia-react";
function Profile() {
  const { auth,id_user_asli } = usePage().props;
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
              src={auth.profile_photo}
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
                    src={auth.profile_photo}
                    alt="image profile"
                    className="avatar-img rounded"
                  />
                </div>
                <div className="u-text">
                  <h4>{auth.user.name}</h4>
                  <p className="text-muted"></p>
                  <InertiaLink
                    href={route("dashboard.profile.index")}
                    className="btn btn-xs btn-secondary btn-sm"
                  >
                    View Profile
                  </InertiaLink>
                </div>
              </div>
            </li>
            <li>
              <div className="dropdown-divider" />

              <InertiaLink
                href={route("dashboard.profile.index")}
                className="dropdown-item"
              >
                <span className="link-collapse">My Profile</span>
              </InertiaLink>
              {(id_user_asli != null ) ? (<InertiaLink
                href={route("dashboard.back-kamuflase.update")}
                className="dropdown-item mt-1"
              >
                <span className="link-collapse">Back From Kamuflase</span>
              </InertiaLink>) : ""}
              <div className="dropdown-divider" />
              <InertiaLink
                as="button"
                href={route("logout")}
                className="dropdown-item"
                method="post"
              >
                Logout
              </InertiaLink>
            </li>
          </div>
        </ul>
      </li>
    </div>
  );
}

export default Profile;
