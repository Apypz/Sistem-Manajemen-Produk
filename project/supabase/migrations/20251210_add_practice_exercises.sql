/*
  # Add Practice Exercises Schema

  1. New Tables
    - `practice_exercises`
      - `id` (uuid, primary key)
      - `topic_id` (uuid, references topics)
      - `title` (text)
      - `description` (text)
      - `order_index` (integer)
      - `created_at` (timestamptz)
    
    - `practice_questions`
      - `id` (uuid, primary key)
      - `exercise_id` (uuid, references practice_exercises)
      - `question_text` (text)
      - `question_type` (text) - 'multiple_choice', 'short_answer'
      - `order_index` (integer)
      - `created_at` (timestamptz)
    
    - `question_options`
      - `id` (uuid, primary key)
      - `question_id` (uuid, references practice_questions)
      - `option_text` (text)
      - `is_correct` (boolean)
      - `order_index` (integer)
    
    - `practice_attempts`
      - `id` (uuid, primary key)
      - `user_id` (uuid, references auth.users)
      - `exercise_id` (uuid, references practice_exercises)
      - `score` (integer)
      - `total_questions` (integer)
      - `points_earned` (integer)
      - `completed_at` (timestamptz)
    
    - `practice_answers`
      - `id` (uuid, primary key)
      - `attempt_id` (uuid, references practice_attempts)
      - `question_id` (uuid, references practice_questions)
      - `selected_option_id` (uuid, references question_options, nullable)
      - `answer_text` (text, nullable)
      - `is_correct` (boolean)
*/

-- Create practice_exercises table
CREATE TABLE IF NOT EXISTS practice_exercises (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  topic_id uuid REFERENCES topics ON DELETE CASCADE NOT NULL,
  title text NOT NULL,
  description text NOT NULL,
  order_index integer NOT NULL,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE practice_exercises ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view practice exercises"
  ON practice_exercises FOR SELECT
  TO authenticated
  USING (true);

-- Create practice_questions table
CREATE TABLE IF NOT EXISTS practice_questions (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  exercise_id uuid REFERENCES practice_exercises ON DELETE CASCADE NOT NULL,
  question_text text NOT NULL,
  question_type text NOT NULL CHECK (question_type IN ('multiple_choice', 'short_answer')),
  order_index integer NOT NULL,
  created_at timestamptz DEFAULT now()
);

ALTER TABLE practice_questions ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view practice questions"
  ON practice_questions FOR SELECT
  TO authenticated
  USING (true);

-- Create question_options table
CREATE TABLE IF NOT EXISTS question_options (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  question_id uuid REFERENCES practice_questions ON DELETE CASCADE NOT NULL,
  option_text text NOT NULL,
  is_correct boolean NOT NULL DEFAULT false,
  order_index integer NOT NULL
);

ALTER TABLE question_options ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Anyone can view question options"
  ON question_options FOR SELECT
  TO authenticated
  USING (true);

-- Create practice_attempts table
CREATE TABLE IF NOT EXISTS practice_attempts (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  user_id uuid REFERENCES auth.users ON DELETE CASCADE NOT NULL,
  exercise_id uuid REFERENCES practice_exercises ON DELETE CASCADE NOT NULL,
  score integer NOT NULL,
  total_questions integer NOT NULL,
  points_earned integer NOT NULL,
  completed_at timestamptz DEFAULT now()
);

ALTER TABLE practice_attempts ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Users can view own practice attempts"
  ON practice_attempts FOR SELECT
  TO authenticated
  USING (auth.uid() = user_id);

CREATE POLICY "Users can insert own practice attempts"
  ON practice_attempts FOR INSERT
  TO authenticated
  WITH CHECK (auth.uid() = user_id);

-- Create practice_answers table
CREATE TABLE IF NOT EXISTS practice_answers (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  attempt_id uuid REFERENCES practice_attempts ON DELETE CASCADE NOT NULL,
  question_id uuid REFERENCES practice_questions ON DELETE CASCADE NOT NULL,
  selected_option_id uuid REFERENCES question_options ON DELETE SET NULL,
  answer_text text,
  is_correct boolean NOT NULL
);

ALTER TABLE practice_answers ENABLE ROW LEVEL SECURITY;

CREATE POLICY "Users can view own practice answers"
  ON practice_answers FOR SELECT
  TO authenticated
  USING (
    auth.uid() = (
      SELECT user_id FROM practice_attempts WHERE id = attempt_id
    )
  );

CREATE POLICY "Users can insert own practice answers"
  ON practice_answers FOR INSERT
  TO authenticated
  WITH CHECK (
    auth.uid() = (
      SELECT user_id FROM practice_attempts WHERE id = attempt_id
    )
  );

-- Create trigger to auto-update points when practice is completed
CREATE OR REPLACE FUNCTION update_user_points_from_practice()
RETURNS TRIGGER AS $$
BEGIN
  UPDATE profiles
  SET total_points = total_points + NEW.points_earned,
      updated_at = now()
  WHERE id = NEW.user_id;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Create trigger
CREATE TRIGGER on_practice_completed
  AFTER INSERT ON practice_attempts
  FOR EACH ROW
  EXECUTE FUNCTION update_user_points_from_practice();
