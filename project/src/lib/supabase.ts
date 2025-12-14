import { createClient } from '@supabase/supabase-js';

const supabaseUrl = import.meta.env.VITE_SUPABASE_URL;
const supabaseAnonKey = import.meta.env.VITE_SUPABASE_ANON_KEY;

export const supabase = createClient(supabaseUrl, supabaseAnonKey);

export interface Profile {
  id: string;
  username: string;
  full_name: string;
  avatar_url: string;
  total_points: number;
  created_at: string;
  updated_at: string;
}

export interface Milestone {
  id: string;
  title: string;
  description: string;
  order_index: number;
  icon: string;
  color: string;
  created_at: string;
}

export interface Topic {
  id: string;
  milestone_id: string;
  title: string;
  description: string;
  video_url: string;
  order_index: number;
  points_reward: number;
  created_at: string;
}

export interface Task {
  id: string;
  topic_id: string;
  title: string;
  description: string;
  order_index: number;
  points_reward: number;
  created_at: string;
}

export interface Badge {
  id: string;
  title: string;
  description: string;
  icon: string;
  requirement_type: string;
  requirement_value: number;
  created_at: string;
}

export interface UserProgress {
  id: string;
  user_id: string;
  task_id: string;
  completed_at: string;
  points_earned: number;
}

export interface UserBadge {
  id: string;
  user_id: string;
  badge_id: string;
  earned_at: string;
}

export interface PracticeExercise {
  id: string;
  topic_id: string;
  title: string;
  description: string;
  order_index: number;
  created_at: string;
}

export interface PracticeQuestion {
  id: string;
  exercise_id: string;
  question_text: string;
  question_type: 'multiple_choice' | 'short_answer';
  order_index: number;
  created_at: string;
}

export interface QuestionOption {
  id: string;
  question_id: string;
  option_text: string;
  is_correct: boolean;
  order_index: number;
}

export interface PracticeAttempt {
  id: string;
  user_id: string;
  exercise_id: string;
  score: number;
  total_questions: number;
  points_earned: number;
  completed_at: string;
}

export interface PracticeAnswer {
  id: string;
  attempt_id: string;
  question_id: string;
  selected_option_id: string | null;
  answer_text: string | null;
  is_correct: boolean;
}
