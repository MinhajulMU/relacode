import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import ReactHtmlParser from 'react-html-parser';

const Pagination = props => {
  return (
    <React.Fragment>
      {props.total > 0 ? (
        <div className="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
          <div>
            <p className="text-sm leading-5 text-blue-700">
              Showing
              <span className="font-medium"> {props.from} </span>to
              <span className="font-medium"> {props.to} </span>
              of
              <span className="font-medium"> {props.total}</span>
            </p>
          </div>
          <div>
            <nav aria-label="Page navigation example">
              <ul className="pagination justify-content-end">
                {props.data.map((items, index) => (
                  <li
                    className={
                      (items.active == true
                        ? 'page-item active'
                        : 'page-item') +
                      ' ' +
                      (items.url == null ? 'disabled' : '')
                    }
                    key={index}
                  >
                    <InertiaLink
                      className="page-link"
                      href={
                        (items.url == null ? '#' : items.url) +
                        (items.active == true ? '#' : '')
                      }
                      preserveScroll
                    >
                      {ReactHtmlParser(items.label)}
                    </InertiaLink>
                  </li>
                ))}
              </ul>
            </nav>
          </div>
        </div>
      ) : (
        ''
      )}
    </React.Fragment>
  );
};

export default Pagination;
