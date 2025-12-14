import React, { useState } from 'react';

const Scaffolding = ({ sections }) => {
  const [completed, setCompleted] = useState(Array(sections.length).fill(false));
  const [points, setPoints] = useState(0);

  const handleComplete = idx => {
    if (!completed[idx]) {
      const updated = [...completed];
      updated[idx] = true;
      setCompleted(updated);
      setPoints(points + 10); // 10 points per task
    }
  };

  return (
    <div>
      <h2>Sections</h2>
      <div>Points: {points}</div>
      {sections.length === 0 && <div>No sections yet.</div>}
      {sections.map((section, idx) => (
        <div key={idx} style={{ marginBottom: '2rem', borderBottom: '1px solid #e5e7eb', paddingBottom: '1rem' }}>
          <h3>{section.title}</h3>
          {section.video && (
            <div style={{ margin: '1rem 0' }}>
              <iframe width="400" height="225" src={section.video} title={section.title} frameBorder="0" allowFullScreen></iframe>
            </div>
          )}
          <div><strong>Task:</strong> {section.task}</div>
          <button disabled={completed[idx]} onClick={() => handleComplete(idx)} style={{ marginTop: '1rem', background: completed[idx] ? '#94a3b8' : '#22c55e', color: '#fff', border: 'none', borderRadius: '6px', padding: '0.5rem 1rem', cursor: completed[idx] ? 'not-allowed' : 'pointer' }}>
            {completed[idx] ? 'Completed' : 'Mark as Complete'}
          </button>
        </div>
      ))}
    </div>
  );
};

export default Scaffolding;
