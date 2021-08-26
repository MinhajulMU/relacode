import React from 'react';

export default ({
  type,
  label,
  name,
  className,
  errors = [],
  ...props
}) => {
  return (
    <React.Fragment>
      <div className={`form-group ${errors.length ? 'has-error' : ''}`}>
        {label && <label htmlFor={name}>{label}</label>}
        <input
          type={type}
          className={`form-control ${className}`}
          {...props}
        />
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};
