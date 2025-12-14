import React from 'react';

const mockProfile = {
  username: 'student123',
  nickname: 'Master of HTML',
  badges: [
    { name: 'HTML Beginner', icon: '🏅' },
    { name: 'CSS Explorer', icon: '🎖️' },
    { name: 'JS Challenger', icon: '🥇' }
  ]
};

const Profile = () => {
  return (
    <div style={{ padding: '2rem' }}>
      <h1>Profile</h1>
      <div style={{ background: '#f1f5f9', borderRadius: '8px', padding: '1.5rem', marginBottom: '2rem' }}>
        <div><strong>Username:</strong> {mockProfile.username}</div>
        <div><strong>Nickname:</strong> {mockProfile.nickname}</div>
      </div>
      <h2>Badge Hallway</h2>
      <div style={{ display: 'flex', gap: '1.5rem', flexWrap: 'wrap' }}>
        {mockProfile.badges.length === 0 && <div>No badges yet.</div>}
        {mockProfile.badges.map((badge, idx) => (
          <div key={idx} style={{ background: '#fff', borderRadius: '8px', padding: '1rem 2rem', boxShadow: '0 2px 8px rgba(0,0,0,0.05)', textAlign: 'center' }}>
            <div style={{ fontSize: '2rem' }}>{badge.icon}</div>
            <div style={{ marginTop: '0.5rem', fontWeight: 'bold' }}>{badge.name}</div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Profile;
