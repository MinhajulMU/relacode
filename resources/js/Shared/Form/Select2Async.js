import React, { useState } from 'react';
import { AsyncPaginate } from 'react-select-async-paginate';
import axios from 'axios';

const Select2Async = ({ label, name, className, errors = [], ...props }) => {
  const [value, setValue] = useState(null);
  console.log(value);
  async function loadOptions(search, loadedOptions, { page }) {
    let comboUrl = route('book.combo.read').toString();
    let options = [];
    let hasMore = false;
    await axios
      .get(comboUrl + `?field=title&initial=&page=${page}&count=10&q=${search}`)
      .then(response => {
        const { data, status } = response;
        options = data.data.data;
        hasMore = data.data.next_page_url == null ? false : true;
      });
    return {
      options: options,
      hasMore: hasMore,
      additional: {
        page: page + 1
      }
    };
  }

  return (
    <React.Fragment>
      <div className={`form-group ${errors.length ? 'has-error' : ''}`}>
        {label && <label htmlFor={name}>{label}</label>}
        <AsyncPaginate
          value={value}
          loadOptions={loadOptions}
          onChange={setValue}
          additional={{
            page: 1
          }}
        />
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};

export default Select2Async;
