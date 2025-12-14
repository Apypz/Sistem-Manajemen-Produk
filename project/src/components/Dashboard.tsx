import { useEffect, useState } from 'react';
import { Code, Palette, Sparkles, Trophy, User, LogOut, ChevronRight, CheckCircle } from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import { supabase, Milestone, Topic, UserProgress } from '../lib/supabase';

interface DashboardProps {
  onSelectTopic: (topicId: string, milestoneTitle: string) => void;
  onViewProfile: () => void;
}

export default function Dashboard({ onSelectTopic, onViewProfile }: DashboardProps) {
  const { profile, signOut } = useAuth();
  const [milestones, setMilestones] = useState<(Milestone & { topics: Topic[]; progress: number })[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadMilestones();
  }, []);

  const loadMilestones = async () => {
    const { data: milestonesData } = await supabase
      .from('milestones')
      .select('*')
      .order('order_index');

    if (milestonesData) {
      const milestonesWithTopics = await Promise.all(
        milestonesData.map(async (milestone) => {
          const { data: topics } = await supabase
            .from('topics')
            .select('*')
            .eq('milestone_id', milestone.id)
            .order('order_index');

          const topicsWithTasks = await Promise.all(
            (topics || []).map(async (topic) => {
              const { data: tasks } = await supabase
                .from('tasks')
                .select('*')
                .eq('topic_id', topic.id);

              const { data: progress } = await supabase
                .from('user_progress')
                .select('*')
                .eq('user_id', profile?.id)
                .in('task_id', (tasks || []).map(t => t.id));

              return {
                ...topic,
                totalTasks: tasks?.length || 0,
                completedTasks: progress?.length || 0,
              };
            })
          );

          const totalTasks = topicsWithTasks.reduce((sum, t) => sum + t.totalTasks, 0);
          const completedTasks = topicsWithTasks.reduce((sum, t) => sum + t.completedTasks, 0);
          const progress = totalTasks > 0 ? (completedTasks / totalTasks) * 100 : 0;

          return {
            ...milestone,
            topics: topics || [],
            progress,
          };
        })
      );

      setMilestones(milestonesWithTopics);
    }
    setLoading(false);
  };

  const getIconComponent = (iconName: string) => {
    const icons: { [key: string]: typeof Code } = {
      Code,
      Palette,
      Sparkles,
    };
    return icons[iconName] || Code;
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
          <div className="flex items-center space-x-4">
            <button
              onClick={onViewProfile}
              className="flex items-center space-x-2 px-4 py-2 rounded-xl bg-gradient-to-r from-orange-100 to-pink-100 hover:shadow-lg transition-all"
            >
              <User className="w-5 h-5" />
              <span className="font-semibold">{profile?.username}</span>
              <div className="px-3 py-1 rounded-full bg-gradient-to-r from-orange-500 to-pink-500 text-white text-sm font-bold">
                {profile?.total_points} pts
              </div>
            </button>
            <button
              onClick={signOut}
              className="p-2 rounded-xl hover:bg-gray-100 transition-colors"
            >
              <LogOut className="w-5 h-5" />
            </button>
          </div>
        </div>
      </nav>

      <div className="pt-24 px-6 pb-12">
        <div className="max-w-7xl mx-auto">
          <div className="mb-12 animate-slide-up">
            <h1 className="text-5xl font-bold mb-4">
              Welcome back, <span className="bg-gradient-to-r from-orange-500 to-pink-500 bg-clip-text text-transparent">{profile?.full_name}</span>
            </h1>
            <p className="text-xl text-gray-600">
              Continue your learning journey and level up your skills
            </p>
          </div>

          {loading ? (
            <div className="text-center py-20">
              <div className="animate-spin w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full mx-auto"></div>
            </div>
          ) : (
            <div className="space-y-8">
              {milestones.map((milestone, index) => {
                const Icon = getIconComponent(milestone.icon);
                return (
                  <div
                    key={milestone.id}
                    className="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all animate-slide-up"
                    style={{ animationDelay: `${index * 0.1}s` }}
                  >
                    <div className={`bg-gradient-to-r ${milestone.color} p-8`}>
                      <div className="flex items-center justify-between mb-4">
                        <div className="flex items-center space-x-4">
                          <div className="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <Icon className="w-8 h-8 text-white" />
                          </div>
                          <div>
                            <h2 className="text-3xl font-bold text-white">{milestone.title}</h2>
                            <p className="text-white/90">{milestone.description}</p>
                          </div>
                        </div>
                        <div className="text-right">
                          <div className="text-4xl font-bold text-white">{Math.round(milestone.progress)}%</div>
                          <div className="text-white/90">Complete</div>
                        </div>
                      </div>
                      <div className="h-3 bg-white/20 rounded-full overflow-hidden">
                        <div
                          className="h-full bg-white rounded-full transition-all duration-500"
                          style={{ width: `${milestone.progress}%` }}
                        />
                      </div>
                    </div>

                    <div className="p-8">
                      <div className="grid md:grid-cols-3 gap-6">
                        {milestone.topics.map((topic) => (
                          <button
                            key={topic.id}
                            onClick={() => onSelectTopic(topic.id, milestone.title)}
                            className="text-left p-6 rounded-2xl border-2 border-gray-200 hover:border-orange-300 hover:shadow-lg transition-all group"
                          >
                            <div className="flex justify-between items-start mb-3">
                              <h3 className="text-xl font-bold group-hover:text-orange-500 transition-colors">
                                {topic.title}
                              </h3>
                              <ChevronRight className="w-5 h-5 text-gray-400 group-hover:text-orange-500 group-hover:translate-x-1 transition-all" />
                            </div>
                            <p className="text-gray-600 text-sm mb-4">{topic.description}</p>
                            <div className="flex items-center justify-between">
                              <div className="flex items-center space-x-2 text-sm text-gray-500">
                                <Trophy className="w-4 h-4" />
                                <span>{topic.points_reward} pts</span>
                              </div>
                            </div>
                          </button>
                        ))}
                      </div>
                    </div>
                  </div>
                );
              })}
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
