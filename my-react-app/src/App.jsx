import './App.css'
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import Dashboard from './components/Dashboard';
import Mission from './components/Mission';
import Logbook from './components/Logbook';
import Submission from './components/Submission';
import Profile from './components/Profile';

function App() {
  return (
    <Router>
      <nav style={{ display: 'flex', gap: '1rem', padding: '1rem', background: '#e0e7ef' }}>
        <Link to="/">Dashboard</Link>
        <Link to="/mission">Mission</Link>
        <Link to="/logbook">Logbook</Link>
        <Link to="/submission">Submission</Link>
        <Link to="/profile">Profile</Link>
      </nav>
      <Routes>
        <Route path="/" element={<Dashboard />} />
        <Route path="/mission" element={<Mission />} />
        <Route path="/logbook" element={<Logbook />} />
        <Route path="/submission" element={<Submission />} />
        <Route path="/profile" element={<Profile />} />
      </Routes>
    </Router>
  );
}

export default App;
