import React from 'react'
import ReactDOM from 'react-dom/client'
import SideNav from './components/SideNav'
import NavBar from './components/NavBar'
import App from "./components/App"
import Movies from "./components/Movies"
import 'bootstrap/dist/css/bootstrap.css'


ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <App />
    <NavBar />
    <SideNav />
    <Movies/>
  </React.StrictMode>,
)