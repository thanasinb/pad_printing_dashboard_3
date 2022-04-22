$(document).ready(function() {
    $('input').on('keyup', isValid);
});
function isValid() {
    // alert('hello');
    let requiredInputs = $('input[required]');
    let emptyField = false;
    $.each(requiredInputs, function() {
        if( $(this).val().trim().length == 0 ) {
            emptyField = true;
            return false;
        }
    });
    if(!emptyField) {
        $('#submit_button').attr('disabled', false);
    }else{
        $('#submit_button').attr('disabled', true);
    }
}
function checkOnlyDigits(e) {
    e = e ? e : window.event;
    var charCode = e.which ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        // document.getElementById('errorMsg').style.display = 'block';
        // document.getElementById('errorMsg').style.color = 'red';
        // document.getElementById('errorMsg').innerHTML = 'กรอกตัวเลขเท่านั้น!!!';
        return false;
    } else {
        // document.getElementById('errorMsg').style.display = 'none';
        return true;
    }
}