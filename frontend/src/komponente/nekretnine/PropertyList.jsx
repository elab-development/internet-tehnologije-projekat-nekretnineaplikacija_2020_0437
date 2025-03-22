// PropertyList.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './PropertyList.css';
import PropertyCard from './PropertyCard';
import ReactPaginate from 'react-paginate';
import Footer from '../Footer/Footer';
import useNekretnine from '../customHooks/useNekretnine';

const PropertyList = () => {
  const { data: properties, isLoading, error } = useNekretnine('http://127.0.0.1:8000/api/properties');
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedPropertyType, setSelectedPropertyType] = useState('');
  const [minPrice, setMinPrice] = useState('');
  const [maxPrice, setMaxPrice] = useState('');
  const [currentPage, setCurrentPage] = useState(0);
  const propertiesPerPage = 3;
  const [selectedCurrency, setSelectedCurrency] = useState('USD'); // Dodali smo state za odabranu valutu

  const currencies = ['USD', 'EUR', 'RSD']; // Lista podržanih valuta

  const handleCurrencyChange = (e) => {
    setSelectedCurrency(e.target.value);
  };

  const applyFilters = (property) => {
    const searchTermLowerCase = searchTerm.toLowerCase();
    const titleLowerCase = property.title.toLowerCase();
    const descriptionLowerCase = property.description.toLowerCase();

    const matchesSearch = titleLowerCase.includes(searchTermLowerCase) || descriptionLowerCase.includes(searchTermLowerCase);
    const matchesType = selectedPropertyType === '' || property.propery_type.name === selectedPropertyType;
    const matchesPriceRange = (minPrice === '' || parseInt(property.price) >= parseInt(minPrice)) &&
      (maxPrice === '' || parseInt(property.price) <= parseInt(maxPrice));

    return matchesSearch && matchesType && matchesPriceRange;
  };

  const filteredProperties = properties.filter(applyFilters);

  useEffect(() => {
    setCurrentPage(0); 
  }, [searchTerm, selectedPropertyType, minPrice, maxPrice]);

  const handleSearchChange = (e) => {
    setSearchTerm(e.target.value);
  };

  const handleTypeChange = (e) => {
    setSelectedPropertyType(e.target.value);
  };

  const handleMinPriceChange = (e) => {
    setMinPrice(e.target.value);
  };

  const handleMaxPriceChange = (e) => {
    setMaxPrice(e.target.value);
  };

  const handlePageChange = ({ selected }) => {
    setCurrentPage(selected);
  };

  const pageCount = Math.ceil(filteredProperties.length / propertiesPerPage);
  const offset = currentPage * propertiesPerPage;
  const currentProperties = filteredProperties.slice(offset, offset + propertiesPerPage);

  return (
    <>
      <div className="property-list">
        <div className="search-container">
          <input
            type="text"
            placeholder="Search by description or title"
            value={searchTerm}
            onChange={handleSearchChange}
          />
          <select
            value={selectedPropertyType}
            onChange={handleTypeChange}
          >
            <option value="">All Types</option>
            <option value="Stan">Stan</option>
            <option value="Kuća">Kuća</option>
            <option value="Apartman">Apartman</option>
            <option value="Vikendica">Vikendica</option>
            <option value="Poslovni prostor">Poslovni prostor</option>
          </select>
          <input
            type="number"
            placeholder="Min Price"
            value={minPrice}
            onChange={handleMinPriceChange}
          />
          <input
            type="number"
            placeholder="Max Price"
            value={maxPrice}
            onChange={handleMaxPriceChange}
          />
          <select value={selectedCurrency} onChange={handleCurrencyChange}>  
            {currencies.map(currency => (
              <option key={currency} value={currency}>{currency}</option>
            ))}
          </select>
        </div>
        {isLoading ? (
          <div>Loading...</div>
        ) : (
          <>
            <ReactPaginate
              previousLabel={'Previous'}
              nextLabel={'Next'}
              breakLabel={'...'}
              pageCount={pageCount}
              marginPagesDisplayed={2}
              pageRangeDisplayed={5}
              onPageChange={handlePageChange}
              containerClassName={'pagination'}
              activeClassName={'active'}
            />
            {currentProperties.map((property) => (
              <PropertyCard key={property.id} property={property} selectedCurrency={selectedCurrency} />  
            ))}
          </>
        )}
      </div>
      <Footer />
    </>
  );
};

export default PropertyList;
