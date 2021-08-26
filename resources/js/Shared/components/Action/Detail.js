import { InertiaLink } from '@inertiajs/inertia-react';
import React, { useState } from 'react';
const Detail = (url) => {
  return (
    <React.Fragment>
    <InertiaLink
      href={url.children.return}
      className="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-teal-700 rounded-lg dark:teal-yellow-200 focus:outline-none focus:shadow-outline-gray hover:no-underline"
      aria-label="Detail"
    >
      <i className="fa fa-eye"></i>
    </InertiaLink>
  </React.Fragment>
  )
};

export default Detail;
