import { useState } from 'react';
import { Code, Palette, Sparkles, Trophy, Target, Zap } from 'lucide-react';
import AuthModal from './AuthModal';

interface LandingPageProps {
  onGetStarted: () => void;
}

export default function LandingPage({ onGetStarted }: LandingPageProps) {
  const [showAuthModal, setShowAuthModal] = useState(false);
  const [authMode, setAuthMode] = useState<'login' | 'signup'>('signup');

  const handleAuthClick = (mode: 'login' | 'signup') => {
    setAuthMode(mode);
    setShowAuthModal(true);
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
      <nav className="fixed top-0 w-full z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <div className="flex items-center space-x-2">
            <div className="w-10 h-10 bg-gradient-to-br from-orange-500 to-pink-500 rounded-xl flex items-center justify-center">
              <Code className="w-6 h-6 text-white" />
            </div>
            <span className="text-2xl font-bold bg-gradient-to-r from-orange-500 to-pink-500 bg-clip-text text-transparent">
              CodeQuest
            </span>
          </div>
          <div className="flex space-x-4">
            <button
              onClick={() => handleAuthClick('login')}
              className="px-6 py-2 rounded-xl font-semibold text-gray-700 hover:bg-gray-100 transition-colors"
            >
              Sign In
            </button>
            <button
              onClick={() => handleAuthClick('signup')}
              className="px-6 py-2 rounded-xl bg-gradient-to-r from-orange-500 to-pink-500 text-white font-semibold hover:shadow-lg hover:scale-105 transition-all"
            >
              Get Started
            </button>
          </div>
        </div>
      </nav>

      <section className="pt-32 pb-20 px-6">
        <div className="max-w-7xl mx-auto">
          <div className="grid lg:grid-cols-2 gap-12 items-center">
            <div className="animate-slide-up">
              <h1 className="text-6xl font-bold leading-tight mb-6">
                Level Up Your
                <span className="block bg-gradient-to-r from-orange-500 via-pink-500 to-cyan-500 bg-clip-text text-transparent">
                  Web Dev Skills
                </span>
              </h1>
              <p className="text-xl text-gray-600 mb-8 leading-relaxed">
                Learn HTML, CSS, and JavaScript through an epic gamified journey.
                Earn badges, unlock achievements, and become a web development master.
              </p>
              <button
                onClick={() => handleAuthClick('signup')}
                className="px-8 py-4 rounded-2xl bg-gradient-to-r from-orange-500 to-pink-500 text-white text-lg font-bold hover:shadow-2xl hover:scale-105 transition-all animate-pulse-glow"
              >
                Start Your Quest
              </button>
            </div>

            <div className="relative">
              <div className="relative z-10 grid grid-cols-2 gap-6">
                <div className="bg-white rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-2 animate-float">
                  <div className="w-14 h-14 bg-gradient-to-br from-orange-400 to-pink-500 rounded-2xl flex items-center justify-center mb-4">
                    <Code className="w-8 h-8 text-white" />
                  </div>
                  <h3 className="text-xl font-bold mb-2">HTML</h3>
                  <p className="text-gray-600">Master web structure</p>
                </div>

                <div className="bg-white rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-2 animate-float" style={{ animationDelay: '0.3s' }}>
                  <div className="w-14 h-14 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center mb-4">
                    <Palette className="w-8 h-8 text-white" />
                  </div>
                  <h3 className="text-xl font-bold mb-2">CSS</h3>
                  <p className="text-gray-600">Create stunning designs</p>
                </div>

                <div className="bg-white rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-2 animate-float" style={{ animationDelay: '0.6s' }}>
                  <div className="w-14 h-14 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center mb-4">
                    <Sparkles className="w-8 h-8 text-white" />
                  </div>
                  <h3 className="text-xl font-bold mb-2">JavaScript</h3>
                  <p className="text-gray-600">Add interactivity</p>
                </div>

                <div className="bg-white rounded-3xl p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-2 animate-float" style={{ animationDelay: '0.9s' }}>
                  <div className="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mb-4">
                    <Trophy className="w-8 h-8 text-white" />
                  </div>
                  <h3 className="text-xl font-bold mb-2">Badges</h3>
                  <p className="text-gray-600">Earn achievements</p>
                </div>
              </div>
              <div className="absolute inset-0 bg-gradient-to-br from-orange-200 to-pink-200 blur-3xl opacity-30" />
            </div>
          </div>
        </div>
      </section>

      <section className="py-20 px-6 bg-white">
        <div className="max-w-7xl mx-auto">
          <h2 className="text-4xl font-bold text-center mb-4">
            Why Choose CodeQuest?
          </h2>
          <p className="text-xl text-gray-600 text-center mb-16">
            The most engaging way to learn web development
          </p>

          <div className="grid md:grid-cols-3 gap-8">
            <div className="text-center p-8 rounded-3xl bg-gradient-to-br from-orange-50 to-pink-50 hover:shadow-xl transition-all">
              <div className="w-16 h-16 bg-gradient-to-br from-orange-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <Target className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-2xl font-bold mb-4">Structured Learning</h3>
              <p className="text-gray-600">
                Follow a clear path from beginner to advanced with our milestone-based curriculum
              </p>
            </div>

            <div className="text-center p-8 rounded-3xl bg-gradient-to-br from-cyan-50 to-blue-50 hover:shadow-xl transition-all">
              <div className="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <Trophy className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-2xl font-bold mb-4">Gamified Experience</h3>
              <p className="text-gray-600">
                Earn points, unlock badges, and compete on leaderboards as you progress
              </p>
            </div>

            <div className="text-center p-8 rounded-3xl bg-gradient-to-br from-green-50 to-emerald-50 hover:shadow-xl transition-all">
              <div className="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <Zap className="w-8 h-8 text-white" />
              </div>
              <h3 className="text-2xl font-bold mb-4">Hands-On Practice</h3>
              <p className="text-gray-600">
                Complete real coding challenges and build projects that showcase your skills
              </p>
            </div>
          </div>
        </div>
      </section>

      <section className="py-20 px-6 bg-gradient-to-br from-orange-500 via-pink-500 to-purple-500">
        <div className="max-w-4xl mx-auto text-center">
          <h2 className="text-5xl font-bold text-white mb-6">
            Ready to Start Your Journey?
          </h2>
          <p className="text-2xl text-white/90 mb-10">
            Join thousands of learners leveling up their web development skills
          </p>
          <button
            onClick={() => handleAuthClick('signup')}
            className="px-10 py-5 rounded-2xl bg-white text-pink-500 text-xl font-bold hover:shadow-2xl hover:scale-105 transition-all"
          >
            Begin Your Quest Now
          </button>
        </div>
      </section>

      <AuthModal
        isOpen={showAuthModal}
        onClose={() => setShowAuthModal(false)}
        initialMode={authMode}
      />
    </div>
  );
}
