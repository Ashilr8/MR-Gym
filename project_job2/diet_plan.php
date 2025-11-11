<?php
// detailed_diet.php

// Retrieve BMI and category from URL parameters
$bmi = isset($_GET['bmi']) ? $_GET['bmi'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Function to generate a more detailed diet plan based on the BMI category
function getDetailedDietPlan($category) {
    $detailedDietPlan = [];

    // Detailed diet plan for each category (Replace with your actual data)
    switch ($category) {
        case "Underweight":
            $detailedDietPlan = [
                "Breakfast" => ["Oatmeal with fruits, nuts, and a drizzle of honey", "400 calories"],
                "Lunch" => ["Whole wheat pasta salad with grilled chicken and vegetables", "500 calories"],
                "Dinner" => ["Baked salmon with brown rice and steamed broccoli", "600 calories"],
                "Snacks" => ["Protein shake", "200 calories"]
            ];
            break;
        case "Normal weight":
            $detailedDietPlan = [
                "Breakfast" => ["Greek yogurt with granola and berries", "300 calories"],
                "Lunch" => ["Turkey breast sandwich on whole grain bread with lettuce and tomato", "400 calories"],
                "Dinner" => ["Chicken stir-fry with mixed vegetables and quinoa", "500 calories"],
                "Snacks" => ["Apple slices with peanut butter", "150 calories"]
            ];
            break;
        case "Overweight":
            $detailedDietPlan = [
                "Breakfast" => ["Scrambled eggs with spinach and whole wheat toast", "300 calories"],
                "Lunch" => ["Salad with grilled chicken or tofu and a light vinaigrette dressing", "350 calories"],
                "Dinner" => ["Baked cod with roasted vegetables (Brussels sprouts, carrots)", "450 calories"],
                "Snacks" => ["Carrot sticks with hummus", "100 calories"]
            ];
            break;
        case "Obese":
            $detailedDietPlan = [
                "Breakfast" => ["Smoothie with protein powder, mixed greens, and berries", "250 calories"],
                "Lunch" => ["Lentil soup with a slice of whole grain bread", "300 calories"],
                "Dinner" => ["Lean ground turkey chili with black beans and vegetables", "400 calories"],
                "Snacks" => ["Cucumber slices with a sprinkle of salt", "50 calories"]
            ];
            break;
        default:
            // Handle the case where the category is not recognized
            return null;
    }

    return $detailedDietPlan;
}

$detailedDietPlan = getDetailedDietPlan($category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Diet Overview</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, rgba(12, 12, 218, 0.95), rgba(18, 19, 27, 0.78));
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center; /* Center align everything */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #fff;
            margin-bottom: 20px;
        }

        h2 {
            color: #fff;
            margin-top: 20px;
        }

        p {
            color: #ddd;
            line-height: 1.6;
        }

        .detailed-meal-plan {
            margin-top: 30px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
        }

        /* Style the meal information */
        .meal {
            margin-bottom: 15px;
            text-align: left; /* Align text to the left for meal items */
        }

        .meal strong {
            color: #fff; /* Highlight the meal names */
        }
           /* Back to Dashboard Link */
        .back-to-dashboard {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-dashboard a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-to-dashboard a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detailed Diet Overview</h1>
        <?php if ($bmi && $category && $detailedDietPlan): ?>
        <p>Here is your detailed meal plan according to a bmi of <?php echo $bmi; ?> and category of <?php echo $category; ?></p>
         <div class="detailed-meal-plan">
                <h2>Detailed Meal Plan</h2>
                <?php foreach ($detailedDietPlan as $meal => $details): ?>
                    <div class="meal">
                        <strong><?php echo htmlspecialchars($meal); ?>:</strong>
                        <?php echo htmlspecialchars($details[0]); ?> (<?php echo htmlspecialchars($details[1]); ?>)
                    </div>
                <?php endforeach; ?>
          </div>
          <?php else: ?>
                <p>Please calculate your BMI first to see a diet plan.</p>
        <?php endif; ?>
          <div class="back-to-dashboard">
              <a href="bmi_calc.php">Back to Dashboard</a>
          </div>
    </div>
</body>
</html>
