import React, { useState } from 'react';
const Delete = ({url,handleShowDeleteModal}) => {
  return (
    <React.Fragment>
      <button
        type="button"
        className="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-gray"
      onClick={() => {
        handleShowDeleteModal(url)
      }}>
        <i className="fa fa-times" />
      </button>
    </React.Fragment>
  );
};

export default Delete;
