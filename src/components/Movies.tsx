import React, { Component,useState} from 'react';
import './Movies.css';
import './Pop-up.css';

const Movies = () => {
  
    const [showModal, setShowModal] = useState(false);
    const [selectedMovie, setSelectedMovie] = useState('');
  
    const handleMoreInfo = (movieTitle: React.SetStateAction<string>) => {
      setSelectedMovie(movieTitle);
      setShowModal(true);
      document.body.classList.add('active-modal');
    };
  
    const handleCloseModal = () => {
      setShowModal(false);
      document.body.classList.remove('active-modal');
    };
      return (
      <div className='box'>
      <div className="Container ">
        
      <div className ="row">
      <div className="col-md-4 ">
        <h1>Action</h1>
    </div>
      <div className="col-md-4 ">
       
      </div>
      <div className="col-md-4 ">
      <div className="input-group">
  <div className="form-outline" data-mdb-input-init>
    <input id="search-focus form-control" type="search" placeholder='Serach...'/>
    <label className="form-label"></label>
  </div>
  {/* <button type="button" className="btn btn-primary" data-mdb-ripple-init>
    <i className="fas fa-search"></i>
  </button> */}
</div>
      </div>
      </div>
      <div className="row">
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">X-Men (2000)</h5>
           <img src="6-X-Men_(2000).jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('X-Men (2000)')} className="btn btn-color">More Info</button>
           </div>
      </div>
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">X-Men Days of Future Past</h5>
           <img src="5-X-Men_Days_of_Future_Past.jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('X-Men Days of Future Past')} className="btn btn-color">More Info</button>
           </div>
      </div>
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">X-Men The Last Stand</h5>
           <img src="4-X-Men_The_Last_Stand.jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('X-Men The Last Stand')} className="btn btn-color">More Info</button>
           </div>
      </div>
      </div>
      <div className="row">
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">The Wolverine</h5>
           <img src="1-The_Wolverine.jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('The Wolverine')} className="btn btn-color">More Info</button>
           </div>
      </div>
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">X-Men Origins Wolverine</h5>
           <img src="2-X-Men_Origins_Wolverine.jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('X-Men Origins Wolverine')} className="btn btn-color">More Info</button>
           </div>
      </div>
      <div className="card col-md-3 col-xs-3">
      <h5 className="card-title">Logan</h5>
           <img src="3-Logan.jpg"  className="card-img-top images-movies" alt="..."/>
           <div className="card-body">
           <button onClick={() => handleMoreInfo('Logan')} className="btn btn-color">More Info</button>
           </div>
      </div>
     
          <div className='number'>
      <ul className="pagination"> 
        <li className="page-item">
          <a className="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li className="page-item"><a className="page-link" href="#">1</a></li>
        <li className="page-item"><a className="page-link" href="#">2</a></li>
        <li className="page-item"><a className="page-link" href="#">3</a></li>
        <li className="page-item">
          <a className="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </div>
    </div>
    </div>
    {showModal && (
        <div className="overlay" onClick={handleCloseModal}>
          <div className="modal-content">
            <button  className="close-modal" onClick={handleCloseModal}>&times;</button>
            <h2>{selectedMovie}</h2>
            <p>Wolverine, also known as Logan,
               is a fictional character appearing in American comic books published by Marvel Comics. 
               He is a mutant with animal-like senses, enhanced physical capabilities,
                and a powerful regenerative ability known as a healing factor.
                 Wolverine is often depicted as a gruff loner with a complex past,
                  including involvement with military and government organizations.
                   He is most commonly associated with the X-Men,
                    a team of superheroes fighting for peace and equality between mutants and humans. 
                    Wolverine's iconic adamantium claws and fierce demeanor make him one of Marvel's most enduring and popular characters,
                     beloved by fans for his resilience, loyalty, and inner struggle with his violent nature.
                     {selectedMovie}</p>
          </div>
        </div>
      )}
    </div>
  )
}


export default Movies