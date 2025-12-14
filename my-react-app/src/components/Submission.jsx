import React, { useState } from 'react';

const Submission = () => {
  const [link, setLink] = useState('');
  const [submissions, setSubmissions] = useState([]);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!link.trim()) return;
    setSubmissions([{ link, date: new Date().toLocaleString() }, ...submissions]);
    setLink('');
  };

  return (
    <div style={{ padding: '2rem' }}>
      <h1>Final Project Submission</h1>
      <form onSubmit={handleSubmit} style={{ marginBottom: '2rem' }}>
        <input
          type="url"
          value={link}
          onChange={e => setLink(e.target.value)}
          placeholder="Paste your project link (e.g. GitHub, Vercel, Netlify)"
          style={{ width: '70%', padding: '0.75rem', borderRadius: '8px', border: '1px solid #cbd5e1', marginRight: '1rem' }}
          required
        />
        <button type="submit" style={{ background: '#22c55e', color: '#fff', border: 'none', borderRadius: '6px', padding: '0.75rem 1.5rem', cursor: 'pointer' }}>
          Submit
        </button>
      </form>
      <div>
        {submissions.length === 0 && <div>No submissions yet.</div>}
        {submissions.map((s, idx) => (
          <div key={idx} style={{ marginBottom: '1.5rem', background: '#f1f5f9', borderRadius: '8px', padding: '1rem' }}>
            <div style={{ fontSize: '0.9rem', color: '#64748b' }}>{s.date}</div>
            <a href={s.link} target="_blank" rel="noopener noreferrer">{s.link}</a>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Submission;
