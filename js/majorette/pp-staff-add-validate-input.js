let check_id;
$(document).ready(function() {
    $('input').on('keyup', isValid);

    $("#id_rfid").focusout(function(){
        var idRfid = $(this).val().trim();

        if(idRfid.length == 6){
            $.ajax({
                url: 'pp-check-duplicate-id.php',
                type: 'GET',
                data: {idStaff: idStaff},
                success: function(response){
                    $('#staff_id_response').html(response);
                }
            });
        }else{
            $("#staff_id_response").html("");
        }
    });

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
        $('#submit_button').prop('disabled', false);
        if(check_id === false){ //check duplicate
            $('#submit_button').prop('disabled', true);
        }
    }

    else{
        $('#submit_button').prop('disabled', true);
    }
}
function validRfid(e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        // document.getElementById('rfid_response').style.display = 'block';
        // document.getElementById('rfid_response').style.color = 'red';
        // document.getElementById('rfid_response').innerHTML = 'กรุณากรอกเฉพาะตัวเลข';
        return false;
    } else {
        // document.getElementById('rfid_response').style.display = 'none';
        return true;
    }

}