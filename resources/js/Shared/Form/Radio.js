import React from 'react';

const Radio = ({ label, name, errors, value, choises, ...props }) => {
  return (
    <React.Fragment>
      <div className={`form-group ${errors ? 'has-error' : ''}`}>
        <label htmlFor="tes">{label}</label>
        <br />
        {choises.length > 0 &&
          choises.map((items, index) => (
            <span key={index}>
              <label className="form-radio-label">
                <input
                  className="form-radio-input mr-2"
                  type="radio"
                  name={name}
                  defaultValue={items.key}
                  defaultChecked={items.key === value && true }
                  {...props}
                />
                <span className="form-radio-sign">{items.value}</span>
              </label>
            </span>
          ))}
        {errors && (
          <div className="form-text text-muted text-danger">{errors}</div>
        )}
      </div>
    </React.Fragment>
  );
};

export default Radio;
