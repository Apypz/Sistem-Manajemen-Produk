import { useEffect, useState } from 'react';
import { ArrowLeft, CheckCircle, Circle, Trophy, Video } from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import { supabase, Topic, Task } from '../lib/supabase';

interface TopicDetailProps {
  topicId: string;
  milestoneTitle: string;
  onBack: () => void;
  onPracticeClick?: () => void;
}

export default function TopicDetail({ topicId, milestoneTitle, onBack, onPracticeClick }: TopicDetailProps) {
  const { profile, refreshProfile } = useAuth();
  const [topic, setTopic] = useState<Topic | null>(null);
  const [tasks, setTasks] = useState<Task[]>([]);
  const [completedTasks, setCompletedTasks] = useState<Set<string>>(new Set());
  const [loading, setLoading] = useState(true);
  const [showConfetti, setShowConfetti] = useState(false);
  const [pointsNotification, setPointsNotification] = useState<{ show: boolean; points: number }>({ show: false, points: 0 });

  useEffect(() => {
    loadTopicData();
  }, [topicId]);

  const loadTopicData = async () => {
    const { data: topicData } = await supabase
      .from('topics')
      .select('*')
      .eq('id', topicId)
      .single();

    if (topicData) {
      setTopic(topicData);
    }

    const { data: tasksData } = await supabase
      .from('tasks')
      .select('*')
      .eq('topic_id', topicId)
      .order('order_index');

    if (tasksData) {
      setTasks(tasksData);
    }

    const { data: progressData } = await supabase
      .from('user_progress')
      .select('task_id')
      .eq('user_id', profile?.id)
      .in('task_id', tasksData?.map(t => t.id) || []);

    if (progressData) {
      setCompletedTasks(new Set(progressData.map(p => p.task_id)));
    }

    setLoading(false);
  };

  const handleCompleteTask = async (task: Task) => {
    if (completedTasks.has(task.id)) return;

    const { error } = await supabase
      .from('user_progress')
      .insert({
        user_id: profile?.id,
        task_id: task.id,
        points_earned: task.points_reward,
      });

    if (!error) {
      setCompletedTasks(new Set([...completedTasks, task.id]));
      await refreshProfile();
      
      // Show notification
      setPointsNotification({ show: true, points: task.points_reward });
      setTimeout(() => setPointsNotification({ show: false, points: 0 }), 2000);
      
      setShowConfetti(true);
      setTimeout(() => setShowConfetti(false), 2000);

      await checkAndAwardBadges();
    }
  };

  const checkAndAwardBadges = async () => {
    const { data: allProgress } = await supabase
      .from('user_progress')
      .select('*')
      .eq('user_id', profile?.id);

    const totalTasksCompleted = allProgress?.length || 0;
    const totalPoints = profile?.total_points || 0;

    const { data: badges } = await supabase
      .from('badges')
      .select('*');

    const { data: userBadges } = await supabase
      .from('user_badges')
      .select('badge_id')
      .eq('user_id', profile?.id);

    const earnedBadgeIds = new Set(userBadges?.map(ub => ub.badge_id));

    for (const badge of badges || []) {
      if (earnedBadgeIds.has(badge.id)) continue;

      let shouldAward = false;

      if (badge.requirement_type === 'tasks_completed' && totalTasksCompleted >= badge.requirement_value) {
        shouldAward = true;
      } else if (badge.requirement_type === 'points_earned' && totalPoints >= badge.requirement_value) {
        shouldAward = true;
      }

      if (shouldAward) {
        await supabase
          .from('user_badges')
          .insert({
            user_id: profile?.id,
            badge_id: badge.id,
          });
      }
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50 flex items-center justify-center">
        <div className="animate-spin w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full"></div>
      </div>
    );
  }

  const completedCount = completedTasks.size;
  const totalCount = tasks.length;
  const progress = (completedCount / totalCount) * 100;

  return (
    <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
      {showConfetti && (
        <div className="fixed inset-0 z-50 pointer-events-none">
          <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div className="text-6xl animate-scale-in">🎉</div>
          </div>
        </div>
      )}

      {pointsNotification.show && (
        <div className="fixed top-8 right-8 z-50 animate-bounce">
          <div className="bg-gradient-to-r from-orange-500 to-pink-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center space-x-2">
            <Trophy className="w-6 h-6" />
            <span className="font-bold text-lg">+{pointsNotification.points} Points!</span>
          </div>
        </div>
      )}

      <nav className="fixed top-0 w-full z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-6 py-4 flex items-center space-x-4">
          <button
            onClick={onBack}
            className="p-2 rounded-xl hover:bg-gray-100 transition-colors"
          >
            <ArrowLeft className="w-6 h-6" />
          </button>
          <div className="flex-1">
            <div className="text-sm text-gray-600">{milestoneTitle}</div>
            <div className="text-xl font-bold">{topic?.title}</div>
          </div>
          <div className="flex items-center space-x-2">
            <Trophy className="w-5 h-5 text-orange-500" />
            <span className="font-bold text-orange-500">{profile?.total_points} pts</span>
          </div>
        </div>
      </nav>

      <div className="pt-24 px-6 pb-12">
        <div className="max-w-5xl mx-auto">
          <div className="bg-white rounded-3xl shadow-xl overflow-hidden mb-8 animate-slide-up">
            <div className="aspect-video bg-gray-900 relative">
              <iframe
                src={topic?.video_url}
                className="w-full h-full"
                allowFullScreen
                title={topic?.title}
              />
            </div>
            <div className="p-8">
              <div className="flex items-center space-x-2 mb-4">
                <Video className="w-6 h-6 text-orange-500" />
                <span className="text-sm font-semibold text-orange-500">VIDEO LESSON</span>
              </div>
              <h1 className="text-4xl font-bold mb-4">{topic?.title}</h1>
              <p className="text-xl text-gray-600 mb-6">{topic?.description}</p>

              <div className="bg-gradient-to-r from-orange-50 to-pink-50 rounded-2xl p-6">
                <div className="flex justify-between items-center mb-3">
                  <span className="font-semibold">Your Progress</span>
                  <span className="text-orange-500 font-bold">{completedCount}/{totalCount} Tasks</span>
                </div>
                <div className="h-3 bg-white rounded-full overflow-hidden">
                  <div
                    className="h-full bg-gradient-to-r from-orange-500 to-pink-500 rounded-full transition-all duration-500"
                    style={{ width: `${progress}%` }}
                  />
                </div>
              </div>
            </div>
          </div>

          <div className="space-y-4">
            <div className="flex items-center justify-between mb-6">
              <h2 className="text-3xl font-bold">Complete These Tasks</h2>
              {onPracticeClick && (
                <button
                  onClick={onPracticeClick}
                  className="flex items-center space-x-2 px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-semibold hover:shadow-lg transition-all"
                >
                  <span>📝 Practice Exercises</span>
                </button>
              )}
            </div>
            {tasks.map((task, index) => {
              const isCompleted = completedTasks.has(task.id);
              return (
                <div
                  key={task.id}
                  className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all animate-slide-up"
                  style={{ animationDelay: `${index * 0.1}s` }}
                >
                  <div className="flex items-start space-x-4">
                    <button
                      onClick={() => handleCompleteTask(task)}
                      disabled={isCompleted}
                      className={`flex-shrink-0 mt-1 ${
                        isCompleted ? 'text-green-500' : 'text-gray-300 hover:text-orange-500'
                      } transition-colors`}
                    >
                      {isCompleted ? (
                        <CheckCircle className="w-8 h-8" />
                      ) : (
                        <Circle className="w-8 h-8" />
                      )}
                    </button>
                    <div className="flex-1">
                      <h3 className={`text-xl font-bold mb-2 ${isCompleted ? 'text-gray-400 line-through' : ''}`}>
                        {task.title}
                      </h3>
                      <p className={`text-gray-600 mb-3 ${isCompleted ? 'text-gray-400' : ''}`}>
                        {task.description}
                      </p>
                      <div className="flex items-center space-x-2">
                        <Trophy className="w-4 h-4 text-orange-500" />
                        <span className="text-sm font-semibold text-orange-500">
                          +{task.points_reward} points
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </div>
    </div>
  );
}
