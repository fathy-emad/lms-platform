import React, { useEffect } from 'react';

import './css/style.css';
import './charts/ChartjsConfig';
import AppRoutes from './routes/Routes';
// Import pages

function App() {

  useEffect(() => {
    document.querySelector('html').style.scrollBehavior = 'auto'
    window.scroll({ top: 0 })
    document.querySelector('html').style.scrollBehavior = ''
  }, [location.pathname]); // triggered on route change

  return (
    <>
        <AppRoutes></AppRoutes>
    </>
  );
}

export default App;
