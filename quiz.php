<?php
require "vendor/autoload.php";
session_start();

use App\QuestionManager;
$number = null;
$question = null;

try {
    $manager = new QuestionManager;
    $manager->initialize();

    $questions = [];

    for ($number = 1; $number <= $manager->getQuestionSize(); $number++) {
        $question = $manager->retrieveQuestion($number);
        array_push($questions, $question);
    }

    if (isset($_SESSION['is_quiz_started'])) {
        //$number = $_SESSION['current_question_number'];
        $number = 1;
    } else {
        // Marker for a started quiz
        $_SESSION['is_quiz_started'] = true;
        $_SESSION['answers'] = [];
        $number = 1;
    }
    
    if (isset($_POST['submit'])) {
        // Save user answers for all questions
        for ($number = 1; $number <= $manager->getQuestionSize(); $number++) {
            if (isset($_POST['answer_'.$number])) {
                $_SESSION['answers'][$number] = $_POST['answer_'.$number];
            }
        }

        // Check if all questions have been answered
        $answeredQuestions = count($_SESSION['answers']);
        if ($answeredQuestions == $manager->getQuestionSize()) {
            header("Location: result.php");
            exit;
        } else {
            // Display a pop-up message indicating that some questions are unanswered
            echo '<script>alert("Please answer all questions before submitting the quiz."); setTimeout(function() { window.location.href = "quiz.php"; }, 10);</script>';
            exit;
        }
    } 
    
    // Retrieve current question
    //$number = $_SESSION['current_question_number'];
    //$question = $manager->retrieveQuestion($number);

} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #F5F5F5;
        }

        .maincontainer {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 300vh;
        }

        .quesandchoices {
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
            padding: 32px;
            width: 900px;
        }
        
        .instructions {
            font-size: 16px;
            color: #555555;
        }

        .quiztitle {
            text-align: center;
            margin-bottom: 20px;
        }

        .questionheading {
            margin-top: 20px;
        }

        h2 {
            font-size: 24px;
            font-weight: 500;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        h3 {
            margin-bottom: 10px;
        }


        .choice {
            margin-bottom: 5px;
        }

        h4 {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 100px;
            margin: auto auto;
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover {
            background-color: #3E8E41;
        }

        input[type="radio"]{
            vertical-align: middle;
        }

    </style>

</head>
<body>
<div class="maincontainer">

    <div class="quesandchoices">
    <h1 class="quiztitle">Analogy Questions</h1>
        <h3>Instructions</h3>
        <p class="instructions">
            There is a certain relationship between two given words on one side of : : and one word is given on another side of : : 
            while another word is to be found from the given alternatives, having the same relation with this word as the words of 
            the given pair bear. Choose the correct alternative.
        </p>

        <form method="POST" action="quiz.php">
            <?php foreach ($questions as $question): ?>
                <h1 class="questionheading">Question #<?php echo $question->getNumber(); ?></h1>
                <h2 style="color: blue"><?php echo $question->getQuestion(); ?></h2>
                <h4 style="color: blue">Choices</h4>
                <input type="hidden" name="number_<?php echo $question->getNumber(); ?>" value="<?php echo $question->getNumber();?>" />
                
                <?php foreach ($question->getChoices() as $choice): ?>
                    <div class="choice">
                        <input type="radio" name="answer_<?php echo $question->getNumber(); ?>" value="<?php echo $choice->letter; ?>" id="<?php echo $choice->letter; ?>"/>
                        <label class="choice-label" for="<?php echo $choice->letter; ?>"><?php echo $choice->letter . ') ' . $choice->label; ?></label>
                    </div>
                <?php endforeach; ?>

            <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
        </form>
    </div>

</div>
</body>
</html>

<!-- DEBUG MODE -->
<pre>
<?php
var_dump($_SESSION);
?>
</pre>