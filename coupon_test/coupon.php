<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.2.min.js"></script>
<h3>Success handler</h3>
<div class="feedback-box-success"></div>
<h4>Log (success)</h4>
<ol id="log_success"></ol>
<hr>



<script>
    function get_fb_success(){
    $('#log_success').append('<li>get_fb() ran</li>');
    var feedback = $.ajax({
        type: "POST",
        url: "feedback.php",
        async: false
    }).success(function(){
        setTimeout(function(){get_fb_success();}, 5000);
    }).responseText;
    $('div.feedback-box-success').html(feedback);
    if(feedback == "doesn't exist"){
   window.location.href= '../index.php';
    }
}



$(function(){
    get_fb_success();
});
</script>