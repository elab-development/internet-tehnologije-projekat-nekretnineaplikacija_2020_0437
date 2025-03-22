import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './PropertyCard.css';
import Modal from './Modal';  
import ReservationModal from './ReservationModal'; 

const PropertyCard = ({ property, selectedCurrency }) => {
  const [showGalleryModal, setShowGalleryModal] = useState(false);
  const [showReservationModal, setShowReservationModal] = useState(false);
  const [exchangeRates, setExchangeRates] = useState(null); // Stanje za čuvanje koeficijenata konverzije

  useEffect(() => {
    const fetchExchangeRates = async () => {
      try {
        const response = await axios.get('https://api.exchangerate-api.com/v4/latest/USD'); // USD kao osnovna valuta
        setExchangeRates(response.data.rates); // Čuvamo koeficijente konverzije u stanju
      } catch (error) {
        console.error('Error fetching exchange rates:', error);
      }
    };

    fetchExchangeRates(); // Pozivamo funkciju za dohvatanje koeficijenata konverzije kada se komponenta mount-uje
  }, []);

  const openGalleryModal = () => {
    setShowGalleryModal(true);
  };

  const closeGalleryModal = () => {
    setShowGalleryModal(false);
  };

  const openReservationModal = () => {
    setShowReservationModal(true);
  };

  const closeReservationModal = () => {
    setShowReservationModal(false);
  };
 
  const convertPrice = () => {
    // Konvertujemo cenu u odabranu valutu ako su koeficijenti dostupni
    if (exchangeRates && property.price && exchangeRates[selectedCurrency]) {
      const convertedPrice = parseFloat(property.price) * exchangeRates[selectedCurrency];
      return convertedPrice.toFixed(2); // Zaokružujemo na dve decimale
    }
    return property.price; // Ako koeficijenti nisu dostupni, vraćamo originalnu cenu
  };

  return (
    <div className="property-card">
      <div className="property-header">
        <h3>{property.title}</h3>
      </div>
      <div className="property-content">
        <p>Description: {property.description}</p>
        <p>Price: {convertPrice()} {selectedCurrency}</p>
        <p>Bedrooms: {property.bedrooms}</p>
        <p>Property Type: {property.propery_type.name}</p>
        {property.images.length > 0 && (
          <div>
            <button onClick={openGalleryModal}>Show Gallery</button>
          </div>
        )}
      </div>
      <button onClick={openReservationModal}>Book</button>
      {showGalleryModal && (
        <Modal onClose={closeGalleryModal}>
          <h2>Image Gallery</h2>
          <div className="image-gallery">
            {property.images.map((image, index) => (
              <img key={index} src={image} alt={`Image ${index + 1}`} />
            ))}
          </div>
        </Modal>
      )}
      {showReservationModal && (
        <ReservationModal onClose={closeReservationModal} property={property} />
      )}
    </div>
  );
};

export default PropertyCard;
