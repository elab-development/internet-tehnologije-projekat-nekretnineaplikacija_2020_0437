import React, { useState, useEffect } from 'react';
import './HomePage.css';
import Navbar from '../Navbar/Navbar';
import Footer from '../Footer/Footer';

const HomePage = () => {
  const [randomImages, setRandomImages] = useState([]); 
  const [isLoading, setIsLoading] = useState(true);

   
  // const fetchRandomImages = async () => {
  //   const accessKey = '_dcS1nPF6IIONuQrJCArcuCg6u2EpN876eg2wHKZTNQ'; 
  //   const keywords = ['house', 'apartment', 'architecture', 'interior', 'building']; 
  //   const numberOfImages = 10;  
  //   const randomKeyword = keywords[Math.floor(Math.random() * keywords.length)];
  //   try {
      
  //     const response = await fetch(
  //       `https://api.unsplash.com/photos/random?count=${numberOfImages}&query=${randomKeyword}`,
  //       {
  //         headers: {
  //           Authorization: `Client-ID ${accessKey}`,
  //         },
  //       }
  //     );
      
  //     if (response.ok) {
  //       const data = await response.json();
  //       setRandomImages(data);
  //       setIsLoading(false);
  //     } else {
  //       console.error('Failed to fetch random images');
  //       setIsLoading(false);
  //     }
  //   } catch (error) {
  //     console.error('Error:', error);
  //     setIsLoading(false);
  //   }
  // };

  // useEffect(() => {
  //   fetchRandomImages();
  // }, []);

  // if (isLoading) {
  //   return <div>Loading...</div>;
  // }
  return (
    <>
   
    <div className="about">
      <header className="about-header">
        <h1>About Our Real Estate Agency</h1>
        <p>Trusted by Thousands Since 1999</p>
      </header>
      <section className="about-intro">
        <h2>Welcome to Our Agency</h2>
        <p>Our mission is to empower clients to make smart decisions about their home purchase or sale.</p>
      </section>
      <section className="about-content">
        <h3>Who We Are</h3>
        <p>We are a team of dedicated real estate professionals with over two decades of experience in helping clients find their dream homes.</p>
        <h3>What We Offer</h3>
        <p>Our portfolio includes a wide range of properties to fit every lifestyle and budget, from cozy apartments to luxury estates.</p>
        <h3>Why Choose Us</h3>
        <p>Our commitment to excellence and our client-first approach ensure that your buying or selling experience is seamless and rewarding.</p>
      </section>
      <section className="about-values">
        <h2>Our Values</h2>
        <div className="values-list">
          <div className="value">
            <h4>Integrity</h4>
            <p>We believe in honest and transparent dealings with all our clients.</p>
          </div>
          <div className="value">
            <h4>Expertise</h4>
            <p>Our agents are highly skilled and knowledgeable about the real estate market.</p>
          </div>
          <div className="value">
            <h4>Commitment</h4>
            <p>Your satisfaction is our top priority, and we work tirelessly to meet your needs.</p>
          </div>
        </div>
      </section>
      <section className="image-gallery">
        <h2>Random Real Estate Images</h2>
        {/* <div className="gallery">
          {randomImages.map((image) => (
            <img
              key={image.id}
              src={image.urls.regular}
              alt={image.alt_description}
              className="gallery-image"
            />
          ))}
        </div> */}
      </section>
    </div>
    <Footer></Footer>
    </>
  );
};

export default HomePage;
