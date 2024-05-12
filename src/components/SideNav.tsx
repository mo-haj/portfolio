import React, { Component } from 'react'
import './SideNav.css'

class SideNav extends Component {

    render(): React.ReactNode {
    return (
        <>  
    
    <div className="sidebar">
  <a className="active" href="#action">Action</a>
  <a href="#comedy">Comedy</a>
  <a href="#policy">Policy</a>
  <a href="#romantic" id="last-sec">Romantic</a>
</div>

    
    </>
  )
}
}
export default SideNav