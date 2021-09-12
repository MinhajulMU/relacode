import React, { useState } from 'react';
import Select from 'react-select';

const Select2 = ({ label, name, data, selected, errors = [], ...props }) => {
  function search(nameKey, myArray) {
    for (var i = 0; i < myArray.length; i++) {
      if (myArray[i].value === nameKey) {
        return myArray[i];
      }
    }
  }
  if (typeof props.isMulti !== 'undefined') {
    var selectedData = selected;
  }else{
    var selectedData = search(selected, data);
  }

  return (
    <React.Fragment>
      <div className={`form-group ${errors.length ? 'has-error' : ''}`}>
        {label && <label htmlFor={name}>{label}</label>}
        <Select
          options={data}
          defaultValue={selectedData}
          isClearable={true}
          {...props}
        />
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};
export default Select2;
