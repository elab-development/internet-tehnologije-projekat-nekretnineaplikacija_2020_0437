import React from 'react';
import './PropertyCard.css';

const PropertyCard = ({ property }) => {
  return (
    <div className="property-card">
      <div className="property-header">
        <h3>{property.title}</h3>
      </div>
      <div className="property-content">
        <p>Description: {property.description}</p>
        <p>Price: {property.price}</p>
        <p>Bedrooms: {property.bedrooms}</p>
        <p>Property Type: {property.propery_type.name}</p>
      </div>
       
      
    </div>
  );
};

export default PropertyCard;
