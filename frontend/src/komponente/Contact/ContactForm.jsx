import React, { useState } from 'react';
import './ContactForm.css';
import TextInput from './TextInput'; // Importujemo TextInput komponentu
import Navbar from '../Navbar/Navbar';
import Footer from '../Footer/Footer';

const ContactForm = ({messages,setMessages}) => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [message, setMessage] = useState('');
 
  const [alert, setAlert] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (name && email && message) {
      const newMessage = {
        name,
        email,
        message,
      };
      setMessages([...messages, newMessage]);
      setAlert('Message sent successfully!');
      setName('');
      setEmail('');
      setMessage('');
    } else {
      setAlert('Please fill in all fields.');
    }
  };

  return (
    <><Navbar/>
    <div className="contact-form-container">
      <h2>Contact Us</h2>
      <form onSubmit={handleSubmit} className="contact-form">
        <div className="input-container">
          <label>Name:</label>
          <TextInput  
            value={name}
            onChange={(e) => setName(e.target.value)}
            placeholder="Enter your name"
          />
        </div>
        <div className="input-container">
          <label>Email:</label>
          <TextInput  
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="Enter your email"
          />
        </div>
        <div className="input-container">
          <label>Message:</label>
          <textarea
            value={message}
            onChange={(e) => setMessage(e.target.value)}
          ></textarea>
        </div>
        <button type="submit" className="submit-button">
          Submit
        </button>
      </form>
      {alert && <div className="alert">{alert}</div>}
    </div>
    <Footer></Footer>
    </>
  );
};

export default ContactForm;
