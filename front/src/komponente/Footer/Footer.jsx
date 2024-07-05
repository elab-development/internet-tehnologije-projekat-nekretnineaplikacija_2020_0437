import React from 'react';
import './Footer.css';

const Footer = () => {
  return (
    <footer className="footer">
      <div className="social-media">
        <a href="#" className="social-link">Facebook</a>
        <a href="#" className="social-link">Twitter</a>
        <a href="#" className="social-link">Instagram</a>
      </div>
      <div className="contact-info">
        <div className="map-link">
          <a href="#">View Map</a>
        </div>
        <div className="contact-details">
          <p>Email: nekretnine@gmail.com</p>
          <p>Phone: +123 456 789</p>
          <p>Address: Ulica 1 </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
