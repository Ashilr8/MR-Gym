<?php
session_start(); // Start the session at the very beginning

$workouts = [
    "Underweight" => [
        "Focus on bodybuilding exercises.",
        "Try resistance training with weights.",
        "Incorporate high-calorie smoothies into your diet."
    ],
    "Normal weight" => [
        "Balance cardio and bodybuilding.",
        "Include strength training at least three times a week.",
        "Engage in moderate cardio exercises like jogging or cycling."
    ],
    "Overweight" => [
        "Focus more on weight loss activities.",
        "Incorporate cardio workouts like running or swimming.",
        "Consider circuit training to burn calories."
    ],
    "Obese" => [
        "Prioritize weight loss through low-impact cardio.",
        "Engage in strength training to build muscle.",
        "Consider working with a personal trainer for guidance."
    ]
];

 // Define specific exercise plans with image links based on categories
 $exercisePlans = [
    "Underweight" => [
        ["Squats (3 sets of 12 reps)", "squat.jpg"],
        ["Bench Press (3 sets of 10 reps)", "bench press.jpg"],
        ["Deadlifts (3 sets of 10 reps)", "deadlift.jpg"],
        ["Pull-Ups (3 sets of as many as possible)", "pull up.jpg"],
        ["Dumbbell Shoulder Press (3 sets of 12 reps)", "shoulder press.jpg"]
    ],
    "Normal weight" => [
       ["Jogging (30 minutes, 3 times a week)", "jog.jpg"],
       ["Push-Ups (3 sets of 15 reps)", "pushup.jpg"],
       ["Lunges (3 sets of 12 reps per leg)", "lunge.jpg"],
       ["Plank (hold for 30 seconds, repeat 3 times)", "plank.jpg"],
       ["Cycling (30 minutes, twice a week)", "cycle.jpg"]
   ],
   "Overweight" => [
       ["Walking (45 minutes daily)", "walk.jpg"],
       ["Swimming (30 minutes, twice a week)", "swim.jpg"],
       ["Jump Rope (5 minutes warm-up, then intervals)", "jump rope.jpg"],
       ["Bodyweight Squats (3 sets of 15 reps)", "bw squat.jpg"],
       ["High-Intensity Interval Training (HIIT) workouts", "hiit.jpg"]
   ],
   "Obese" => [
       ["Chair Exercises (seated leg lifts, arm raises)", "chair exercises.jpg"],
       ["Water Aerobics (30 minutes, twice a week)", "water a.jpg"],
       ["Light Resistance Band Training (2-3 times a week)", "rb.jpg"],
       ["Walking (20-30 minutes daily at a comfortable pace)", "walk.jpg"],
       ["Stretching and Flexibility Exercises", "stretches.jpg"]
   ]
];

$bmi = null;
$category = '';
$workoutPlan = '';
$exercisePlan = [];

// BMI Calculation Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate_bmi'])) {
    $weight = $_POST['weight'];
    $height_cm = $_POST['height'];

    if (!empty($weight) && !empty($height_cm)) {
        $height_m = $height_cm / 100;
        $bmi = $weight / ($height_m * $height_m);

        if ($bmi < 18.5) {
            $category = "Underweight";
            $workoutPlan = $workouts["Underweight"][array_rand($workouts["Underweight"])];
            $exercisePlan = $exercisePlans["Underweight"];
            $exercisePlan[] = "<strong>Note:</strong> Focus on gaining muscle mass.";

        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            $category = "Normal weight";
            $workoutPlan = $workouts["Normal weight"][array_rand($workouts["Normal weight"])];
            $exercisePlan = $exercisePlans["Normal weight"];

        } elseif ($bmi >= 25 && $bmi < 30) {
            $category = "Overweight";
            $workoutPlan = $workouts["Overweight"][array_rand($workouts["Overweight"])];
            $exercisePlan = $exercisePlans["Overweight"];

        } else {
            $category = "Obese";
            $workoutPlan = $workouts["Obese"][array_rand($workouts["Obese"])];
            $exercisePlan = $exercisePlans["Obese"];
        }

        // Store workout plan data in session
        $_SESSION['bmi'] = round($bmi, 2);
        $_SESSION['category'] = $category;
        $_SESSION['workoutPlan'] = $workoutPlan;
        $_SESSION['exercisePlan'] = $exercisePlan;

    } else {
        echo "<p style='color:red;'>Please provide both weight and height.</p>";
    }
}

// Retrieve workout plan from session, if available
$bmiResult = $_SESSION['bmi'] ?? null;
$bmiCategory = $_SESSION['category'] ?? '';
$workoutPlanResult = $_SESSION['workoutPlan'] ?? '';
$exercisePlanResult = $_SESSION['exercisePlan'] ?? [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
            color: #333;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #1b8b2eff 0%,rgb(0, 0, 0) 100%);
            color: #fff;
            padding: 20px;
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Distribute space evenly */
            align-items: center; /* Center items vertically */
        }

        .header h1 {
            font-size: 2em; /* Smaller heading for better fit */
            margin: 0;
        }

        /* Profile Section Styles */
        .profile-section {
            text-align: center;
        }

        .profile-section img {
            width: 80px; /* Smaller image size */
            height: 80px;
            border-radius: 50%; /* Circular image */
            object-fit: cover; /* Maintain aspect ratio */
            margin-bottom: 5px;
        }

        .profile-section p {
            font-size: 0.9em; /* Smaller font size */
            color: #fff;
            margin: 5px 0;
        }
        /* Dashboard Styles */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Tile Styles */
        .tile {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            text-align: left;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tile:hover {
            transform: translateY(-5px);
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.15);
        }

        .tile h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .tile p {
            color: #666;
            line-height: 1.4;
        }

        .tile img {
            width: 100%;
            max-width: 100px;
            border-radius: 8px;
            margin-top: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* BMI Calculator Specific Styles */
        .tile.bmi-calculator form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .tile.bmi-calculator label {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .tile.bmi-calculator input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .tile.bmi-calculator input[type="submit"] {
            background-color: #247e41ff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .tile.bmi-calculator input[type="submit"]:hover {
            background-color: #228c40ff;
        }

        .tile.bmi-calculator .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 6px;
            font-size: 0.9em;
        }

        /* Workout Planner Specific Styles */
        .tile.workout-planner .exercise-list {
            margin-top: 10px;
        }

        .tile.workout-planner .exercise-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .tile.workout-planner .exercise-item:last-child {
            border-bottom: none;
        }

        .tile.workout-planner h4 {
            margin-top: 15px;
            margin-bottom: 10px;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            .tile {
                text-align: center;
            }

            .tile img {
                margin-left: auto;
                margin-right: auto;
            }
        }
        /* Elegant Menu Styles */
.navbar {
    display: flex; /* Use flexbox for layout */
    justify-content: space-around; /* Distribute space evenly */
    background-color:rgba(27, 159, 35, 1); /* Match header color */
    padding: 10px 0; /* Padding for the menu */
    border-radius: 8px; /* Rounded corners */
}

.navbar a {
    color: white; /* White text color */
    text-decoration: none; /* Remove underline from links */
    padding: 10px 15px; /* Padding for menu items */
    transition: background-color 0.3s; /* Smooth background color transition */
}

.navbar a:hover {
    background-color:rgb(30, 27, 196); /* Darker background on hover */
    border-radius: 5px; /* Rounded corners on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column; /* Stack menu items vertically on small screens */
        align-items: center; /* Center items */
    }

    .navbar a {
        padding: 10px; /* Adjust padding for smaller screens */
    }
}
/* Chatbot Styles */
.chatbot-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background-color: #667eea; /* Match header color */
    color: white;
    border-radius: 50%; /* Circular button */
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s;
    z-index: 1000; /* Ensure it hovers above other content */
}

.chatbot-button:hover {
    background-color: #575757; /* Darker on hover */
}

.chatbot-interface {
    display: none; /* Hidden by default */
    position: fixed;
    bottom: 80px; /* Above the button */
    right: 20px;
    width: 300px;
    height: 400px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 20px;
    z-index: 1000; /* Ensure it appears above other elements */
}

.chatbot-header {
    font-weight: bold;
    margin-bottom: 10px;
}

.chatbot-messages {
    height: 300px;
    overflow-y: auto; /* Scrollable messages */
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 10px;
}

.chatbot-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}


    </style>
    
</head>
<body>
    
    <!-- Header Section -->
    <div class="header">
        <h1>Mr Gym</h1>
        <nav class="navbar">
        <a href="bmi_calc.php">Home</a>
        <a href="supplement_store.php">Store</a>
        <a href="cart.php">Cart</a>
        <a href="gym_locator.php">Gym Locator</a>
        </nav>

        <!-- Profile Section -->
        <div class="profile-section">
            <img src="20240813_105935.jpg" alt="User Profile">
            <p>SHOLAN PERUMAL</p>
            <p>Always striving for a healthier tomorrow!</p>
        </div>
        
    </div>
    

    <!-- Dashboard Section -->
    <div class="dashboard">
        <!-- BMI Calculator Tile -->
        <div class="tile bmi-calculator">
            <h2>BMI Calculator</h2>
            <form action="" method="POST">
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" name="weight" required>

                <label for="height">Height (cm):</label>
                <input type="number" id="height" name="height" required>

                <input type="submit" name="calculate_bmi" value="Calculate BMI">
            </form>

            <?php if (isset($_SESSION['bmi'])): ?>
                <div class="result">
                    <p>Your BMI is <strong><?php echo $_SESSION['bmi']; ?></strong>.</p>
                    <p>You are classified as <strong><?php echo $_SESSION['category']; ?></strong>.</p>
                </div>
            <?php endif; ?>
            <h2>Weight Insights Based on BMI</h2>
            <canvas id="bmiChart" width="400" height="200"></canvas>
        </div>

        <!-- Workout Planner Tile -->
        <div class="tile">
            <h2>Workout Planner</h2>
            <?php if (isset($_SESSION['workoutPlan'])): ?>
                <h4>Recommended Workout Plan:</h4>
                <p><?php echo $_SESSION['workoutPlan']; ?></p>

                <h4>Exercise Plan:</h4>
                <div class="exercise-list">
                    <?php foreach ($_SESSION['exercisePlan'] as list($exercise, $image)): ?>
                        <div class="exercise-item">
                            <p><?php echo $exercise; ?></p>
                            <img src="<?php echo $image; ?>" alt="<?php echo $exercise; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
               <!-- New Link -->
               <a href="workout_generator.php?bmi=<?php echo $_SESSION['bmi']; ?>&bmiCategory=<?php echo $_SESSION['category']; ?>">View Full Workout Plan</a>

            <?php else: ?>
                <p>Calculate your BMI to generate a personalized workout plan.</p>
            <?php endif; ?>
            <img src="Screenshot 2025-03-13 181331.png" alt="Workout Planner">
        </div>

       
        <div id="calendarTab" class="tab-content">
    <!-- Calendar Container -->
    <div id="fitnessCalendar"></div>
    
    <!-- Log Entry Form -->
    <div class="log-form">
        <h3>Daily Weight Log</h3>
        <input type="number" id="logWeight" step="0.1" placeholder="Weight (kg)">
        <button onclick="saveDailyLog()">Save Entry</button>
    </div>
    </div>

        <!-- Gym Locator Tile -->
        <div class="tile">
            <h2>Gym Locator</h2>
            <p>Find <a href="gym_locator.php">fitness gyms</a> near you and start your fitness journey.</p>
            <img src="gym_locator.jpg" alt="Gym Locator">
        </div>

        <!-- E-commerce Store Tile -->
        <div class="tile">
            <h2>Supplement Store</h2>
            <p>Shop for <a href="supplement_store.php">gym supplements and fitness gear.</a></p>
            <img src="online_store.jpg" alt="Supplement Store">
        </div>

        <!-- Contact Us Tile -->
        <div class="tile">
            <h2>Contact Us</h2>
            <p>Get in touch for support or inquiries.</p>
            <img src="contact_us_pic.jpg" alt="Contact Us">
        </div>

        <!-- Heart Rate Bar Section -->
        <div class="tile heart-rate-section">
            <h2>Heart Rate Monitor</h2>
            <div class="heart"></div>
            <p>Mock Heart Rate: <span id="heart-rate">75</span> BPM</p>
            <canvas id="heartRateChart" width="400" height="200"></canvas>
        </div>

        <div class="tile stress-level-section">
            <h2>Stress Level Monitor</h2>
            <div class="stress-icon">😟</div>
            <p>Mock Stress Level: <span id="stress-level">40</span>%</p>
            <canvas id="stressLevelChart" width="400" height="200"></canvas>
        </div>

        <!-- Meal Log Section -->
        <div class="tile meal-log-section">
            <h2>Meal Log</h2>
            <form id="meal-log-form">
            <label for="max-calories">Set Max Calories for the Day:</label>
            <input type="number" id="max-calories" required>
            <button type="submit">Set</button><br>
            <label for="meal-name">Meal Name:</label><br>
            <input type="text" id="meal-name" required><br>
            <label for="meal-calories">Calories:</label><br>
            <input type="number" id="meal-calories" required>
            <button type="submit">Add Meal</button>
            </form>
            <ul id="meal-list"></ul>
            <p>Total Calories: <span id="total-calories">0</span></p>
            <canvas id="calorieChart" width="400" height="200"></canvas>
        </div>

        <!-- New Div for BMI Chart -->
        <div class="bmi-chart-container">
            <canvas id="bmiChartNew"></canvas>
        </div>

        <div class="tile">
            <h2>Workout Journal</h2>
            <div class="journal-form">
            <div class="mood-selector">
            <span>Today's Mood:</span>
            <div class="emoji-buttons">
                <button class="emoji-btn" data-emoji="😊" onclick="selectMood(this)">😊</button>
                <button class="emoji-btn" data-emoji="💪" onclick="selectMood(this)">💪</button>
                <button class="emoji-btn" data-emoji="😩" onclick="selectMood(this)">😩</button>
                <button class="emoji-btn" data-emoji="🔥" onclick="selectMood(this)">🔥</button>
                <button class="emoji-btn" data-emoji="😴" onclick="selectMood(this)">😴</button>
            </div>
            <input type="hidden" id="selectedMood" value="">
            </div>
        <textarea id="workoutEntry" placeholder="How did your workout go today?"></textarea><br>
        <button onclick="saveJournalEntry()">Save Entry</button>
    </div>
    <div class="past-entries"></div>
    <!-- Chatbot Button -->
<div class="chatbot-button" id="chatbotButton">Mr Gym</div>

<!-- Chatbot Interface -->
<div class="chatbot-interface" id="chatbotInterface">
    <div class="chatbot-header">Chat with Mr Gym</div>
    <div class="chatbot-messages" id="chatbotMessages"></div>
    <input type="text" class="chatbot-input" id="chatbotInput" placeholder="Type your message...">
</div>
</div>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Mock heart rate data
const heartRateData = [];
let currentHeartRate = 75;

// Generate random heart rate values for the graph
function generateHeartRate() {
    currentHeartRate = Math.floor(Math.random() * (90 - 60 + 1)) + 60; // Random BPM between 60 and 90
    document.getElementById('heart-rate').innerText = currentHeartRate; // Update BPM display
    if (heartRateData.length >= 20) heartRateData.shift(); // Keep last 20 readings
    heartRateData.push(currentHeartRate);
}

// Update chart with new data
function updateChart(chart) {
    chart.data.datasets[0].data = heartRateData;
    chart.update();
}

// Create heart rate chart
const ctx = document.getElementById('heartRateChart').getContext('2d');
const heartRateChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: Array.from({ length: 20 }, (_, i) => i + 1), // Mock labels (1 to 20)
        datasets: [{
            label: 'Heart Rate (BPM)',
            data: heartRateData,
            borderColor: 'red',
            backgroundColor: 'rgba(255,0,0,0.3)',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Time (seconds)' } },
            y: { title: { display: true, text: 'BPM' }, min: 50, max: 100 }
        }
    }
});

// Simulate real-time updates every second
setInterval(() => {
    generateHeartRate();
    updateChart(heartRateChart);
}, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Mock stress level data
const stressLevelData = [];
let currentStressLevel = 40;

// Generate random stress level values for the graph
function generateStressLevel() {
    currentStressLevel = Math.floor(Math.random() * (80 - 20 + 1)) + 20; // Random stress level between 20% and 80%
    document.getElementById('stress-level').innerText = currentStressLevel; // Update stress level display
    if (stressLevelData.length >= 20) stressLevelData.shift(); // Keep last 20 readings
    stressLevelData.push(currentStressLevel);
}

// Update chart with new data
function updateStressChart(chart) {
    chart.data.datasets[0].data = stressLevelData;
    chart.update();
}

// Create stress level chart
const ctxStress = document.getElementById('stressLevelChart').getContext('2d');
const stressLevelChart = new Chart(ctxStress, {
    type: 'line',
    data: {
        labels: Array.from({ length: 20 }, (_, i) => i + 1), // Mock labels (1 to 20)
        datasets: [{
            label: 'Stress Level (%)',
            data: stressLevelData,
            borderColor: 'blue',
            backgroundColor: 'rgba(0,0,255,0.3)',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Time (seconds)' } },
            y: { title: { display: true, text: 'Stress Level (%)' }, min: 0, max: 100 }
        }
    }
});

// Simulate real-time updates every second
setInterval(() => {
    generateStressLevel();
    updateStressChart(stressLevelChart);
}, 1000);
</script>
<script>
// Mock calorie data
const calorieData = [];
let totalCalories = 0;
let maxCalories = 2000; // Default max calories
let mealLog = [];

// Generate random calorie values for the graph
function generateCalorieData(calorieValue, color) {
    calorieData.push({ value: calorieValue, color: color });
    if (calorieData.length > 6) calorieData.shift(); // Keep last 6 readings
}

// Update chart with new data
function updateCalorieChart(chart) {
    chart.data.datasets[0].data = calorieData.map(entry => entry.value);
    chart.data.datasets[0].backgroundColor = calorieData.map(entry => entry.color);
    chart.update();
}

// Create calorie chart
const ctxCalorie = document.getElementById('calorieChart').getContext('2d');
const calorieChart = new Chart(ctxCalorie, {
    type: 'bar', // Switched to bar chart for better visualization
    data: {
        labels: ['Breakfast', 'Mid-Morning Snack', 'Lunch', 'Afternoon Snack', 'Dinner', 'Evening Snack'], // Realistic meal labels
        datasets: [{
            label: 'Calories',
            data: calorieData.map(entry => entry.value),
            backgroundColor: calorieData.map(entry => entry.color),
            borderColor: calorieData.map(entry => entry.color),
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Meal Time' } },
            y: { title: { display: true, text: 'Calories' }, min: 0, max: 500 }
        }
    }
});

// Handle meal log form submission
document.getElementById('meal-log-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const mealName = document.getElementById('meal-name').value;
    const mealCalories = parseInt(document.getElementById('meal-calories').value);
    totalCalories += mealCalories;
    document.getElementById('total-calories').innerText = totalCalories;

    mealLog.push({ name: mealName, calories: mealCalories });
    updateMealList();

    // Generate a random color for each entry
    const colors = ['#FF69B4', '#33CC33', '#6666FF', '#FF9900', '#CC33CC', '#33CCCC'];
    const colorIndex = mealLog.length % colors.length; // Cycle through colors
    generateCalorieData(mealCalories, colors[colorIndex]);
    updateCalorieChart(calorieChart);

    // Check if total calories exceed max calories
    if (totalCalories > maxCalories) {
        document.getElementById('calorieChart').style.border = '2px solid red';
        alert('Warning: Total calories exceeded the daily limit!');
    } else {
        document.getElementById('calorieChart').style.border = '';
    }

    document.getElementById('meal-name').value = ''; // Clear meal name input
    document.getElementById('meal-calories').value = ''; // Clear meal calories input
});

// Update meal list
function updateMealList() {
    const mealList = document.getElementById('meal-list');
    mealList.innerHTML = ''; // Clear existing list

    mealLog.forEach(meal => {
        const li = document.createElement('li');
        li.textContent = `${meal.name} - ${meal.calories} calories`;
        mealList.appendChild(li);
    });
}

// Optional: Set max calories for the day
document.getElementById('max-calories-form').addEventListener('submit', function(e) {
    e.preventDefault();
    maxCalories = parseInt(document.getElementById('max-calories').value);
    document.getElementById('max-calories').value = ''; // Clear input
    alert(`Max calories set to ${maxCalories} for the day.`);
});

</script>
<script>
// Function to update BMI chart based on calculated BMI
function updateBmiChart(bmi) {
    console.log('Updating BMI chart...');
    const ctx = document.getElementById('bmiChartNew').getContext('2d');
    if (!ctx) {
        console.error('Canvas element not found!');
        return;
    }

    const bmiCategories = ['Underweight', 'Normal Weight', 'Overweight', 'Obese'];
    const bmiValues = [18.5, 25, 30, 40]; // Representative BMI values for categories

    // Data for chart
    const data = {
        labels: bmiCategories,
        datasets: [{
            label: 'BMI Categories',
            data: bmiValues,
            backgroundColor: ['#ffc44d', '#0be881', '#ff884d', '#ff5e57'],
            borderColor: ['#ffc44d', '#0be881', '#ff884d', '#ff5e57'],
            borderWidth: 1,
        }]
    };

    // Chart options
    const options = {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return `${bmiCategories[tooltipItem.dataIndex]}: Up to ${bmiValues[tooltipItem.dataIndex]} BMI`;
                    }
                }
            }
        },
        scales: {
            x: { title: { display: true, text: 'BMI Categories' } },
            y: { title: { display: true, text: 'BMI Value' }, min: 0, max: 40 }
        }
    };

    // Create or update chart
    if (window.bmiChartNew) {
        window.bmiChartNew.destroy(); // Destroy existing chart instance
    }
    try {
        window.bmiChartNew = new Chart(ctx, {
            type: 'bar',
            data,
            options
        });
        console.log('BMI chart created successfully!');
    } catch (error) {
        console.error('Error creating BMI chart:', error);
    }
}

// Example usage (replace with actual BMI calculation logic)
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded. Retrieving BMI value...');
    // Assuming you have a BMI value calculated and displayed somewhere
    const bmi = parseFloat(document.getElementById('yourbmi').textContent); // Get calculated BMI value
    console.log('BMI value:', bmi);
    updateBmiChart(bmi);
});

</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('fitnessCalendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        dateClick: function(info) {
            const weight = prompt(`Enter weight for ${info.dateStr}:`);
            if (weight) {
                saveLog(info.dateStr, parseFloat(weight));
                calendar.refetchEvents();
            }
        },
        events: function(fetchInfo, successCallback) {
            const logs = JSON.parse(localStorage.getItem('weightLogs') || '{}');
            const events = Object.entries(logs).map(([date, weight]) => ({
                title: `${weight}kg`,
                start: date,
                allDay: true,
                backgroundColor: '#4CAF50'
            }));
            successCallback(events);
        }
    });
    calendar.render();
});

function saveLog(date, weight) {
    const logs = JSON.parse(localStorage.getItem('weightLogs') || '{}');
    logs[date] = weight;
    localStorage.setItem('weightLogs', JSON.stringify(logs));
}

function saveDailyLog() {
    const weightInput = document.getElementById('logWeight');
    const today = new Date().toISOString().split('T')[0];
    
    if (weightInput.value) {
        saveLog(today, parseFloat(weightInput.value));
        weightInput.value = '';
        window.location.reload();
    }
}
</script>
<script>
// Journal functionality
let selectedEmoji = null;

function selectMood(button) {
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    emojiButtons.forEach(btn => btn.classList.remove('selected'));
    button.classList.add('selected');
    selectedEmoji = button.dataset.emoji;
    document.getElementById('selectedMood').value = selectedEmoji;
}

function saveJournalEntry() {
    const entryText = document.getElementById('workoutEntry').value;
    const mood = selectedEmoji;
    const date = new Date().toLocaleDateString('en-ZA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    if (!mood || !entryText) {
        alert('Please select a mood and write about your workout!');
        return;
    }

    const entry = {
        date,
        mood,
        entry: entryText
    };

    // Save to localStorage
    const entries = JSON.parse(localStorage.getItem('fitnessJournal') || '[]');
    entries.push(entry);
    localStorage.setItem('fitnessJournal', JSON.stringify(entries));

    // Clear inputs
    document.getElementById('workoutEntry').value = '';
    document.querySelectorAll('.emoji-btn').forEach(btn => 
        btn.classList.remove('selected'));
    selectedEmoji = null;

    showPastEntries();
}

function showPastEntries() {
    const entries = JSON.parse(localStorage.getItem('fitnessJournal') || '[]');
    const entriesHTML = entries.reverse().map(entry => `
        <div class="entry-item">
            <div class="entry-header">
                <span class="entry-date">${entry.date}</span>
                <span class="entry-mood">${entry.mood}</span>
            </div>
            <p class="entry-text">${entry.entry}</p>
        </div>
    `).join('');

    document.querySelector('.past-entries').innerHTML = entriesHTML;
}

// Load past entries when page loads
document.addEventListener('DOMContentLoaded', showPastEntries);
</script>
<script>
    const chatbotButton = document.getElementById('chatbotButton');
    const chatbotInterface = document.getElementById('chatbotInterface');
    const chatbotMessages = document.getElementById('chatbotMessages');
    const chatbotInput = document.getElementById('chatbotInput');

    chatbotButton.addEventListener('click', () => {
        chatbotInterface.style.display = chatbotInterface.style.display === 'none' || chatbotInterface.style.display === '' ? 'block' : 'none';
    });

    chatbotInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const userMessage = chatbotInput.value;
            if (userMessage) {
                const messageElement = document.createElement('div');
                messageElement.textContent = 'You: ' + userMessage;
                chatbotMessages.appendChild(messageElement);
                chatbotInput.value = ''; // Clear input

                // Simulate a response from the chatbot
                setTimeout(() => {
                    const botMessageElement = document.createElement('div');
                    botMessageElement.textContent = 'Mr Gym: I am here to help!';
                    chatbotMessages.appendChild(botMessageElement);
                    chatbotMessages.scrollTop = chatbotMessages.scrollHeight; // Scroll to bottom
                }, 1000);
            }
        }
    });
</script>
</body>
</html>
