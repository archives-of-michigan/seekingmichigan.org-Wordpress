/*
 * Ajax Plugin for NextGEN gallery
 * Version:  1.0.0
 * Author : Alex Rabe
 */ 
(function($) {
nggAjax = {
		settings: {
			url: nggAjaxSetup.url, 
			type: "POST",
			action: nggAjaxSetup.action,
			operation : nggAjaxSetup.operation,
			nonce: nggAjaxSetup.nonce,
			ids: nggAjaxSetup.ids,
			permission: nggAjaxSetup.permission,
			error: nggAjaxSetup.error,
			failure: nggAjaxSetup.failure,
			timeout: 10000
		},
	
		run: function( index ) {
			s = this.settings;
			var req = $.ajax({
				type: "POST",
			   	url: s.url,
			   	data:"action=" + s.action + "&operation=" + s.operation + "&_wpnonce=" + s.nonce + "&image=" + s.ids[index],
			   	cache: false,
			   	timeout: 10000,
			   	success: function(msg){
			   		switch (msg) {
			   			case "-1":
					   		nggProgressBar.addNote( nggAjax.settings.permission );
						break;
			   			case "0":
					   		nggProgressBar.addNote( nggAjax.settings.error );
						break;
			   			case "1":
					   		// show nothing, its better
						break;
						default:
							// Return the message
							nggProgressBar.addNote( "<strong>ID " + nggAjax.settings.ids[index] + ":</strong> " + nggAjax.settings.failure, msg );
						break; 			   			
			   		}

			    },
			    error: function (msg) {
					nggProgressBar.addNote( "<strong>ID " + nggAjax.settings.ids[index] + ":</strong> " + nggAjax.settings.failure, msg );
				},
				complete: function () {
					index++;
					nggProgressBar.increase( index );
					// parse the whole array
					if (index < nggAjax.settings.ids.length)
						nggAjax.run( index );
					else 
						nggProgressBar.finished();
				} 
			});
		},
	
		init: function( s ) {

			var index = 0;	
					
			// get the settings
			this.settings = $.extend( {}, this.settings, {}, s || {} );

			// start the ajax process
			this.run( index );			
		}
	}
}(jQuery));