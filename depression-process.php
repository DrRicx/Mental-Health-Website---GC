<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process each question and calculate a total score
    $questions = [
        "question1", "question2", "question3", "question4",
        "question5", "question6", "question7", "question8", "question9"
    ];

    $totalScore = 0;

    foreach ($questions as $question) {
        if (isset($_POST[$question])) {
            $totalScore += (int)$_POST[$question];
        }
    }

    // Determine the depression level based on the total score
    $depressionLevel = "";

    if ($totalScore <= 4) {
        $depressionLevel = "None";
    } elseif ($totalScore <= 9) {
        $depressionLevel = "Mild Depression";
    } elseif ($totalScore <= 14) {
        $depressionLevel = "Moderate Depression";
    } else if ($totalScore <= 19){
        $depressionLevel = "Moderately Depression";
    } else {
        $depressionLevel = "Severe Depression";
    }

    // Create a unique filename based on timestamp
    $resultFileName = "result_" . time() . ".html";

    // Save the result in an HTML file
    $resultFile = fopen($resultFileName, "w");

    fwrite($resultFile, "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' media='screen' href='depression-design.css'>
    <title>Depression Test Result</title>
</head>
<body>
    <div class='container'>
        <h1>Depression Test Result</h1>
        <h2>Depression Level:</h2>
        <p>$depressionLevel</p>
    </div>
</body>
</html>");

    fclose($resultFile);

    // Redirect to the saved result page
    header("Location: $resultFileName");
    exit();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: index.html");
    exit();
}
?>
