import React, { useState } from 'react';
import './Mission.css';
import Scaffolding from './Scaffolding';

const scaffolds = [
  { name: 'HTML', sections: [
    { title: 'Introduction to HTML', video: 'https://www.youtube.com/embed/UB1O30fR-EE', task: 'Write a simple HTML page.' },
    { title: 'HTML Syntax', video: 'https://www.youtube.com/embed/pQN-pnXPaVg', task: 'Create a page with headings and paragraphs.' },
    { title: 'HTML Elements', video: '', task: 'List 5 HTML elements and their uses.' },
    { title: 'HTML Forms', video: '', task: 'Build a contact form.' },
    { title: 'HTML Best Practices', video: '', task: 'Describe 3 best practices for writing HTML.' }
  ]},
  { name: 'CSS', sections: [] },
  { name: 'JavaScript', sections: [] },
  { name: 'Github', sections: [] }
];

const Mission = () => {
  const [activeScaffold, setActiveScaffold] = useState(0);

  return (
    <div className="mission-container">
      <h1>Missions</h1>
      <div className="scaffold-tabs">
        {scaffolds.map((scaffold, idx) => (
          <button key={scaffold.name} className={activeScaffold === idx ? 'active' : ''} onClick={() => setActiveScaffold(idx)}>
            {scaffold.name}
          </button>
        ))}
      </div>
      <Scaffolding sections={scaffolds[activeScaffold].sections} />
    </div>
  );
};

export default Mission;
