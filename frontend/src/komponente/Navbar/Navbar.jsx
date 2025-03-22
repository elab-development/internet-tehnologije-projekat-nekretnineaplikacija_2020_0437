import React, { useEffect, useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';  
import './Navbar.css';

const Navbar = ({ token, setToken }) => {
  const [role, setRole] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
 
    if (token) {
      const userRole = localStorage.getItem('role');  
      setRole(userRole);  
    }
  }, [token]);

  const handleLogout = async () => {
    try {
      await axios.post('http://127.0.0.1:8000/api/logout', null, {
        headers: {
          Authorization: `Bearer ${token}`  
        }
      });  
      setToken(null);   
      navigate("/");
      localStorage.clear();
    } catch (error) {
      console.error('Error logging out:', error);
    }
  };

  return (
    <nav>
      <ul>
        <li>
          <Link to="/">Home</Link>
        </li>
        {token && role == 'kupac' && (
          <>
            <li>
              <Link to="/property-list">Property List</Link>
            </li>
            <li>
              <Link to="/contact">Contact</Link>
            </li>
           
            <li>
              <button onClick={handleLogout}>Logout</button>  
            </li>
          </>
        )}
        {token && role === 'prodavac' && (
          <>
            <li>
              <Link to="/adminpanel">Admin Panel</Link>
            </li>
            <li>
              <Link to="/property-management">Property Management</Link>
            </li>
            <li>
              <Link to="/messages">Messages</Link>
            </li>
            <li>
              <button onClick={handleLogout}>Logout</button>  
            </li>
          </>
        )}
        {!token && (
          <>
            <li>
              <Link to="/login">Login</Link>
            </li>
            <li>
              <Link to="/register">Register</Link>
            </li>
          </>
        )}
      </ul>
    </nav>
  );
};

export default Navbar;
