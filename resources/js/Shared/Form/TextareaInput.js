import React from 'react';

export default ({label, name, className, errors = [], ...props }) => {
  return (
    <React.Fragment>
      <div className={`form-group ${errors.length ? 'has-error' : ''}`}>
        {label && <label htmlFor={name}>{label}</label>}
        <textarea className={`form-control ${className}`} {...props} ></textarea>
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};
