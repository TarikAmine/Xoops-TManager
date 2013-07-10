 $(document).ready(function(){
  // sidenav
  $('#tm_nav').affix();
	// make tabs vertical
	$( "#tabs_uniqueid" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs_uniqueid li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	// color picker init
	$('.tmanager_colorpicker').colorpicker();
	// b|i|u ubtton toggle
	$(".bformat").click(function () {
	  $(this).toggleClass("active");
		var check = '#'+$(this).attr('id')+'c';
		 $(check).click();
	});
	// borders toggle
	$(".borders_r_same").change(function () {
		var div = '#'+$(this).attr('name').slice(0,-3);
		$(div+'_sameborders').toggle();
		$(div+'_diffborders').toggle();
	});
	// px/% toggle
	$(".width_toggle").change(function () {
		var div_unit = '#'+$(this).attr('name').slice(0,-5)+'_nbr_unit';
		if(this.selectedIndex == 0)
			$(div_unit).text('px');
		else
			$(div_unit).text('% ');
	});
	// number of column divs toggle
	$(".column_toggle").change(function () {
		var divs = $(this).attr('name').slice(0,-7);
		$('.'+divs+'_div').hide();
		$('#'+divs+'_c'+(this.selectedIndex+1)).show();
	});
	// l|c|r toggle
	$(".balign").click(function () {
		var id = $(this).attr('id').slice(0,-2);
		$('.'+id+'_button').removeClass('active');
		$(this).addClass('active');
		$('#'+id+'_input').val($(this).attr('id').substr($(this).attr('id').length - 1));
	});
	// disable colorpicker toggle
	$(".bg_transparent").change(function () {
		var id = '#'+$(this).attr('id').slice(0,-2);
		if($(this).attr('checked'))
			$(id).prop('disabled', true);
		else
			$(id).prop('disabled', false);
	});
	// toggle number input
	$(".toggle_number").change(function () {
		var id = '#'+$(this).attr('id').slice(0,-5);
		if($(this).is(':checked')){
			$(id+'_number').prop('disabled', true);
			if ($(this).is('.disablednumber')){
				$(id.slice(0,-5)+'_type').prop('disabled', true);
				$(id.slice(0,-5)+'_color').prop('disabled', true);
				$(id+'_number').prop('value', 0);
			}else
				if ($(this).is('.autonumber'))
					$(id+'_number').prop('value', 'auto');
				else
					$(id+'_number').prop('value', 'inhert');
		}else{
			$(id+'_number').prop('disabled', false);
			if ($(this).is('.disablednumber')){
				$(id.slice(0,-5)+'_type').prop('disabled', false);
				$(id.slice(0,-5)+'_color').prop('disabled', false);
				$(id+'_number').prop('value', 0);
			}else
				$(id+'_number').prop('value', 0);
		}
	});
	
});
