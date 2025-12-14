import { useEffect, useState } from 'react';
import { ArrowLeft, Trophy, Award, Star, Code, Palette, Sparkles, Target, Crown, Edit2, Save, X } from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import { supabase, Badge } from '../lib/supabase';

interface ProfileProps {
  onBack: () => void;
}

interface BadgeWithStatus extends Badge {
  earned: boolean;
  earnedAt?: string;
}

export default function Profile({ onBack }: ProfileProps) {
  const { profile } = useAuth();
  const [badges, setBadges] = useState<BadgeWithStatus[]>([]);
  const [stats, setStats] = useState({
    totalTasks: 0,
    totalMilestones: 3,
    completedMilestones: 0,
  });
  const [loading, setLoading] = useState(true);
  const [isEditing, setIsEditing] = useState(false);
  const [editUsername, setEditUsername] = useState(profile?.username || '');
  const [editFullName, setEditFullName] = useState(profile?.full_name || '');
  const [isSaving, setIsSaving] = useState(false);

  useEffect(() => {
    loadProfileData();
  }, []);

  const loadProfileData = async () => {
    const { data: allBadges } = await supabase
      .from('badges')
      .select('*')
      .order('requirement_value');

    const { data: userBadges } = await supabase
      .from('user_badges')
      .select('*, badges(*)')
      .eq('user_id', profile?.id);

    const earnedBadgeIds = new Set(userBadges?.map(ub => ub.badge_id));

    const badgesWithStatus = (allBadges || []).map(badge => ({
      ...badge,
      earned: earnedBadgeIds.has(badge.id),
      earnedAt: userBadges?.find(ub => ub.badge_id === badge.id)?.earned_at,
    }));

    setBadges(badgesWithStatus);

    const { data: progressData } = await supabase
      .from('user_progress')
      .select('*')
      .eq('user_id', profile?.id);

    setStats({
      totalTasks: progressData?.length || 0,
      totalMilestones: 3,
      completedMilestones: 0,
    });

    setLoading(false);
  };

  const handleSaveProfile = async () => {
    if (!profile) return;
    setIsSaving(true);

    try {
      const { error } = await supabase
        .from('profiles')
        .update({
          username: editUsername,
          full_name: editFullName,
          updated_at: new Date().toISOString(),
        })
        .eq('id', profile.id);

      if (!error) {
        setIsEditing(false);
        // Refresh the page or update profile context
        window.location.reload();
      }
    } catch (error) {
      console.error('Error saving profile:', error);
    } finally {
      setIsSaving(false);
    }
  };

  const getBadgeIcon = (iconName: string) => {
    const icons: { [key: string]: typeof Trophy } = {
      Award,
      Star,
      Code,
      Palette,
      Sparkles,
      Trophy,
      Target,
      Crown,
    };
    return icons[iconName] || Trophy;
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50 flex items-center justify-center">
        <div className="animate-spin w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full"></div>
      </div>
    );
  }

  const earnedBadges = badges.filter(b => b.earned);
  const lockedBadges = badges.filter(b => !b.earned);

  return (
    <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
      <nav className="fixed top-0 w-full z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
          <div className="flex items-center space-x-4">
            <button
              onClick={onBack}
              className="p-2 rounded-xl hover:bg-gray-100 transition-colors"
            >
              <ArrowLeft className="w-6 h-6" />
            </button>
            <div className="text-xl font-bold">Profile</div>
          </div>
          {!isEditing && (
            <button
              onClick={() => {
                setEditUsername(profile?.username || '');
                setEditFullName(profile?.full_name || '');
                setIsEditing(true);
              }}
              className="p-2 rounded-xl hover:bg-gray-100 transition-colors flex items-center space-x-2 px-4 py-2"
            >
              <Edit2 className="w-5 h-5" />
              <span>Edit</span>
            </button>
          )}
        </div>
      </nav>

      <div className="pt-24 px-6 pb-12">
        <div className="max-w-5xl mx-auto">
          <div className="bg-white rounded-3xl shadow-xl overflow-hidden mb-8 animate-slide-up">
            {isEditing ? (
              <div className="bg-gradient-to-r from-orange-500 via-pink-500 to-purple-500 p-12 text-center">
                <div className="w-32 h-32 bg-white rounded-full mx-auto mb-6 flex items-center justify-center text-6xl">
                  {editUsername?.charAt(0).toUpperCase() || '?'}
                </div>
                <div className="mb-6">
                  <label className="block text-white/90 text-sm mb-2">Full Name</label>
                  <input
                    type="text"
                    value={editFullName}
                    onChange={(e) => setEditFullName(e.target.value)}
                    className="w-full max-w-md mx-auto px-4 py-2 rounded-lg text-gray-900 font-semibold"
                  />
                </div>
                <div className="mb-6">
                  <label className="block text-white/90 text-sm mb-2">Username</label>
                  <input
                    type="text"
                    value={editUsername}
                    onChange={(e) => setEditUsername(e.target.value)}
                    className="w-full max-w-md mx-auto px-4 py-2 rounded-lg text-gray-900 font-semibold"
                  />
                </div>
                <div className="flex gap-3 justify-center">
                  <button
                    onClick={handleSaveProfile}
                    disabled={isSaving}
                    className="inline-flex items-center space-x-2 bg-white text-orange-500 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 disabled:opacity-50"
                  >
                    <Save className="w-5 h-5" />
                    <span>{isSaving ? 'Saving...' : 'Save'}</span>
                  </button>
                  <button
                    onClick={() => setIsEditing(false)}
                    className="inline-flex items-center space-x-2 bg-white/20 text-white px-6 py-2 rounded-lg font-semibold hover:bg-white/30"
                  >
                    <X className="w-5 h-5" />
                    <span>Cancel</span>
                  </button>
                </div>
              </div>
            ) : (
              <div className="bg-gradient-to-r from-orange-500 via-pink-500 to-purple-500 p-12 text-center">
                <div className="w-32 h-32 bg-white rounded-full mx-auto mb-6 flex items-center justify-center text-6xl">
                  {profile?.username?.charAt(0).toUpperCase() || '?'}
                </div>
                <h1 className="text-4xl font-bold text-white mb-2">{profile?.full_name}</h1>
                <p className="text-2xl text-white/90 mb-6">@{profile?.username}</p>
                <div className="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full">
                  <Trophy className="w-6 h-6 text-white" />
                  <span className="text-3xl font-bold text-white">{profile?.total_points}</span>
                  <span className="text-white/90">Points</span>
                </div>
              </div>
            )}

            <div className="grid md:grid-cols-3 gap-6 p-8">
              <div className="text-center p-6 rounded-2xl bg-gradient-to-br from-orange-50 to-pink-50">
                <div className="text-4xl font-bold text-orange-500 mb-2">{stats.totalTasks}</div>
                <div className="text-gray-600">Tasks Completed</div>
              </div>
              <div className="text-center p-6 rounded-2xl bg-gradient-to-br from-cyan-50 to-blue-50">
                <div className="text-4xl font-bold text-cyan-500 mb-2">{earnedBadges.length}</div>
                <div className="text-gray-600">Badges Earned</div>
              </div>
              <div className="text-center p-6 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50">
                <div className="text-4xl font-bold text-green-500 mb-2">
                  {stats.completedMilestones}/{stats.totalMilestones}
                </div>
                <div className="text-gray-600">Milestones</div>
              </div>
            </div>
          </div>

          {earnedBadges.length > 0 && (
            <div className="mb-8">
              <h2 className="text-3xl font-bold mb-6 flex items-center space-x-3">
                <Trophy className="w-8 h-8 text-orange-500" />
                <span>Your Badges</span>
              </h2>
              <div className="grid md:grid-cols-4 gap-6">
                {earnedBadges.map((badge, index) => {
                  const Icon = getBadgeIcon(badge.icon);
                  return (
                    <div
                      key={badge.id}
                      className="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-all animate-scale-in"
                      style={{ animationDelay: `${index * 0.1}s` }}
                    >
                      <div className="w-20 h-20 bg-gradient-to-br from-orange-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4 animate-float">
                        <Icon className="w-10 h-10 text-white" />
                      </div>
                      <h3 className="font-bold text-lg mb-2">{badge.title}</h3>
                      <p className="text-sm text-gray-600 mb-3">{badge.description}</p>
                      <p className="text-xs text-green-600 font-semibold">
                        Earned {new Date(badge.earnedAt!).toLocaleDateString()}
                      </p>
                    </div>
                  );
                })}
              </div>
            </div>
          )}

          {lockedBadges.length > 0 && (
            <div>
              <h2 className="text-3xl font-bold mb-6 flex items-center space-x-3">
                <Target className="w-8 h-8 text-gray-400" />
                <span>Locked Badges</span>
              </h2>
              <div className="grid md:grid-cols-4 gap-6">
                {lockedBadges.map((badge, index) => {
                  const Icon = getBadgeIcon(badge.icon);
                  return (
                    <div
                      key={badge.id}
                      className="bg-white rounded-2xl shadow-lg p-6 text-center opacity-60 hover:opacity-100 transition-all"
                      style={{ animationDelay: `${index * 0.1}s` }}
                    >
                      <div className="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <Icon className="w-10 h-10 text-gray-400" />
                      </div>
                      <h3 className="font-bold text-lg mb-2">{badge.title}</h3>
                      <p className="text-sm text-gray-600 mb-3">{badge.description}</p>
                      <p className="text-xs text-gray-500 font-semibold">
                        {badge.requirement_type === 'tasks_completed' && `Complete ${badge.requirement_value} tasks`}
                        {badge.requirement_type === 'points_earned' && `Earn ${badge.requirement_value} points`}
                      </p>
                    </div>
                  );
                })}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
