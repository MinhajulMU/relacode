import React, { useState, useEffect } from "react";
import Flatpickr from "react-flatpickr";
import "flatpickr/dist/themes/dark.css";

export default ({ type, label, name, className, errors = [], ...props }) => {
  let options  = {};
  if (type == 'datetime') {
    options = {
      allowInput: true,
      dateFormat: "Y-m-d H:i",
    };
  }else if(type == 'date'){
    options = {
      allowInput: true,
      dateFormat: "Y-m-d",
    };
  }else if(type == 'time'){
    options = {
      allowInput: true,
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true
    };
  }
  return (
    <React.Fragment>
      <div className={`form-group ${errors.length ? "has-error" : ""}`}>
        {label && <label htmlFor={name}>{label}</label>}
        <Flatpickr data-enable-time={type=='datetime' ? true:false} options={options} {...props} className="form-control" />
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};
