$(document).ready(function() {
$(".form__content").hide();

$('#welcome-btn').on('click', function() {
  $(".welcome__content").fadeOut(700, function() {
    $(".form__content").fadeIn(600);
  });
});

$('#form-btn').on('click', function() {
  $(".form__content").fadeOut(600, function() {
    $(".welcome__content").fadeIn(700);
  });
});


 });