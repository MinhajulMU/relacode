import React from 'react';
import { render } from 'react-dom';
import { InertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';
import * as Sentry from '@sentry/browser';
import Swal from 'sweetalert2'

const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timerProgressBar: true,
  didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Swal = Swal;
window.showNotification = (icon=null, title=null, timer=null) => {
  Toast.fire({
      icon: icon || 'success',
      title: title|| 'Berhasil',
      timer : timer === null ? 3000 : (timer * 1000)
  })
}

InertiaProgress.init({
  color: '#ED8936',
  showSpinner: true
});

Sentry.init({
  dsn: process.env.MIX_SENTRY_LARAVEL_DSN
});

const app = document.getElementById('app');

render(
  <InertiaApp
    initialPage={JSON.parse(app.dataset.page)}
    resolveComponent={name =>
      import(`./Pages/${name}`).then(module => module.default)
    }
  />,
  app
);
