import React from 'react';
import './Dashboard.css';

const Dashboard = () => {
  return (
    <div className="dashboard-container">
      <h1>Welcome Back, Student!</h1>
      <div className="dashboard-summary">
        <div className="dashboard-missions">
          <h2>Your Missions</h2>
          {/* List of missions and progress */}
        </div>
        <div className="dashboard-points">
          <h2>Points & Badges</h2>
          {/* Points and badges display */}
        </div>
        <div className="dashboard-stats">
          <h2>Statistics</h2>
          {/* Statistics chart or summary */}
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
