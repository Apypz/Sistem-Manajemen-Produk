import { useState } from 'react';
import { useAuth } from './contexts/AuthContext';
import LandingPage from './components/LandingPage';
import Dashboard from './components/Dashboard';
import TopicDetail from './components/TopicDetail';
import PracticeExercise from './components/PracticeExercise';
import Profile from './components/Profile';

type View = 'landing' | 'dashboard' | 'topic' | 'practice' | 'profile';

function App() {
  const { user, loading } = useAuth();
  const [currentView, setCurrentView] = useState<View>('landing');
  const [selectedTopicId, setSelectedTopicId] = useState<string>('');
  const [selectedMilestoneTitle, setSelectedMilestoneTitle] = useState<string>('');

  if (loading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50 flex items-center justify-center">
        <div className="animate-spin w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full"></div>
      </div>
    );
  }

  if (!user) {
    return <LandingPage onGetStarted={() => setCurrentView('dashboard')} />;
  }

  if (currentView === 'topic' && selectedTopicId) {
    return (
      <TopicDetail
        topicId={selectedTopicId}
        milestoneTitle={selectedMilestoneTitle}
        onBack={() => setCurrentView('dashboard')}
        onPracticeClick={() => setCurrentView('practice')}
      />
    );
  }

  if (currentView === 'practice' && selectedTopicId) {
    return (
      <PracticeExercise
        topicId={selectedTopicId}
        milestoneTitle={selectedMilestoneTitle}
        onBack={() => setCurrentView('dashboard')}
      />
    );
  }

  if (currentView === 'profile') {
    return <Profile onBack={() => setCurrentView('dashboard')} />;
  }

  return (
    <Dashboard
      onSelectTopic={(topicId, milestoneTitle) => {
        setSelectedTopicId(topicId);
        setSelectedMilestoneTitle(milestoneTitle);
        setCurrentView('topic');
      }}
      onViewProfile={() => setCurrentView('profile')}
    />
  );
}

export default App;
