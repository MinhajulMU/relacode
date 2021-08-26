import { InertiaLink } from '@inertiajs/inertia-react';
import React, { useState } from 'react';

const BackButton = url => {
  return (
    <div>
      <InertiaLink href={url.children}>
        <button className="btn btn-secondary btn-round ml-auto">
          <i className="fa fa-arrow-left"></i> Kembali
        </button>
      </InertiaLink>
    </div>
  );
};

export default BackButton;
