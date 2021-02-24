$(document).ready(function() {
		$('li').click(function(){
		var selectedClass = $(this).attr('data-target');
		// console.log(selectedClass);
		$('#main').fadeTo(50, 0);
		$('#main > article').not('.' + selectedClass).fadeOut();
		setTimeout(function(){
		$('.' + selectedClass).fadeIn();
		$('#main').fadeTo(50, 1);	
		}, 500)
		
	})
		
  $(document).on('click', 'ul li', function(){
  	$(this).addClass('active').siblings().removeClass('active')
  });
 
    $(".navbarClick").click(function(){
    $(".navbarDropdown").toggle();
  });

 });