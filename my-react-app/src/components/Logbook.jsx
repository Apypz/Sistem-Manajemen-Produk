import React, { useState } from 'react';

const Logbook = () => {
  const [entries, setEntries] = useState([]);
  const [text, setText] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!text.trim()) return;
    const newEntry = {
      text,
      date: new Date().toLocaleString()
    };
    setEntries([newEntry, ...entries]);
    setText('');
  };

  return (
    <div style={{ padding: '2rem' }}>
      <h1>Captain's Log</h1>
      <form onSubmit={handleSubmit} style={{ marginBottom: '2rem' }}>
        <textarea
          value={text}
          onChange={e => setText(e.target.value)}
          placeholder="Write your log entry..."
          rows={4}
          style={{ width: '100%', padding: '1rem', borderRadius: '8px', border: '1px solid #cbd5e1' }}
        />
        <button type="submit" style={{ marginTop: '1rem', background: '#2563eb', color: '#fff', border: 'none', borderRadius: '6px', padding: '0.5rem 1.5rem', cursor: 'pointer' }}>
          Add Entry
        </button>
      </form>
      <div>
        {entries.length === 0 && <div>No log entries yet.</div>}
        {entries.map((entry, idx) => (
          <div key={idx} style={{ marginBottom: '1.5rem', background: '#f1f5f9', borderRadius: '8px', padding: '1rem' }}>
            <div style={{ fontSize: '0.9rem', color: '#64748b' }}>{entry.date}</div>
            <div style={{ marginTop: '0.5rem' }}>{entry.text}</div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Logbook;
