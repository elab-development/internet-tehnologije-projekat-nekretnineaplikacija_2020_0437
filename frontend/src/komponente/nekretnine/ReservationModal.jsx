import React, { useState, useEffect } from 'react';
import './ReservationModal.css';
import axios from 'axios';

const ReservationModal = ({ onClose, property }) => {
  const [formData, setFormData] = useState({
    property_id: property.id, 
    start_date: '',
    end_date: ''
  });
  const [numberOfDays, setNumberOfDays] = useState(0);
  const [totalPrice, setTotalPrice] = useState(0);

  useEffect(() => {
    if (formData.start_date && formData.end_date) {
      const start = new Date(formData.start_date);
      const end = new Date(formData.end_date);
      const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1; // Dodajemo 1 jer treba uzeti u obzir i prvi dan
      setNumberOfDays(days);
    }
  }, [formData.start_date, formData.end_date]);

  useEffect(() => {
    if (property.price && numberOfDays) {
      const price = property.price * numberOfDays;
      console.log(price)
      setTotalPrice(price);
    }
  }, [property.price, numberOfDays]); 

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const token = localStorage.getItem('token');

    // Kreiranje Axios POST zahtjeva sa tokenom u zaglavlju
    axios.post('http://127.0.0.1:8000/api/purchase', formData, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
      .then(response => {
        console.log(response.data.message);
        alert(response.data.message)
        onClose(); // Zatvara modal nakon slanja rezervacije
      })
      .catch(error => {
        console.error(error.response.data);
        alert(error.response.data.message)
        // Ovdje možete dodati logiku za obradu greške
      });
  };

  return (
    <div className="reservation-modal">
      <div className="reservation-modal-content">
        <span className="close-button" onClick={onClose}>&times;</span>
        <h2>Rezervacija Nekretnine</h2>
        <form onSubmit={handleSubmit}> 
          <div className="form-group">
            <label>Start Date:</label>
            <input type="date" name="start_date" value={formData.start_date} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>End Date:</label>
            <input type="date" name="end_date" value={formData.end_date} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>Total Price:</label>
            <input type="text" value={`$${totalPrice}`} readOnly />
          </div>
          <button type="submit">Potvrdi Rezervaciju</button>
        </form>
      </div>
    </div>
  );
};

export default ReservationModal;
