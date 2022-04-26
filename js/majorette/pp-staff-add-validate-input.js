
$(document).ready(function() {
    $('input').on('keyup', isValid);

    $("#id_rfid").keyup(function(){
        var idRfid = $(this).val().trim();

        if(idRfid != ''){
            $.ajax({
                url: 'pp-staff-add-check-rfid.php',
                type: 'GET',
                data: {idRfid: idRfid},
                success: function(response){
                    $('#rfid_response').html(response);
                }
            });
        }else{
            $("#rfid_response").html("");
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
        if(check_id == false){
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

