import React from 'react';
import './Messages.css';
import Footer from '../Footer/Footer';
import Navbar from '../Navbar/Navbar';

const Messages = ({ messages, setMessages }) => {
  const handleDelete = (index) => {
    const updatedMessages = [...messages];
    updatedMessages.splice(index, 1);
    setMessages(updatedMessages);
  };

  return (
    <>
    <Navbar></Navbar>
    <div className="messages-container">
      <h2>Messages</h2>
      <table className="messages-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Action</th>  
          </tr>
        </thead>
        <tbody>
          {messages.map((message, index) => (
            <tr key={index}>
              <td>{message.name}</td>
              <td>{message.email}</td>
              <td>{message.message}</td>
              <td>
                <button onClick={() => handleDelete(index)}>Delete</button>  
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
    <Footer></Footer>
    </>
  );
};

export default Messages;
