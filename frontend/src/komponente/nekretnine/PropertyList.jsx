import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './PropertyList.css';
import PropertyCard from './PropertyCard';
import ReactPaginate from 'react-paginate';
import Navbar from '../Navbar/Navbar';
import Footer from '../Footer/Footer';
import useNekretnine from '../customHooks/useNekretnine';

const PropertyList = () => {
  const { data: properties, isLoading, error } = useNekretnine('http://127.0.0.1:8000/api/properties');

  const [searchTerm, setSearchTerm] = useState('');
  const [selectedPropertyType, setSelectedPropertyType] = useState('');
  const [minPrice, setMinPrice] = useState('');
  const [maxPrice, setMaxPrice] = useState('');
  const [filteredProperties, setFilteredProperties] = useState([]);
  const [currentPage, setCurrentPage] = useState(0);
  const propertiesPerPage = 3;

  const applyFilters = (search, type, min, max) => {
    const filtered = properties.filter(property => {
      return (
        (search === '' || property.description.toLowerCase().includes(search.toLowerCase()) || property.title.toLowerCase().includes(search.toLowerCase())) &&
        (type === '' || property.propery_type.name === type) && //slovna greska je ovde bila, iz apija vracamo slucajno propery umesto property type
        (min === '' || parseInt(property.price) >= parseInt(min)) &&
        (max === '' || parseInt(property.price) <= parseInt(max))
      );
    });

    setFilteredProperties(filtered);
  };

  useEffect(() => {
    applyFilters(searchTerm, selectedPropertyType, minPrice, maxPrice);
  }, [properties, searchTerm, selectedPropertyType, minPrice, maxPrice]);

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
 console.log(filteredProperties[0])
  return (
    <>
      <Navbar></Navbar>
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
              <PropertyCard key={property.id} property={property}></PropertyCard>
            ))}
          </>
        )}
      </div> 
      <Footer></Footer>
    </>
  );
};

export default PropertyList;
