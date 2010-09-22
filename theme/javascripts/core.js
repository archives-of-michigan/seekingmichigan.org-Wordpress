var Airbag = {
	init : function() {
		var c = Airbag;
		var u = c.Utility;

		if (typeof DD_belatedPNG != "undefined") {
			u.addDOMLoadEvent(function() {
				DD_belatedPNG.fix(c.Config.sPNGsel);
			});
		}
	}

	,Config : {
		sPNGsel : "#main-whitebox-left, #main-whitebox-top, #main-whitebox-right"
	}

	,Utility : {
		// From http://www.thefutureoftheweb.com/blog/adddomloadevent
		addDOMLoadEvent : (function(){
			// create event function stack
			var load_events = [],
				load_timer,
				script,
				done,
				exec,
				old_onload,
				init = function () {
					done = true;

					// kill the timer
					clearInterval(load_timer);

					// execute each function in the stack in the order they were added
					while (exec = load_events.shift())
						exec();

					if (script) script.onreadystatechange = '';
				};

			return function (func) {
				// if the init function was already ran, just run this function now and stop
				if (done) return func();

				if (!load_events[0]) {
					// for Mozilla/Opera9
					if (document.addEventListener)
						document.addEventListener("DOMContentLoaded", init, false);

					// for Internet Explorer
					/*@cc_on @*/
					/*@if (@_win32)
						document.write("<script id=__ie_onload defer src=//0><\/scr"+"ipt>");
						script = document.getElementById("__ie_onload");
						script.onreadystatechange = function() {
							if (this.readyState == "complete")
								init(); // call the onload handler
						};
					/*@end @*/

					// for Safari
					if (/WebKit/i.test(navigator.userAgent)) { // sniff
						load_timer = setInterval(function() {
							if (/loaded|complete/.test(document.readyState))
								init(); // call the onload handler
						}, 10);
					}

					// for other browsers set the window.onload, but also execute the old window.onload
					old_onload = window.onload;
					window.onload = function() {
						init();
						if (old_onload) old_onload();
					};
				}

				load_events.push(func);
			}
		})()
	}
}

Airbag.init();