import { InertiaLink } from '@inertiajs/inertia-react';
import React, { useState } from 'react';
const Edit = (data) => {
  return (
    <React.Fragment>
      <InertiaLink
        href={data.children.return}
        className="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-yellow-700 rounded-lg dark:text-yellow-200 focus:outline-none focus:shadow-outline-gray hover:no-underline"
        aria-label="Update"
      >
        <i className="fa fa-edit"></i>
      </InertiaLink>
    </React.Fragment>
  );
};

export default Edit;
