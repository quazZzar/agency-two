(function ($) {

	/* ///// Template Helper Function ///// */
	$.fn.hasAttr = function( attribute ) {
		var obj = this;

		if( obj.attr(attribute ) !== undefined ) {
			return true;
		} else {
			return false;
		}
	};
	var WPTheme = {
		init: function() {
			this.subscription();
			this.menus();
			this.scrollPopup();
		},
		menus: function(){
			$('.menu_toggle').on('click', function(){
				$('.main-nav').toggleClass('visible');
			});
		},
		subscription: function(){
			$('.subscription_button').on('click', function(){
				var the_email = $(document).find('#subscribtion_email_input').val();

				$.ajax({
					url: ajax_object.ajax_url,
					type: 'POST',
					data: {
						action: 'subscribe_email',
						email: the_email
					},
					success : function( result ){
						var result = JSON.parse(result);
						$(document).find('#subscribtion_email_input').val(result.info);
					},
					error: function(xhr, status, error){
						console.log(xhr, status, error);
					}
				});
			});
			$('.subscription_button2').on('click', function(){
				var the_email = $(document).find('#subscribtion_email_input2').val();

				$.ajax({
					url: ajax_object.ajax_url,
					type: 'POST',
					data: {
						action: 'subscribe_email',
						email: the_email
					},
					success : function( result ){
						var result = JSON.parse(result);
						$(document).find('#subscribtion_email_input2').val(result.info);
					},
					error: function(xhr, status, error){
						console.log(xhr, status, error);
					}
				});
			});
		},
		scrollPopup: function(){
			var visible = false;

			window.onscroll = function() {
			    var scrollDistance = 70;
			    if (document.body.scrollTop > scrollDistance || document.documentElement.scrollTop > scrollDistance) {
			        if (!visible) {
			            $("#popup").fadeIn();
			            visible = true;
			        }
			    } else {
			        if (visible) {
			            $("#popup").fadeOut();
			            visible = false;
			        }
			    }
			}
		},
}
		close_popup = function() {
		    $("#popup").fadeOut(function() {
		        $("#popup").css("visibility", "hidden");
		    });
		}
	$( document ).ready( function () {
		WPTheme.init();
	});
}( jQuery ));