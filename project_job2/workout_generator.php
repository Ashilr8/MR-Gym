<?php
session_start(); // Start the session at the beginning of the script

// Get BMI and BMI category from URL parameters
$bmi = $_GET['bmi'] ?? null;
$bmiCategory = $_GET['bmiCategory'] ?? null;

// Function to generate workout data (hardcoded for now)
function getWorkoutRoutine($bmiCategory) {
    $workoutRoutine = [];

    // Overweight Workout Plan (Gym Setting)
    if ($bmiCategory === 'Overweight') {
        $workoutRoutine = [
            [
                'exercise_name' => 'Treadmill Walking (Incline)',
                'description' => '30 minutes at a brisk pace with a moderate incline (5-8%).',
                'image_url' => 'treadmill.jpg',
                'video_url' => 'https://www.youtube.com/embed/yr1G4tekWvI'
            ],
            [
                'exercise_name' => 'Elliptical Trainer',
                'description' => '25 minutes at a moderate intensity, focusing on maintaining a consistent heart rate.',
                'image_url' => 'elliptical.jpg',
                'video_url' => 'https://www.youtube.com/embed/SWj_0ZxUnYg'
            ],
            [
                'exercise_name' => 'Seated Cable Rows',
                'description' => '3 sets of 12 reps. Focus on pulling with your back muscles.',
                'image_url' => 'seated_row.jpg',
                'video_url' => 'https://www.youtube.com/embed/IODxDxXJs4M'
            ],
            [
                'exercise_name' => 'Lat Pulldowns',
                'description' => '3 sets of 12 reps. Use a wide grip and pull the bar to your upper chest.',
                'image_url' => 'lat_pulldown.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ],
            [
                'exercise_name' => 'Leg Press',
                'description' => '3 sets of 15 reps. Keep your back flat against the seat.',
                'image_url' => 'leg_press.jpg',
                'video_url' => 'https://www.youtube.com/embed/vP7KJu9v6Ic'
            ],
            [
                'exercise_name' => 'Hamstring Curls (Machine)',
                'description' => '3 sets of 15 reps. Squeeze your hamstrings at the top of the movement.',
                'image_url' => 'hamstring_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/1Y6xakjMsOs'
            ],
            [
                'exercise_name' => 'Bicep Curls (Dumbbells)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'bicep_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/KWz9y0jB8RQ'
            ],
            [
                'exercise_name' => 'Triceps Pushdowns (Cable)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'tricep_pushdown.jpg',
                'video_url' => 'https://www.youtube.com/embed/vBexDLjR8ME'
            ],
            [
                'exercise_name' => 'Crunches',
                'description' => '3 sets of 20 reps. Focus on contracting your abdominal muscles.',
                'image_url' => 'crunch.jpg',
                'video_url' => 'https://www.youtube.com/embed/Xyd_fa5zoEU'
            ],
            [
                'exercise_name' => 'Plank',
                'description' => 'Hold for 30-60 seconds, repeat 3 times. Engage your core and maintain a straight line.',
                'image_url' => 'plank.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ]
        ];
    }
   // Overweight Workout Plan (Gym Setting)
    if ($bmiCategory === 'Underweight') {
        $workoutRoutine = [
            [
                'exercise_name' => 'Treadmill Walking (Incline)',
                'description' => '30 minutes at a brisk pace with a moderate incline (5-8%).',
                'image_url' => 'treadmill.jpg',
                'video_url' => 'https://www.youtube.com/embed/yr1G4tekWvI'
            ],
            [
                'exercise_name' => 'Elliptical Trainer',
                'description' => '25 minutes at a moderate intensity, focusing on maintaining a consistent heart rate.',
                'image_url' => 'elliptical.jpg',
                'video_url' => 'https://www.youtube.com/embed/SWj_0ZxUnYg'
            ],
            [
                'exercise_name' => 'Seated Cable Rows',
                'description' => '3 sets of 12 reps. Focus on pulling with your back muscles.',
                'image_url' => 'seated_row.jpg',
                'video_url' => 'https://www.youtube.com/embed/IODxDxXJs4M'
            ],
            [
                'exercise_name' => 'Lat Pulldowns',
                'description' => '3 sets of 12 reps. Use a wide grip and pull the bar to your upper chest.',
                'image_url' => 'lat_pulldown.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ],
            [
                'exercise_name' => 'Leg Press',
                'description' => '3 sets of 15 reps. Keep your back flat against the seat.',
                'image_url' => 'leg_press.jpg',
                'video_url' => 'https://www.youtube.com/embed/vP7KJu9v6Ic'
            ],
            [
                'exercise_name' => 'Hamstring Curls (Machine)',
                'description' => '3 sets of 15 reps. Squeeze your hamstrings at the top of the movement.',
                'image_url' => 'hamstring_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/1Y6xakjMsOs'
            ],
            [
                'exercise_name' => 'Bicep Curls (Dumbbells)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'bicep_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/KWz9y0jB8RQ'
            ],
            [
                'exercise_name' => 'Triceps Pushdowns (Cable)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'tricep_pushdown.jpg',
                'video_url' => 'https://www.youtube.com/embed/vBexDLjR8ME'
            ],
            [
                'exercise_name' => 'Crunches',
                'description' => '3 sets of 20 reps. Focus on contracting your abdominal muscles.',
                'image_url' => 'crunch.jpg',
                'video_url' => 'https://www.youtube.com/embed/Xyd_fa5zoEU'
            ],
            [
                'exercise_name' => 'Plank',
                'description' => 'Hold for 30-60 seconds, repeat 3 times. Engage your core and maintain a straight line.',
                'image_url' => 'plank.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ]
        ];
    }
    // Overweight Workout Plan (Gym Setting)
    if ($bmiCategory === 'Obese') {
        $workoutRoutine = [
            [
                'exercise_name' => 'Treadmill Walking (Incline)',
                'description' => '30 minutes at a brisk pace with a moderate incline (5-8%).',
                'image_url' => 'treadmill.jpg',
                'video_url' => 'https://www.youtube.com/embed/yr1G4tekWvI'
            ],
            [
                'exercise_name' => 'Elliptical Trainer',
                'description' => '25 minutes at a moderate intensity, focusing on maintaining a consistent heart rate.',
                'image_url' => 'elliptical.jpg',
                'video_url' => 'https://www.youtube.com/embed/SWj_0ZxUnYg'
            ],
            [
                'exercise_name' => 'Seated Cable Rows',
                'description' => '3 sets of 12 reps. Focus on pulling with your back muscles.',
                'image_url' => 'seated_row.jpg',
                'video_url' => 'https://www.youtube.com/embed/IODxDxXJs4M'
            ],
            [
                'exercise_name' => 'Lat Pulldowns',
                'description' => '3 sets of 12 reps. Use a wide grip and pull the bar to your upper chest.',
                'image_url' => 'lat_pulldown.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ],
            [
                'exercise_name' => 'Leg Press',
                'description' => '3 sets of 15 reps. Keep your back flat against the seat.',
                'image_url' => 'leg_press.jpg',
                'video_url' => 'https://www.youtube.com/embed/vP7KJu9v6Ic'
            ],
            [
                'exercise_name' => 'Hamstring Curls (Machine)',
                'description' => '3 sets of 15 reps. Squeeze your hamstrings at the top of the movement.',
                'image_url' => 'hamstring_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/1Y6xakjMsOs'
            ],
            [
                'exercise_name' => 'Bicep Curls (Dumbbells)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'bicep_curl.jpg',
                'video_url' => 'https://www.youtube.com/embed/KWz9y0jB8RQ'
            ],
            [
                'exercise_name' => 'Triceps Pushdowns (Cable)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'tricep_pushdown.jpg',
                'video_url' => 'https://www.youtube.com/embed/vBexDLjR8ME'
            ],
            [
                'exercise_name' => 'Crunches',
                'description' => '3 sets of 20 reps. Focus on contracting your abdominal muscles.',
                'image_url' => 'crunch.jpg',
                'video_url' => 'https://www.youtube.com/embed/Xyd_fa5zoEU'
            ],
            [
                'exercise_name' => 'Plank',
                'description' => 'Hold for 30-60 seconds, repeat 3 times. Engage your core and maintain a straight line.',
                'image_url' => 'plank.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ]
        ];
    }
     if ($bmiCategory === 'Normal weight') {
        $workoutRoutine = [
            [
                'exercise_name' => 'Treadmill Walking (Incline)',
                'description' => '30 minutes at a brisk pace with a moderate incline (5-8%).',
                'image_url' => 'treadmill.jpg',
                'video_url' => 'https://youtu.be/8i3Vrd95o2k'
            ],
            [
                'exercise_name' => 'Elliptical Trainer',
                'description' => '25 minutes at a moderate intensity, focusing on maintaining a consistent heart rate.',
                'image_url' => 'elliptical.jpg',
                'video_url' => 'https://youtu.be/E15Q3Z9J-Zg'
            ],
            [
                'exercise_name' => 'Seated Cable Rows',
                'description' => '3 sets of 12 reps. Focus on pulling with your back muscles.',
                'image_url' => 'seated_row.jpg',
                'video_url' => 'https://youtu.be/xQNrFHEMhI4'
            ],
            [
                'exercise_name' => 'Lat Pulldowns',
                'description' => '3 sets of 12 reps. Use a wide grip and pull the bar to your upper chest.',
                'image_url' => 'lat_pulldown.jpg',
                'video_url' => 'https://youtu.be/SALxEARiMkw'
            ],
            [
                'exercise_name' => 'Leg Press',
                'description' => '3 sets of 15 reps. Keep your back flat against the seat.',
                'image_url' => 'leg_press.jpg',
                'video_url' => 'https://youtu.be/cDGOn-yfKJA'
            ],
            [
                'exercise_name' => 'Hamstring Curls (Machine)',
                'description' => '3 sets of 15 reps. Squeeze your hamstrings at the top of the movement.',
                'image_url' => 'hamstring_curl.jpg',
                'video_url' => 'https://youtu.be/XMI4HDLZMf0'
            ],
            [
                'exercise_name' => 'Bicep Curls (Dumbbells)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'bicep_curl.jpg',
                'video_url' => 'https://youtu.be/c-LZ2FjWmJc'
            ],
            [
                'exercise_name' => 'Triceps Pushdowns (Cable)',
                'description' => '3 sets of 12 reps. Keep your elbows close to your body.',
                'image_url' => 'tricep_pushdown.jpg',
                'video_url' => 'https://youtu.be/_w-HpW70nSQ'
            ],
            [
                'exercise_name' => 'Crunches',
                'description' => '3 sets of 20 reps. Focus on contracting your abdominal muscles.',
                'image_url' => 'crunch.jpg',
                'video_url' => 'https://youtu.be/MKmrqcoCZ-M'
            ],
            [
                'exercise_name' => 'Plank',
                'description' => 'Hold for 30-60 seconds, repeat 3 times. Engage your core and maintain a straight line.',
                'image_url' => 'plank.jpg',
                'video_url' => 'https://www.youtube.com/embed/ASdvNktTrwc'
            ]
        ];
    }
    return $workoutRoutine;
}

// Fetch workout routine based on BMI category
if ($bmiCategory) {
    $workoutRoutine = getWorkoutRoutine($bmiCategory);
}

// BMI Chart Data (Hardcoded for now)
$bmiData = [
    'Underweight' => ['min' => 0, 'max' => 18.5, 'color' => '#f9ca24'],
    'Normal weight' => ['min' => 18.5, 'max' => 24.9, 'color' => '#26de81'],
    'Overweight' => ['min' => 25, 'max' => 29.9, 'color' => '#fd9644'],
    'Obese' => ['min' => 30, 'max' => 100, 'color' => '#eb3b5a'], // Adjusted max for obesity
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(12, 12, 218, 0.95), rgba(18, 19, 27, 0.78));
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

         /* Added Styles for BMI Display and Chart */
        .bmi-info {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        .bmi-chart {
            width: 100%;
            height: 30px;
            background-color: #eee;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .bmi-zone {
            position: absolute;
            top: 0;
            height: 100%;
            transition: width 0.3s ease;
        }

        .bmi-value-indicator {
            position: absolute;
            top: -5px;
            border-left: 2px dashed #fff;
            height: calc(100% + 10px);
            text-align: center;
            color: #fff;
            font-size: 0.8em;
            z-index: 10;
        }

        .workout-plan {
            margin-top: 20px;
        }

        .exercise {
            margin-bottom: 20px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
        }

        .exercise h3 {
            color: #fff;
            margin-bottom: 10px;
        }

        .exercise p {
            color: #ddd;
            line-height: 1.6;
        }

        .exercise img, .exercise iframe {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        .no-workout {
            text-align: center;
            font-style: italic;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Personalized Gym Workout Plan</h1>

          <!-- Display BMI and Category -->
        <?php if ($bmi && $bmiCategory): ?>
            <div class="bmi-info">
                <p>Your BMI: <?php echo htmlspecialchars(round($bmi, 2)); ?></p>
                <p>Category: <?php echo htmlspecialchars($bmiCategory); ?></p>
            </div>

            <!-- BMI Chart -->
            <div class="bmi-chart">
                <?php
                $totalRange = 0;
                foreach ($bmiData as $zone => $data) {
                    $totalRange += ($data['max'] - $data['min']);
                }
                $currentBmi = round($bmi, 2);

                // Calculate the indicator position based on the current BMI value
                $indicatorPosition = 0;
                foreach ($bmiData as $zone => $data) {
                     if ($currentBmi > $data['min'] && $currentBmi <= $data['max']) {
                           $indicatorPosition = (($currentBmi - $data['min']) / ($data['max'] - $data['min']));
                           break;
                      }
                }
                $indicatorPosition *=100;

                $position = 0; // Keep track of cumulative position
                foreach ($bmiData as $zone => $data):
                    $width = (($data['max'] - $data['min']) / $totalRange) * 100;
                    ?>
                    <div class="bmi-zone" style="left: <?php echo $position; ?>%; width: <?php echo $width; ?>%; background-color: <?php echo $data['color']; ?>;"></div>
                    <?php
                    $position += $width; // Update cumulative position
                endforeach; ?>

               <div class="bmi-value-indicator" style="left:<?php echo $indicatorPosition; ?>%;">&#x25BC; <?php echo $currentBmi; ?></div>
            </div>

        <?php endif; ?>

        <?php if ($bmiCategory && isset($workoutRoutine) && !empty($workoutRoutine)): ?>
            <div class="workout-plan">
                <?php foreach ($workoutRoutine as $exercise): ?>
                    <div class="exercise">
                        <h3><?php echo htmlspecialchars($exercise['exercise_name']); ?></h3>
                        <p><?php echo htmlspecialchars($exercise['description']); ?></p>

                        <?php if (!empty($exercise['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($exercise['image_url']); ?>" alt="<?php echo htmlspecialchars($exercise['exercise_name']); ?>">
                        <?php endif; ?>

                        <?php if (!empty($exercise['video_url'])): ?>
                            <iframe width="560" height="315" src="<?php echo htmlspecialchars($exercise['video_url']); ?>" frameborder="0" allowfullscreen></iframe>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-workout">No workout plan available for your BMI category. Please calculate your BMI first.</p>
        <?php endif; ?>
    </div>
</body>
</html>
