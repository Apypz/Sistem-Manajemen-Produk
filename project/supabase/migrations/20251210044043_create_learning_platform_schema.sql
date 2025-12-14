/*
  # Learning Platform Gamification Schema

  1. New Tables
    - `profiles`
      - `id` (uuid, primary key, references auth.users)
      - `username` (text, unique)
      - `full_name` (text)
      - `avatar_url` (text)
      - `total_points` (integer, default 0)
      - `created_at` (timestamptz)
      - `updated_at` (timestamptz)
    
    - `milestones`
      - `id` (uuid, primary key)
      - `title` (text) - HTML, CSS, JavaScript
      - `description` (text)
      - `order_index` (integer)
      - `icon` (text)
      - `color` (text)
      - `created_at` (timestamptz)
    
    - `topics`
      - `id` (uuid, primary key)
      - `milestone_id` (uuid, references milestones)
      - `title` (text)
      - `description` (text)
      - `video_url` (text)
      - `order_index` (integer)
      - `points_reward` (integer)
      - `created_at` (timestamptz)
    
    - `tasks`
      - `id` (uuid, primary key)
      - `topic_id` (uuid, references topics)
      - `title` (text)
      - `description` (text)
      - `order_index` (integer)
      - `points_reward` (integer)
      - `created_at` (timestamptz)
    
    - `badges`
      - `id` (uuid, primary key)
      - `title` (text)
      - `description` (text)
      - `icon` (text)
      - `requirement_type` (text) - 'tasks_completed', 'points_earned', 'milestone_completed'
      - `requirement_value` (integer)
      - `created_at` (timestamptz)
    
    - `user_progress`
      - `id` (uuid, primary key)
      - `user_id` (uuid, references auth.users)
      - `task_id` (uuid, references tasks)
      - `completed_at` (timestamptz)
      - `points_earned` (integer)
    
    - `user_badges`
      - `id` (uuid, primary key)
      - `user_id` (uuid, references auth.users)
      - `badge_id` (uuid, references badges)
      - `earned_at` (timestamptz)

  2. Security
    - Enable RLS on all tables
    - Add policies for authenticated users to read their own data
    - Add policies for users to update their own progress
    - Public read access for milestones, topics, tasks, and badges
*/

-- Create profiles table
CREATE TABLE IF NOT EXISTS profiles (
  id uuid PRIMARY KEY REFERENCES auth.users ON DELETE CASCADE,
  username text UNIQUE NOT NULL,
  full_name text NOT NULL,
  avatar_url text DEFAULT '',
  total_points integer DEFAULT 0,
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

ALTER TABLE profiles ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Users can view own profile"
  ON profiles FOR SELECT
  TO authenticated
  USING (auth.uid() = id);

CREATE POLICY "Users can view other profiles"
  ON profiles FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Users can update own profile"
  ON profiles FOR UPDATE
  TO authenticated
  USING (auth.uid() = id)
  WITH CHECK (auth.uid() = id);

-- Create milestones table
CREATE TABLE IF NOT EXISTS milestones (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  description text NOT NULL,
  order_index integer NOT NULL,
  icon text NOT NULL,
  color text NOT NULL,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE milestones ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view milestones"
  ON milestones FOR SELECT
  TO authenticated
  USING (true);

-- Create topics table
CREATE TABLE IF NOT EXISTS topics (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  milestone_id uuid REFERENCES milestones ON DELETE CASCADE NOT NULL,
  title text NOT NULL,
  description text NOT NULL,
  video_url text NOT NULL,
  order_index integer NOT NULL,
  points_reward integer DEFAULT 10,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE topics ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view topics"
  ON topics FOR SELECT
  TO authenticated
  USING (true);

-- Create tasks table
CREATE TABLE IF NOT EXISTS tasks (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  topic_id uuid REFERENCES topics ON DELETE CASCADE NOT NULL,
  title text NOT NULL,
  description text NOT NULL,
  order_index integer NOT NULL,
  points_reward integer DEFAULT 5,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE tasks ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view tasks"
  ON tasks FOR SELECT
  TO authenticated
  USING (true);

-- Create badges table
CREATE TABLE IF NOT EXISTS badges (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  description text NOT NULL,
  icon text NOT NULL,
  requirement_type text NOT NULL,
  requirement_value integer NOT NULL,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE badges ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view badges"
  ON badges FOR SELECT
  TO authenticated
  USING (true);

-- Create user_progress table
CREATE TABLE IF NOT EXISTS user_progress (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  user_id uuid REFERENCES auth.users ON DELETE CASCADE NOT NULL,
  task_id uuid REFERENCES tasks ON DELETE CASCADE NOT NULL,
  completed_at timestamptz DEFAULT now(),
  points_earned integer NOT NULL,
  UNIQUE(user_id, task_id)
);

ALTER TABLE user_progress ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Users can view own progress"
  ON user_progress FOR SELECT
  TO authenticated
  USING (auth.uid() = user_id);

CREATE POLICY "Users can insert own progress"
  ON user_progress FOR INSERT
  TO authenticated
  WITH CHECK (auth.uid() = user_id);

-- Create user_badges table
CREATE TABLE IF NOT EXISTS user_badges (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  user_id uuid REFERENCES auth.users ON DELETE CASCADE NOT NULL,
  badge_id uuid REFERENCES badges ON DELETE CASCADE NOT NULL,
  earned_at timestamptz DEFAULT now(),
  UNIQUE(user_id, badge_id)
);

ALTER TABLE user_badges ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Users can view own badges"
  ON user_badges FOR SELECT
  TO authenticated
  USING (auth.uid() = user_id);

CREATE POLICY "Users can view other user badges"
  ON user_badges FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Users can insert own badges"
  ON user_badges FOR INSERT
  TO authenticated
  WITH CHECK (auth.uid() = user_id);

-- Create function to update profile points
CREATE OR REPLACE FUNCTION update_user_points()
RETURNS TRIGGER AS $$
BEGIN
  UPDATE profiles
  SET total_points = total_points + NEW.points_earned,
      updated_at = now()
  WHERE id = NEW.user_id;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Create trigger to auto-update points
CREATE TRIGGER on_task_completed
  AFTER INSERT ON user_progress
  FOR EACH ROW
  EXECUTE FUNCTION update_user_points();