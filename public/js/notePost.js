/**
 * Created by Lucien on 27/06/2017.
 */
$(document).ready(function() {

    setImgChecked();

    $('input[type=radio][name=value_note]').change(function() {
        var infoNote = {
            'id_post' : $("input[name=id_post]").val(),
            'value_note' : $(this).val()
        };
        console.log(infoNote);
        $.ajax({
           type: "POST",
            url: "../ajax/modify_note.php",
            data: {'infoNote': JSON.stringify(infoNote)},
            success: function (note) {
                $("#post_note").text(note);
            }
        });
        setImgChecked();
    });

});

function setImgChecked(){
    $("input[type=radio][name=value_note]").each(function () {
        var id = $(this).attr("id");
        if($(this).is(":checked")){
            $("label[for='"+id+"'] img").attr("src", $("label[for='"+id+"'] img").attr("src").substr(0, $("label[for='"+id+"'] img").attr("src").length - 4) + "-checked.png");
        }
        else{
            $("label[for='"+id+"'] img").attr("src", $("label[for='"+id+"'] img").attr("src").replace("-checked", ""));
        }
    })
}