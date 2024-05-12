import React, { Component } from 'react'
import './NavBar.css'


class NavBar extends Component{
  state={clicked:false};
  handelClick = () =>{
    this.setState({clicked:!this.state.clicked})
  }
  render(): React.ReactNode {
  return (
    <div className="header">
    <nav className="navbar navbar-expand-lg navbar-light ">
      <div className='container'>
        <div className='row'>
        <div className='col-md-2 col-sm-2 col-xs-2'>
  <a className="navbar-brand " href="#"><img src='logo_main.png'></img></a>
  </div>
    <div className='col-md-4 col-sm-4 col-xs-2'></div>
    
    <div className="collapse navbar-collapse col-md-6 col-sm-6 col-xs-6 " id="navbarSupportedContent">
    <div id="small" onClick={this.handelClick}>
         <i id="bars show" className={this.state.clicked ? "fa-solid fa-times": "fa-solid fa-bars"}></i>
      </div>
      <ul id="navbar" className={this.state.clicked ? "navbar-nav mr-auto actives #navbar" : "navbar-nav mr-auto #navbar"} >
        <li className="nav-item active">
          <a className="nav-link act" href="#">Home</a>
        </li>
        <li className="nav-item active">
          <a className="nav-link " href="#">Contact As</a>
        </li>
        <li className="nav-item active">
          <a className="nav-link" href="#">FAQ</a>
        </li>
        <li className="nav-item active">
          <a className="nav-link" href="#">About As</a>
        </li>
      </ul>
      
    </div>
  </div>
 </div>
</nav>
    </div>
    
  )
}}

export default NavBar