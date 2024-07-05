 
import './App.css';
import HomePage from './komponente/pocetna/HomePage'; 
import PropertyList from './komponente/nekretnine/PropertyList';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import ContactForm from './komponente/Contact/ContactForm';
import Messages from './komponente/Messages/Messages';
import { useState } from 'react';
function App() {
  const [messages, setMessages] = useState([]);
  return (
    <div className="App">
    <BrowserRouter>
      
      <Routes>

        <Route path="/" element={<HomePage />} />
        <Route path="/messages" element={<Messages messages={messages} setMessages={setMessages}/>} />
        <Route path="/contact" element={<ContactForm messages={messages} setMessages={setMessages}/>} />
        <Route path="/property-list" element={<PropertyList />} />
      </Routes>
    </BrowserRouter>
  </div>
  );
}

export default App;
