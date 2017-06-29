/**
 * Created by Lucien on 18/06/2017.
 */

$(".home-post-block").each(function () {
    if($(this).attr("id") == "most-recent")
        $(this).show();
    else
        $(this).hide();
});

$(window).ready(function () {

    $(".form-user").hide();

    //Evenements
    $(".wrap-link-button").click(function () {
        if($(this).parent(".btn-form-user").length != 0)
            $(".form-user").fadeToggle(500);
    });

    $(".home-post-link").click(function () {
        $(".home-post-link").removeClass("active");
        $(this).addClass("active");
        var idBlock = $(this).attr("id");
        $(".home-post-block").each(function () {
            if($(this).attr("id") == idBlock)
                $(this).show();
            else
                $(this).hide();
        });
    });

});