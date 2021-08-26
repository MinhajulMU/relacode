import React from 'react';
const SubmitButton = ({ name, isLoading, ...props }) => {
  return (
    <React.Fragment>
      <button
        disabled={isLoading}
        className="btn btn-primary text-xs"
        type="submit"
        {...props}
      >
        {isLoading && (
          <div className="spinner-border spinner-border-sm mr-2" role="status">
            <span className="sr-only">Loading...</span>
          </div>
        )}
        {name}
      </button>
    </React.Fragment>
  );
};

export default SubmitButton;
