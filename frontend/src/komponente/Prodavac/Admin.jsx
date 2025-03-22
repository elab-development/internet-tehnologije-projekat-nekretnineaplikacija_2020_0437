import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Bar } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend } from 'chart.js';

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
);

const Admin = () => {
  const [statistics, setStatistics] = useState(null);

  useEffect(() => {
    const fetchStatistics = async () => {
      console.log('Fetching statistics...');   
      try {
        const token = localStorage.getItem('token');  
        const response = await axios.get('http://127.0.0.1:8000/api/statistics', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        setStatistics(response.data);
      } catch (error) {
        console.error('Error fetching statistics:', error);
      }
    };
  
    fetchStatistics();
  }, []); 
  
  return (
    <div>
      <div style={{ height: '400px', marginBottom: '20px',marginLeft:"20%",marginRight:"20%" }}>
        <h2>Statistics - Rentals</h2>
        {statistics && statistics.top_properties && statistics.top_properties.length > 0 ? (
          <Bar
            key="rentals-bar-chart"
            data={{
              labels: statistics.top_properties.map(property => property.title),
              datasets: [{
                label: 'Number of Rentals',
                data: statistics.top_properties.map(property => property.reservations_count),
                backgroundColor: 'rgba(75,192,192,0.2)',
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 1
              }]
            }}
            options={{
              maintainAspectRatio: false,
              responsive: true,
              scales: {
                x: {
                  type: 'category',
                  ticks: {
                    beginAtZero: true
                  }
                },
                y: {
                  type: 'linear',
                  beginAtZero: true
                }
              }
            }}
            height={400} 
           
          />
        ) : (
          <p>Loading...</p>
        )}
      </div>
      <div style={{ height: '400px', marginBottom: '20px',marginLeft:"20%",marginRight:"20%" }}>
        <br />
        <br />
        <h2>Statistics - User Registrations</h2>
        {statistics && statistics.user_registrations && statistics.user_registrations.length > 0 ? (
          <Bar
            key="user-registrations-bar-chart"
            data={{
              labels: statistics.user_registrations.map(entry => `${entry.month}/${entry.year}`),
              datasets: [{
                label: 'New User Registrations',
                data: statistics.user_registrations.map(entry => entry.registrations_count),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
              }]
            }}
            options={{
              maintainAspectRatio: false,
              responsive: true,
              scales: {
                x: {
                  type: 'category',
                  ticks: {
                    beginAtZero: true
                  }
                },
                y: {
                  type: 'linear',
                  beginAtZero: true
                }
              }
            }}
            height={400}
           
          />
        ) : (
          <p>Loading...</p>
        )}
      </div>
    </div>
  );
};

export default Admin;
