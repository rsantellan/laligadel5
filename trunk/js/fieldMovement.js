$(document).ready(function(){
    $("#slider").easySlider({
        auto: true,
        continuous: true
    });
    seleccionarMis5.bootstrap();
    $('#menu_index').addClass('active');
	
	loadQTipModal();
	changeFieldArea();
	loadQTipsOfPlayers();

    var top = 495;//$('#campo').offset().top;
    var goaly = 535;//$('#goaly').offset().top;
    var defense_left = 635; //$('#defense_left').offset().top;
    var defense_right = 635; //$('#defense_right').offset().top;
    var attacker_left = 775; //$('#attacker_left').offset().top;
    var attacker_right = 775; //$('#attacker_right').offset().top;
    $(window).scroll(function (event) {
        // what the y position of the scroll is
        var y = $(this).scrollTop();
        // whether that's below the form
        if (y >= top) {
            // if so, ad the fixed class
            $('#campo').css('top',0);
            $('#goaly').css('top',goaly -top);
            $('#defense_left').css('top',defense_left -top);
            $('#defense_right').css('top',defense_right -top);
            $('#attacker_left').css('top',attacker_left -top);
            $('#attacker_right').css('top',attacker_right -top);
        } else {
            // otherwise remove it
            var delta = top - (top - y);
            $('#campo').css('top',top - delta  );
            $('#goaly').css('top',goaly - delta  );
            $('#defense_left').css('top',defense_left - delta);
            $('#defense_right').css('top',defense_right - delta);
            $('#attacker_left').css('top',attacker_left - delta );
            $('#attacker_right').css('top',attacker_right - delta );
        }
    });
});

function changeFieldArea(){
	$('#field').css('height',pageHeight  );
}

function loadQTipsOfPlayers(){
/*
	$('#players img[tooltip]').each(function()
   {
      $(this).qtip({
         content: $(this).attr('tooltip'), // Use the tooltip attribute of the element for the content
         style: 'dark', // Give it a crea mstyle to make it stand out
		 tip: 'bottomLeft',

      })
   });
*/
$('#players img[tooltip]').each(function()
   {
	$(this).qtip({
	   content: $(this).attr('tooltip'), // Use the tooltip attribute of the element for the content
	   style: 'dark', // Give it a crea mstyle to make it stand out
	   position: {
		  corner: {
			 target: 'rightTop',
			 tooltip: 'bottomLeft'
		  }
	   }
	});
	});
}
function loadQTipModal(){

	$("#help").qtip(
    {
      content: {
         title: {
            text: 'Ayuda',
            button: 'Cerrar'
         },
         text: '&iquest;Como funciona esto? <br /><br />' +
				'Hay que arrastrar cada uno de los jugadores a la posicion que uno quiere <br/><br/>' +
				'&iquest;Te equivocaste? <br/> Arrastra a otro jugador a la misma posicion o presiona <i> "sacar" </i> <br/><br /><br />' +
				'Cuando termines ingresa tu nombre y presiona enviar para compartir tus 5 de la fecha '
      },
      position: {
         target: $(document.body), // Position it via the document body...
         corner: 'center' // ...at the center of the viewport
      },
      show: {
         when: 'click', // Show it on click
         solo: true // And hide all other tooltips
      },
      hide: false,
      style: {
         width: { max: 350 },
         padding: '14px',
         border: {
            width: 9,
            radius: 9,
            color: '#666666'
         },
         name: 'light'
      },
      api: {
         beforeShow: function()
         {
            // Fade in the modal "blanket" using the defined show speed
            $('#qtip-blanket').fadeIn(this.options.show.effect.length);
         },
         beforeHide: function()
         {
            // Fade out the modal "blanket" using the defined hide speed
            $('#qtip-blanket').fadeOut(this.options.hide.effect.length);
         }
      }
   });

   // Create the modal backdrop on document load so all modal tooltips can use it
   $('<div id="qtip-blanket">')
      .css({
         position: 'absolute',
         top: $(document).scrollTop(), // Use document scrollTop so it's on-screen even if the window is scrolled
         left: 0,
         height: $(document).height(), // Span the full document height...
         width: '100%', // ...and full width

         opacity: 0.7, // Make it slightly transparent
         backgroundColor: 'black',
         zIndex: 5000  // Make sure the zIndex is below 6000 to keep it below tooltips!
      })
      .appendTo(document.body) // Append to the document body
      .hide(); // Hide it initially


}