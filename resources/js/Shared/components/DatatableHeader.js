import React, { useState, useEffect, useRef } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import ReactHtmlParser from 'react-html-parser';
import { usePrevious } from 'react-use';

const DatatableHeader = () => {
  const { headerField, order_field, order_mode } = usePage().props;
  const urlSearchParams = new URLSearchParams(window.location.search);
  const params = Object.fromEntries(urlSearchParams.entries());
  delete params['order_field'];
  delete params['order_mode'];

  const [values, setValues] = useState({
    order_field: order_field || '',
    order_mode: order_mode || ''
  });

  const prevValues = usePrevious(values);
  useEffect(() => {
    const query = values;
    if (prevValues) {
      Inertia.get(
        route(route().current()),
        { ...query, ...params },
        {
          replace: true,
          preserveState: true
        }
      );
    }
  }, [values]);

  const changeOrderField = (event,field) => {
    if (order_field !== null) {
      if (order_field == field) {
        if (order_mode == 'asc') {
          setValues(values => ({
            ...values,
            order_mode: 'desc'
          }));
        } else {
          setValues(values => ({
            ...values,
            order_field: null
          }));
        }
      } else {
        setValues(values => ({
          ...values,
          order_field: field,
          order_mode: 'asc'
        }));
      }
    } else {
      setValues(values => ({
        ...values,
        order_field: field,
        order_mode: 'asc'
      }));
    }
    Inertia.get(
      route(route().current()),
      { ...values, ...params },
      {
        replace: true,
        preserveState: true
      }
    );
  };
  return (
    <React.Fragment>
      <tr className="border-t	border-solid border-gray-200">
        {headerField.map(({ name, field, sortable }) => (
          <th key={name}>
            <div className="flex">
              <div className="flex-1">{name}</div>

              <div
                className="flex-1 text-right text-gray-500 cursor-pointer"
                onClick={() => {
                  changeOrderField(this,field);
                }}
              >
                {sortable == true
                  ? ReactHtmlParser(
                      order_field == field
                        ? order_mode == 'asc'
                          ? "<i class='fa fa-sort-amount-up'></i>"
                          : "<i class='fa fa-sort-amount-down'></i>"
                        : "<i class='fa fa-sort'></i>"
                    )
                  : ''}
              </div>
            </div>
          </th>
        ))}
      </tr>
    </React.Fragment>
  );
};
export default DatatableHeader;
