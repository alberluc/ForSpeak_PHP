/**
 * Created by Lucien on 26/06/2017.
 */

$(".link-button").wrap("<div class='wrap-link-button'>");
$(".wrap-link-button").each(function () {
    var linkbutton = $(this).html();
   $(this).html(linkbutton + "<span class='second-link-button'>" +linkbutton + "</span>");
});