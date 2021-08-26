import React, { useState, useEffect, useRef } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { usePrevious } from 'react-use';
import pickBy from 'lodash/pickBy';

const FilterDatatable = () => {
  const { search,per_page } = usePage().props;
  const urlSearchParams = new URLSearchParams(window.location.search);
  const params = Object.fromEntries(urlSearchParams.entries());
  delete params['page']; 
  delete params['search']; 
  delete params['per_page']; 
  //    let foo = params.get('per_page');

  const [values, setValues] = useState({
    per_page: per_page || '',
    search: search ||''
  });
  const prevValues = usePrevious(values);
  useEffect(() => {
    const query = values;
    if (prevValues) {
      Inertia.get(route(route().current()), {...query,...params}, {
        replace: true,
        preserveState: true
      });
    }
  }, [values]);
  const handleChange = e => {
    const key = e.target.name;
    const value = e.target.value;
    setValues(values => ({
      ...values,
      [key]: value
    }));

    Inertia.get(route(route().current()), {...values,...params}, {
      replace: true,
      preserveState: true
    });
  };

  return (
    <React.Fragment>
      <div className="flex mb-2">
        <div className="flex-1 flex">
          <span className="p-2">Show:</span>
          <div className="w-20">
            <select
              name="per_page"
              className="form-control"
              onChange={handleChange}
              value={values.per_page}
            >
              {[10, 25, 50, 100].map((items, index) => (
                <option value={items} key={index}  >
                  {items} 
                </option>
              ))}
            </select>
          </div>
        </div>
        <div className="flex-2">
          <div>
            <input
              className="form-control"
              name="search"
              value={values.search}
              onChange={handleChange}
              placeholder="Search something ..."
            />
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default FilterDatatable;
