<?php
require_once "../inc/connect_db.php";
include_once "../template/en/header_footer.php";
getHeader();

// Find the number of questions
$numberOfQuestionsQuery = "SELECT * FROM tasks";
$numberOfQuestionsResult = $conn->query($numberOfQuestionsQuery);
$numberOfQuestions = $numberOfQuestionsResult->num_rows;

$arrayTaskQuestion = array();
$countNumberOfQuestion = 0;

// Fetch all data from table taskContent
$taskContentQuery = "SELECT * FROM taskContent";
$taskContentResult = $conn->query($taskContentQuery);

if ($taskContentResult->num_rows > 0) {

?>
<body class="container">
<?php
    // Create task content and task questions separately via nested while loop
    while($taskContentRow = $taskContentResult->fetch_assoc()) {
        $taskTitle = $taskContentRow["taskTitle"];
        $taskDescription = $taskContentRow["taskDescription"];
        $taskNumber = $taskContentRow["taskNumber"];
        
        echo "    <div class='accordion mb-4' id='accordionMain'>\n";
        echo "    <div class='card'>\n";
        echo "    <button class='btn btn-dark' aria-pressed='true' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$taskNumber' id='Task$taskNumber'><h3>Task $taskNumber - $taskTitle</h3></button>\n";
        
        // Only show task 1 upon visit
        if ($taskNumber == 1) {
            echo "    <div id='collapse$taskNumber' class='collapse show' data-bs-parent='#accordionMain'>\n";
        } else {
            echo "    <div id='collapse$taskNumber' class='collapse' data-bs-parent='#accordionMain'>\n";
        }
        echo "    <div class='card-body'>\n";
        echo "    <div class='container' id='task-$taskNumber'>\n";
        echo "        <div class='room-task-description'>\n";
        echo "            <p>$taskDescription</p>\n";
        echo "        </div>\n";
        echo "        <div class='task-questions'>\n";
        echo "            <h3 class='text-danger'><b><u>Answer your question(s) in below</u></b></h3>\n";
        
        // Create each questions in each task
        $taskQuestionQuery = "SELECT * FROM tasks WHERE taskNumber=$taskNumber";
        $taskQuestionResult = $conn->query($taskQuestionQuery);
        while($taskQuestionRow = $taskQuestionResult->fetch_assoc()) {
            $countNumberOfQuestion ++;

            if (empty($taskQuestionRow["taskAnswerEN"]) !== true) {
                $questionNumber = $taskQuestionRow["questionNumber"];
                $answerLength = strlen($taskQuestionRow["taskAnswerEN"]);
                $questionContent = $taskQuestionRow["questionContent"];
                $questionHint = $taskQuestionRow["questionHint"];
     
                // Loop through each character to find " \:/.{}@", if those doesn't contain in the $answer, then add "*"
                // For example, "http://phishing.com is good" answer format will be: "****://********.*** ** ***"
                $answer = str_split($taskQuestionRow["taskAnswerEN"]);
                $answerFormat = "";
                foreach ($answer as $character) {
                    if ($character === " ") {
                        $answerFormat .= " ";
                    } elseif ($character === "\\") {
                        $answerFormat .= "\\";
                    } elseif ($character === ":") {
                        $answerFormat .= ":";
                    } elseif ($character === "/") {
                        $answerFormat .= "/";
                    } elseif ($character === ".") {
                        $answerFormat .= ".";
                    } elseif ($character === "{") {
                        $answerFormat .= "{";
                    } elseif ($character === "}") {
                        $answerFormat .= "}";
                    } elseif ($character === "@") {
                        $answerFormat .= "@";
                    } else {
                        $answerFormat .= "*";
                    }
                }
                
                echo "            <div class='input-group row gap-2'>\n";
                echo "            <p class='p-2 m-2'>Question $questionNumber: $questionContent</p>\n";
                echo "            <input type='text' class='form-control' placeholder='Answer format: $answerFormat' id='task-$taskNumber-q$questionNumber'>\n";
                echo "            <div class='btn-group gap-4'>\n";
                echo "            <input type='button' class='btn btn-primary active' id='answerButtonTask-$taskNumber-q$questionNumber' value='Submit Answer' onclick=submitAnswer($taskNumber,$questionNumber)>\n";
                if (isset($questionHint)){
                    echo "            <input type='button' class='btn btn-secondary active' id='hintTask-$taskNumber-q$questionNumber' value='Show Hint' onclick=showHint($taskNumber,$questionNumber)>\n";
                    echo "            </div>\n";
                } else {
                    echo "            </div>\n";
                }                
            } else {
                // Empty answer
                $questionNumber = $taskQuestionRow["questionNumber"];
                $questionContent = $taskQuestionRow["questionContent"];
                
                echo "            <p class='p-2 m-2'>Question $questionNumber: $questionContent</p>\n";
                echo "            <div class='input-group row gap-2'>\n";
                echo "            <input type='text' class='form-control' placeholder='No answer needed' id='task-$taskNumber-q$questionNumber' disabled>\n";
                echo "            <input type='button' class='btn btn-primary active' id='answerButtonTask-$taskNumber-q$questionNumber' value='Submit Answer' onclick=submitAnswer($taskNumber,$questionNumber)>\n";
                echo "            </div>\n";
            }
            
            echo "        </div>\n";
        }
        array_push($arrayTaskQuestion, array("task$taskNumber" => $countNumberOfQuestion));
        $countNumberOfQuestion = 0;
        echo "        </div>\n";
        echo "        </div>\n";
        echo "        </div>\n";
        echo "    </div>\n";
        echo "    </div>\n";
        echo "    </div>\n";
    }
} else {
  die("No database result :(");
}
?>

    <!-- Bootstrap modal alert box -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" id="modalDialog">
        <div class="modal-content">
          <div class="modal-header" id="modalHeader">
            <h5 class="modal-title" id="modalTitle">Title Placeholder</h5>
          </div>
          <div class="modal-body" id="modalBody">
            Body Placeholder
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="closeModal()">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap modal alert box -->

    <script>
        document.getElementById('headerEnglish').className = 'nav-link active';
    </script>

    <script>
        // Use Bootstrap's modal components to pop up an alert box
        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});
        var myModalDialog = document.getElementById('modalDialog');
        var myModalHeader = document.getElementById('modalHeader');
        var myModalTitle = document.getElementById('modalTitle');
        var myModalBody = document.getElementById('modalBody');
    
        var numberOfAnsweredQuestion = 0;
        const numberOfQuestions = <?php echo $numberOfQuestions ?>;
        
        // Number of all questions in each task
        <?php
            echo "const taskObject = {\n";
            foreach ($arrayTaskQuestion as $key => $taskArray) {
                foreach ($taskArray as $task => $numberOfQuestion) {
                    echo "$task: $numberOfQuestion,\n";
                }
            }
            echo "}\n";
        ?>
        
        var numberOfEachTaskQuestionAnswered = {};

        async function submitAnswer(taskNumber, questionNumber) {
            // Sanitizing "taskNumber" & "questionNumber" via DOMPurify
            const sanitizedTaskNumber = DOMPurify.sanitize(taskNumber);
            const sanitizedQuestionNumber = DOMPurify.sanitize(questionNumber);
            
            // Find the question's entered answer
            const answer = document.getElementById('task-' + sanitizedTaskNumber + '-' + 'q' + sanitizedQuestionNumber).value;
            
            // Sanitizing "answer" via DOMPurify
            const sanitizedAnswer = DOMPurify.sanitize(answer);

            // Construct a JSON data
            const data = {
            "taskNumber": sanitizedTaskNumber,
            "questionNumber": sanitizedQuestionNumber,
            "answer": sanitizedAnswer,
            "language": "en"
            };
            // Send a POST request to submit_answer.php with the above JSON data
            let response = await fetch('../api/submit_answer.php', {
              method: 'POST',
              header: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
            });
            
            // Wait for the response message
            let answerResult = await response.json();
            
            // If correct, append a correct box and disable the question buton & input box
            if (answerResult === 'correct') {
                // Check if the user answered all questions
                if (numberOfAnsweredQuestion === numberOfQuestions - 1) {
                    // Construct a JSON data
                    const completedData = {
                    "completed": true
                    };
                    // Send a POST request to submit_completedNumber.php with the above JSON data
                    let completedResponse = await fetch('../api/submit_completedNumber.php', {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(completedData)
                    });

                    let completedResult = await completedResponse.text();
                    
                    // Use Bootstrap's modal components to pop up an alert box
                    myModalHeader.className = 'modal-header bg-success text-white';
                    myModalTitle.innerText = 'Congratulations!';
                    myModalBody.innerHTML = `You've answered all questions and <strong>you\'re the ${completedResult}th person to complete this lab!</strong><br><br>But before you go, please click on the <a href="https://forms.gle/cuXPz9wj7F32eAXQ6" target="_blank">link</a> to complete the survey! (It\'s not a phishing link, trust me :D)<br><br><h4>Note: All the answers will not be saved after refreshing/closing the page.</h4>`;
                    openModal();
                } else {
                    numberOfAnsweredQuestion ++;
                }
                
                correctAnswserAlert();
                document.getElementById('task-' + sanitizedTaskNumber + '-q' + sanitizedQuestionNumber).disabled = true;
                document.getElementById('task-' + sanitizedTaskNumber + '-q' + sanitizedQuestionNumber).className = 'form-control is-valid';
                
                let answerButton = document.getElementById('answerButtonTask-' + sanitizedTaskNumber + '-q' + sanitizedQuestionNumber);
                answerButton.className = 'btn btn-success disabled';
                answerButton.value = 'Correct Answer'
                
                // Check task's questions are all answered
                if (numberOfEachTaskQuestionAnswered['task' + sanitizedTaskNumber] === undefined) {
                    numberOfEachTaskQuestionAnswered['task' + sanitizedTaskNumber] = 1;
                } else {
                    numberOfEachTaskQuestionAnswered['task' + sanitizedTaskNumber] ++;
                }
                
                if (numberOfEachTaskQuestionAnswered['task' + sanitizedTaskNumber] === taskObject['task' + sanitizedTaskNumber]) {
                    // When a task is done, automatically show the next task
                    let taskObjectLastItem = Object.keys(taskObject).pop();
                    if ('task' + sanitizedTaskNumber !== taskObjectLastItem) {
                        let myCollapseNext = document.getElementById('collapse' + (parseInt(sanitizedTaskNumber) + 1));
                        let bsCollapseNext = new bootstrap.Collapse(myCollapseNext, {
                          toggle: false
                        });
                        bsCollapseNext.show();
                        
                        if ('task' + sanitizedTaskNumber !== 'task1') {
                            let myCollapseCurrent = document.getElementById('collapse' + sanitizedTaskNumber);
                            let bsCollapseCurrent = new bootstrap.Collapse(myCollapseCurrent, {
                              toggle: false
                            });
                            bsCollapseCurrent.hide();
                        }

                        document.location.hash = 'Task' + (parseInt(sanitizedTaskNumber) + 1);
                    } 
                    
                    let collapseButton = document.getElementById('Task' + sanitizedTaskNumber);
                    collapseButton.className = "btn btn-success";
                }
            } else if (answerResult === 'incorrect') {
                document.getElementById('task-' + sanitizedTaskNumber + '-q' + sanitizedQuestionNumber).className = 'form-control is-invalid';
                wrongAnswserAlert();
                
                // Reset it after 5 seconds
                setTimeout(() => {
                  document.getElementById('task-' + sanitizedTaskNumber + '-q' + sanitizedQuestionNumber).className = 'form-control';
                }, 5000);
            } else {
                console.log("Unable to find the result message.");
            }
        }
        
        async function showHint(taskNumber, questionNumber){
            // Sanitizing "taskNumber" & "questionNumber" via DOMPurify
            const sanitizedHintTaskNumber = DOMPurify.sanitize(taskNumber);
            const sanitizedHintQuestionNumber = DOMPurify.sanitize(questionNumber);
            
            const hintData = {
                "hintTaskNumber": sanitizedHintTaskNumber,
                "hintQuestionNumber": sanitizedHintQuestionNumber
            }
            // Send a POST request to submit_answer.php with the above JSON data
            let hintResponse = await fetch('../api/show_hint.php', {
               method: 'POST',
               header: {
                   'Content-Type': 'application/json'
               },
               body: JSON.stringify(hintData)
            });
            
            // Wait for the response message
            let hintResult = await hintResponse.json();
            if (hintResult !== '') {
                // Use Bootstrap's modal components to pop up an alert box
                myModalDialog.className = 'modal-dialog modal-lg';
                myModalHeader.className = 'modal-header bg-info text-white';
                myModalTitle.innerText = 'Hint:';
                myModalBody.innerText = hintResult;
                openModal();
            } else {
                console.log("Unknown hint result: " + hintResult);
            }
        }
        
        function openModal() {
            myModal.show();
        }
        
        function closeModal() {
            myModal.hide();
        }
        
        function wrongAnswserAlert() {
            var wrapper = document.createElement('div');
            wrapper.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="wrongAnswerAlert" role="alert"><h4 class="alert-heading">⭕Beep Beep!</h4><hr><p>Wrong answer!</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            
            document.body.append(wrapper);
            
            setTimeout(() => {
                wrapper.remove();
            }, 5000);
        }
        
        function correctAnswserAlert() {
            var wrapper = document.createElement('div');
            wrapper.innerHTML = '<div class="alert alert-success alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="correctAnswerAlert" role="alert"><h4 class="alert-heading">✔️Nice!</h4><hr><p>Correct answer!</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            
            document.body.append(wrapper);
            
            setTimeout(() => {
                wrapper.remove();
            }, 5000);
        }
    </script>
</body>
<?php
getFooter();
endDBConnection();
?>