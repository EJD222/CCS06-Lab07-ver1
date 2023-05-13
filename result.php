<?php
require "vendor/autoload.php";
session_start();

use App\QuestionManager;
$score = null;

try {
    $manager = new QuestionManager;
    $manager->initialize();
    $questionSize = $manager->getQuestionSize();

    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $score = $manager->computeScore($_SESSION['answers']);

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
    <title>Quiz Results</title>

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
            height: 100vh;
        }

        .resultscontainer {
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
            padding: 50px;
            width: 550px;
        }

        ol {
            list-style-position: inside;
            margin-left: 25px;
            margin-bottom: 25px;
        }

        li {
            margin-bottom: 1px;
        }

        p {
            margin-bottom: 3px;
        }

    </style>

</head>
<body>
<div class="maincontainer">
    <div class="resultscontainer">
        <h1>Thank You!</h1>
        <p>Congratulations <b><?php echo $_SESSION['user_fullname']; ?></b> (<b><?php echo $_SESSION['user_email'];?></b>)!<p>
        <p>Score: <b><span style='color:blue'><?php echo $score; ?></span></b> out of <b><?php echo $questionSize; ?></b> items</p>
        
        <p>Your Answers:</p>
        <ol>
        <?php foreach ($_SESSION['answers'] as $index => $answer): ?>
            <?php $question = $manager->retrieveQuestion($index); ?>
            <li>
                <?php 
                echo $answer." ";
                if ($answer === $question->getAnswer()) {
                    echo "(<span style='color:blue'>correct</span>)";
                } else {
                    echo "(<span style='color:red'>incorrect</span>)";
                }
                ?>
            </li>
        <?php endforeach; ?>
        </ol>
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