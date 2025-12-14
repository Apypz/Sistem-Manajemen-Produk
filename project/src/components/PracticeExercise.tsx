import { useEffect, useState } from 'react';
import { ArrowLeft, CheckCircle, Trophy, Loader } from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import type { PracticeExercise, PracticeQuestion, QuestionOption } from '../lib/supabase';
import { supabase } from '../lib/supabase';

interface PracticeExerciseProps {
  topicId: string;
  milestoneTitle: string;
  onBack: () => void;
}

interface QuestionWithOptions extends PracticeQuestion {
  options?: QuestionOption[];
}

export default function PracticeExercise({ topicId, milestoneTitle, onBack }: PracticeExerciseProps) {
  const { profile, refreshProfile } = useAuth();
  const [exercises, setExercises] = useState<PracticeExercise[]>([]);
  const [selectedExercise, setSelectedExercise] = useState<PracticeExercise | null>(null);
  const [questions, setQuestions] = useState<QuestionWithOptions[]>([]);
  const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
  const [answers, setAnswers] = useState<{ [key: string]: string }>({});
  const [loading, setLoading] = useState(true);
  const [showResults, setShowResults] = useState(false);
  const [score, setScore] = useState(0);
  const [submitting, setSubmitting] = useState(false);

  useEffect(() => {
    loadExercises();
  }, [topicId]);

  const loadExercises = async () => {
    const { data: exercisesData } = await supabase
      .from('practice_exercises')
      .select('*')
      .eq('topic_id', topicId)
      .order('order_index');

    setExercises(exercisesData || []);
    setLoading(false);
  };

  const loadExerciseQuestions = async (exerciseId: string) => {
    const { data: questionsData } = await supabase
      .from('practice_questions')
      .select('*')
      .eq('exercise_id', exerciseId)
      .order('order_index');

    if (questionsData) {
      const questionsWithOptions = await Promise.all(
        questionsData.map(async (question) => {
          const { data: optionsData } = await supabase
            .from('question_options')
            .select('*')
            .eq('question_id', question.id)
            .order('order_index');

          return {
            ...question,
            options: optionsData || [],
          };
        })
      );

      setQuestions(questionsWithOptions);
      setCurrentQuestionIndex(0);
      setAnswers({});
      setShowResults(false);
      setScore(0);
    }
  };

  const handleExerciseSelect = (exercise: PracticeExercise) => {
    setSelectedExercise(exercise);
    loadExerciseQuestions(exercise.id);
  };

  const handleAnswerSelect = (questionId: string, optionId: string) => {
    setAnswers({
      ...answers,
      [questionId]: optionId,
    });
  };

  const handleNextQuestion = () => {
    if (currentQuestionIndex < questions.length - 1) {
      setCurrentQuestionIndex(currentQuestionIndex + 1);
    }
  };

  const handlePreviousQuestion = () => {
    if (currentQuestionIndex > 0) {
      setCurrentQuestionIndex(currentQuestionIndex - 1);
    }
  };

  const handleSubmitExercise = async () => {
    setSubmitting(true);

    // Calculate score
    let correctAnswers = 0;
    for (const question of questions) {
      const selectedOptionId = answers[question.id];
      if (selectedOptionId) {
        const option = question.options?.find((opt) => opt.id === selectedOptionId);
        if (option?.is_correct) {
          correctAnswers++;
        }
      }
    }

    const percentage = (correctAnswers / questions.length) * 100;
    const pointsEarned = percentage >= 80 ? questions.length * 10 : 0; // Full points only if 80%+

    setScore(correctAnswers);
    setShowResults(true);

    // Save attempt
    if (selectedExercise && profile) {
      const { data: attempt, error: attemptError } = await supabase
        .from('practice_attempts')
        .insert({
          user_id: profile.id,
          exercise_id: selectedExercise.id,
          score: correctAnswers,
          total_questions: questions.length,
          points_earned: pointsEarned,
        })
        .select()
        .single();

      if (attempt && !attemptError) {
        // Save individual answers
        const answersToSave = questions.map((question) => {
          const selectedOptionId = answers[question.id];
          const option = question.options?.find((opt) => opt.id === selectedOptionId);
          return {
            attempt_id: attempt.id,
            question_id: question.id,
            selected_option_id: selectedOptionId || null,
            answer_text: null,
            is_correct: option?.is_correct || false,
          };
        });

        await supabase.from('practice_answers').insert(answersToSave);

        // Refresh profile to update points
        await refreshProfile();
      }
    }

    setSubmitting(false);
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50 flex items-center justify-center">
        <div className="animate-spin w-12 h-12 border-4 border-orange-500 border-t-transparent rounded-full"></div>
      </div>
    );
  }

  if (!selectedExercise) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
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
              <div className="text-xl font-bold">Practice Exercises</div>
            </div>
          </div>
        </nav>

        <div className="pt-24 px-6 pb-12">
          <div className="max-w-5xl mx-auto">
            {exercises.length === 0 ? (
              <div className="bg-white rounded-3xl shadow-xl p-12 text-center">
                <p className="text-2xl text-gray-600">No practice exercises available yet.</p>
              </div>
            ) : (
              <div className="grid md:grid-cols-2 gap-6">
                {exercises.map((exercise, index) => (
                  <button
                    key={exercise.id}
                    onClick={() => handleExerciseSelect(exercise)}
                    className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all text-left animate-slide-up"
                    style={{ animationDelay: `${index * 0.1}s` }}
                  >
                    <h3 className="text-2xl font-bold mb-3">{exercise.title}</h3>
                    <p className="text-gray-600 mb-4">{exercise.description}</p>
                    <div className="inline-block bg-gradient-to-r from-orange-500 to-pink-500 text-white px-4 py-2 rounded-lg font-semibold">
                      Start Practice
                    </div>
                  </button>
                ))}
              </div>
            )}
          </div>
        </div>
      </div>
    );
  }

  if (showResults) {
    const percentage = (score / questions.length) * 100;
    const pointsEarned = percentage >= 80 ? questions.length * 10 : 0;
    const passed = percentage >= 80;

    return (
      <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
        <nav className="fixed top-0 w-full z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
          <div className="max-w-7xl mx-auto px-6 py-4 flex items-center space-x-4">
            <button
              onClick={() => setSelectedExercise(null)}
              className="p-2 rounded-xl hover:bg-gray-100 transition-colors"
            >
              <ArrowLeft className="w-6 h-6" />
            </button>
            <div className="text-xl font-bold">Results</div>
          </div>
        </nav>

        <div className="pt-24 px-6 pb-12">
          <div className="max-w-2xl mx-auto">
            <div className="bg-white rounded-3xl shadow-xl p-12 text-center mb-8">
              <div className={`w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center ${passed ? 'bg-green-100' : 'bg-orange-100'}`}>
                {passed ? (
                  <CheckCircle className={`w-16 h-16 ${passed ? 'text-green-500' : 'text-orange-500'}`} />
                ) : (
                  <Trophy className="w-16 h-16 text-orange-500" />
                )}
              </div>

              <h2 className="text-4xl font-bold mb-4">
                {passed ? '🎉 Great Job!' : 'Keep Practicing!'}
              </h2>

              <div className="text-5xl font-bold text-orange-500 mb-4">
                {percentage.toFixed(0)}%
              </div>

              <p className="text-2xl text-gray-600 mb-8">
                You got <span className="font-bold">{score}/{questions.length}</span> correct
              </p>

              {pointsEarned > 0 && (
                <div className="bg-gradient-to-r from-orange-100 to-pink-100 rounded-2xl p-6 mb-8">
                  <div className="flex items-center justify-center space-x-2">
                    <Trophy className="w-6 h-6 text-orange-500" />
                    <span className="text-2xl font-bold text-orange-500">+{pointsEarned} Points Earned!</span>
                  </div>
                </div>
              )}

              {!passed && (
                <p className="text-gray-600 mb-8">
                  Get 80% or higher to earn points. Try again!
                </p>
              )}

              <button
                onClick={() => setSelectedExercise(null)}
                className="bg-gradient-to-r from-orange-500 to-pink-500 text-white px-8 py-4 rounded-xl font-bold hover:shadow-lg transition-all"
              >
                Back to Exercises
              </button>
            </div>
          </div>
        </div>
      </div>
    );
  }

  const currentQuestion = questions[currentQuestionIndex];

  return (
    <div className="min-h-screen bg-gradient-to-br from-orange-50 via-pink-50 to-cyan-50">
      <nav className="fixed top-0 w-full z-40 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div className="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
          <div className="flex items-center space-x-4">
            <button
              onClick={() => setSelectedExercise(null)}
              className="p-2 rounded-xl hover:bg-gray-100 transition-colors"
            >
              <ArrowLeft className="w-6 h-6" />
            </button>
            <div>
              <div className="text-sm text-gray-600">{selectedExercise.title}</div>
              <div className="text-xl font-bold">
                Question {currentQuestionIndex + 1} of {questions.length}
              </div>
            </div>
          </div>
          <div className="flex items-center space-x-2">
            <Trophy className="w-5 h-5 text-orange-500" />
            <span className="font-bold text-orange-500">{profile?.total_points} pts</span>
          </div>
        </div>
      </nav>

      <div className="pt-24 px-6 pb-12">
        <div className="max-w-3xl mx-auto">
          {/* Progress bar */}
          <div className="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div className="flex justify-between items-center mb-3">
              <span className="font-semibold text-gray-700">Progress</span>
              <span className="text-sm text-orange-500 font-bold">
                {currentQuestionIndex + 1}/{questions.length}
              </span>
            </div>
            <div className="h-2 bg-gray-200 rounded-full overflow-hidden">
              <div
                className="h-full bg-gradient-to-r from-orange-500 to-pink-500 transition-all duration-500"
                style={{ width: `${((currentQuestionIndex + 1) / questions.length) * 100}%` }}
              />
            </div>
          </div>

          {/* Question */}
          <div className="bg-white rounded-3xl shadow-xl p-8 mb-8 animate-slide-up">
            <h2 className="text-3xl font-bold mb-8 text-gray-900">
              {currentQuestion.question_text}
            </h2>

            {currentQuestion.question_type === 'multiple_choice' && (
              <div className="space-y-3">
                {currentQuestion.options?.map((option) => (
                  <button
                    key={option.id}
                    onClick={() => handleAnswerSelect(currentQuestion.id, option.id)}
                    className={`w-full text-left p-4 rounded-xl border-2 transition-all ${
                      answers[currentQuestion.id] === option.id
                        ? 'border-orange-500 bg-orange-50'
                        : 'border-gray-200 bg-white hover:border-orange-300'
                    }`}
                  >
                    <div className="flex items-center space-x-3">
                      <div
                        className={`w-6 h-6 rounded-full border-2 flex items-center justify-center ${
                          answers[currentQuestion.id] === option.id
                            ? 'border-orange-500 bg-orange-500'
                            : 'border-gray-300'
                        }`}
                      >
                        {answers[currentQuestion.id] === option.id && (
                          <div className="w-2 h-2 bg-white rounded-full"></div>
                        )}
                      </div>
                      <span className="font-semibold text-gray-900">{option.option_text}</span>
                    </div>
                  </button>
                ))}
              </div>
            )}
          </div>

          {/* Navigation */}
          <div className="flex justify-between items-center gap-4">
            <button
              onClick={handlePreviousQuestion}
              disabled={currentQuestionIndex === 0}
              className="px-6 py-3 rounded-xl bg-white shadow-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-xl transition-all"
            >
              Previous
            </button>

            <div className="flex gap-2">
              {questions.map((_, index) => (
                <div
                  key={index}
                  className={`w-10 h-10 rounded-lg flex items-center justify-center font-semibold cursor-pointer transition-all ${
                    index === currentQuestionIndex
                      ? 'bg-gradient-to-r from-orange-500 to-pink-500 text-white'
                      : answers[questions[index].id]
                      ? 'bg-green-100 text-green-700'
                      : 'bg-gray-100 text-gray-600'
                  }`}
                  onClick={() => setCurrentQuestionIndex(index)}
                >
                  {index + 1}
                </div>
              ))}
            </div>

            {currentQuestionIndex === questions.length - 1 ? (
              <button
                onClick={handleSubmitExercise}
                disabled={submitting || Object.keys(answers).length < questions.length}
                className="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-pink-500 text-white shadow-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-xl transition-all flex items-center gap-2"
              >
                {submitting ? (
                  <>
                    <Loader className="w-5 h-5 animate-spin" />
                    Submitting...
                  </>
                ) : (
                  'Submit'
                )}
              </button>
            ) : (
              <button
                onClick={handleNextQuestion}
                disabled={!answers[currentQuestion.id]}
                className="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-pink-500 text-white shadow-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-xl transition-all"
              >
                Next
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
