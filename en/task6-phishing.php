<?php
include_once "../template/en/header_footer.php";
getHeader();
?>

<body class="container">
    <p class="lead bg-info text-center fs-2">In here, you'll need to write a phishing email!</p>
    <label for="phishingEmailSubject" class="form-label lead text-danger fs-3">Enter your phishing email here:</label>
    <input class="mb-3 form-control" type="text" id="phishingEmailSubject" placeholder="Subject: ...">
    <div class="mb-3 input-group">
        <textarea class="form-control" id="phishingEmail" rows="5" placeholder="Email: ..."></textarea>
        <button class="btn btn-primary" id="submit" onclick="submitEmail()">Submit</button>
    </div>
    <blockquoute class="blockquoute">
        <p class="bg-danger text-warning text-center fs-2">Note: It must contains the following key words (Case sensitive):<br>
            "Instagram", "Patrick Chan"
        </p>
    </blockquoute>
</body>

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
    // Use Bootstrap's modal components to pop up an alert box
    var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});
    var myModalDialog = document.getElementById('modalDialog');
    var myModalHeader = document.getElementById('modalHeader');
    var myModalTitle = document.getElementById('modalTitle');
    var myModalBody = document.getElementById('modalBody');
        
    async function submitEmail(){
        // Sanitizing "taskNumber" & "questionNumber" via DOMPurify
        const phishingEmail = document.getElementById('phishingEmail').value;
        const phishingEmailSubject = document.getElementById('phishingEmailSubject').value;
        
        const sanitizedPhishingEmail = DOMPurify.sanitize(phishingEmail);
        const sanitizedPhishingEmailSubject = DOMPurify.sanitize(phishingEmailSubject);
        
        if (sanitizedPhishingEmail === '' || sanitizedPhishingEmailSubject === '') {
            emptyAnswserAlert();
            return false;
        }
        
        const phishingEmailData = {
            "phishingEmail": sanitizedPhishingEmail,
            "phishingEmailSubject": sanitizedPhishingEmailSubject
        }
        // Send a POST request to submit_answer.php with the above JSON data
        let response = await fetch('/en/task6-phishing-submit.php', {
           method: 'POST',
           header: {
               'Content-Type': 'application/json'
           },
           body: JSON.stringify(phishingEmailData)
        });
        
        // Wait for the response message
        let result = await response.json();

        if (result === 'correct') {
            correctAnswserAlert();
            // Use Bootstrap's modal components to pop up an alert box
            myModalDialog.className = 'modal-dialog modal-lg';
            myModalHeader.className = 'modal-header bg-success text-white';
            myModalTitle.innerText = 'Correct!';
            myModalBody.innerHTML = '<p>You\'ve sent the phishing email, and Patrick Chan fell into your attack!</p><br><p class="lead bg-danger text-warning text-center fs-2">Flag: flag{I_Sent_A_Phishing_Email}</p>';
            openModal();
        } else if (result === 'incorrect') {
            wrongAnswserAlert();
        } else {
            console.log("Unknown hint result: " + result);
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
        wrapper.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="wrongAnswerAlert" role="alert"><h4 class="alert-heading">⭕Beep Beep!</h4><hr><p>Wrong phishing email! (Wrong key word(s))</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        document.body.append(wrapper);
        
        setTimeout(() => {
            wrapper.remove();
        }, 5000);
    }
    
    function correctAnswserAlert() {
        var wrapper = document.createElement('div');
        wrapper.innerHTML = '<div class="alert alert-success alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="correctAnswerAlert" role="alert"><h4 class="alert-heading">✔️Nice!</h4><hr><p>Correct phishing email!</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        document.body.append(wrapper);
        
        setTimeout(() => {
            wrapper.remove();
        }, 5000);
    }
    
    function emptyAnswserAlert() {
            var wrapper = document.createElement('div');
            wrapper.innerHTML = '<div class="alert alert-info alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" role="alert"><h4 class="alert-heading">⚠️Hmm...</h4><hr><p>The phishing subject/email should\'t be empty...</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

            document.body.append(wrapper);
            
            setTimeout(() => {
                wrapper.remove();
            }, 5000);
        }
</script>

<script>
    document.getElementById('headerEnglish').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
</script>
<?php
getFooter();
?>