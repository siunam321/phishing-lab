<?php
include_once "../template/zh/header_footer.php";
getHeader();
?>

<body class="container">
    <p class="lead bg-info text-center fs-2">你將會在這裡寫一封釣魚電郵！</p>
    <label for="phishingEmailSubject" class="form-label lead text-danger fs-3">在此處輸入您的釣魚電郵：</label>
    <input class="mb-3 form-control" type="text" id="phishingEmailSubject" placeholder="標題：...">
    <div class="mb-3 input-group">
        <textarea class="form-control" id="phishingEmail" rows="5" placeholder="電郵內容：..."></textarea>
        <button class="btn btn-primary" id="submit" onclick="submitEmail()">提交釣魚電郵</button>
    </div>
    <blockquoute class="blockquoute">
        <p class="bg-danger text-warning text-center fs-2">注意：內容必須有以下關鍵詞：（大小寫有分別）<br>
            「Instagram」，「小明」
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
        let response = await fetch('/zh/task6-phishing-submit.php', {
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
            myModalBody.innerHTML = '<p>你發出了你的釣魚郵件！小明中招了！</p><br><p class="lead bg-danger text-warning text-center fs-2">旗幟: 旗幟{我發出了釣魚郵件}</p>';
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
        wrapper.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="wrongAnswerAlert" role="alert"><h4 class="alert-heading">⭕嗶嗶！</h4><hr><p>錯誤釣魚郵件！（錯關鍵詞？)</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        document.body.append(wrapper);
        
        setTimeout(() => {
            wrapper.remove();
        }, 5000);
    }
    
    function correctAnswserAlert() {
        var wrapper = document.createElement('div');
        wrapper.innerHTML = '<div class="alert alert-success alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" id="correctAnswerAlert" role="alert"><h4 class="alert-heading">✔️你好棒！</h4><hr><p>正確釣魚郵件！</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        document.body.append(wrapper);
        
        setTimeout(() => {
            wrapper.remove();
        }, 5000);
    }
    
    function emptyAnswserAlert() {
            var wrapper = document.createElement('div');
            wrapper.innerHTML = '<div class="alert alert-info alert-dismissible fade show" style="width: 300px; display: inline-block; margin: 0px auto; position: fixed; z-index: 10000; top: 20px; right: 20px;" role="alert"><h4 class="alert-heading">⚠️嘿...</h4><hr><p>釣魚郵件的標題和內容不應該是空的...</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

            document.body.append(wrapper);
            
            setTimeout(() => {
                wrapper.remove();
            }, 5000);
        }
</script>

<script>
    document.getElementById('headerZH').className = 'nav-link active';
    document.getElementById('headerHome').className = 'nav-link';
</script>
<?php
getFooter();
?>