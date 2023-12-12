<?php 
	session_start();
	include_once("../_partials/must_login.php");

    $uc = 101; //CHANGE LATER COM O TOMAS

	$title = "Exercises";
	$css = ["solve-exercise", "header"];
	include_once("../_partials/head.php");
	include_once("../_partials/header.php");

    $sq = $dbh->prepare("SELECT COUNT(id) FROM Question WHERE UC=?;");
	$sq->execute([$uc]);
	$n_questions = intval($sq->fetch());




    if ($n_questions > 0) {
        echo rand(1,$n_questions);
        echo("/");
        echo ($n_questions);
    } else {
		$_SESSION['msg'] = "No questions for this UC";
        die();        
    }


    
    $sq = $dbh->prepare("SELECT * FROM Question WHERE UC=? LIMIT 1 OFFSET ?;");
	$sq->execute([$uc,$n_questions-1]);
	$selected_question = $sq->fetch();

    if ($selected_question["wrong_answer3"] != NULL) {
        $n_opts = 4;
        $opt_order = ["correct_answer","wrong_answer1","wrong_answer2","wrong_answer3"];
    }
    elseif ($selected_question["wrong_answer2"] != NULL) {
        $n_opts = 3;
        $opt_order = ["correct_answer","wrong_answer1","wrong_answer2"];
    }
    else {
        $n_opts = 2;
        $opt_order = ["correct_answer","wrong_answer1"];
    }

    shuffle($opt_order);
    


?>

<h1>Exercises - UC420420</h1>
<main>
    <section class="arrows">
        <img class="empty" src="/assets/arrows/upvote_empty.png" width=60px>
        <img class="filled" src="/assets/arrows/upvote_filled.png" width=60px>
        <img class="empty" src="/assets/arrows/downvote_empty.png" width=60px>
        <img class="filled" src="/assets/arrows/downvote_filled.png" width=60px>
    </section>
    <section class="question">
        <div>
            <p id=question> <?php echo($selected_question["question"]) ?> </p><br>
            
            <?php
            for ($i = 0; $i < $n_opts; $i++) {
                echo("<p id=answer> ");
                echo($selected_question[$opt_order[$i]]);
                echo("</p>");
            }
            ?>

        </div>
    </section>

    <section class="controls">
        <div>
            <a href="\exercise-builder">Add Exercise</a>
            <a href="url">Leaderboard</a>

        </div>
        <a href="url">Skip</a>
        </section>

</main>

<?php include_once("../_partials/footer.php") ?>
