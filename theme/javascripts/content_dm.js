function ContentDM() {
	this.last_method_result = null;
	this.method_status = false;
}
ContentDM.prototype = {

	callMethod: function(handler, failure, options) {
		var onFail = failure ||
			function(){
				console.log("callMethod: failure");
				alert("Could not fetch list of collections from the server.  Please contact an administrator.");
			};
		var onSuccess = handler ||
			function(data, status) {
				console.log("callMethod: success");
				$('#cdm').innerHtml = data;
			};
		
		options = options || {};
		options.data = options.data || {};
		options.data.params = options.data.params || {};

		if(environment.config.test_stubs) {
			options = this.merge(options, { async: false, cache: false });
			options.data.params = this.merge(options.data.params, { test_stubs: true });
		} else {
			options = this.merge(options, { async: true, cache: true });
		}
		options.data.params = $.toJSON(options.data.params);
		
		var call = jQuery.ajax(this.merge(options,
			{ 
				dataType: 'json',
				type: 'post',
				success: onSuccess,
				error: onFail,
				url: this.url()
		}));

		return true;
	},

	collectionList: function(handler, failure) {
		return this.callMethod(handler, failure, { 
			data: {
				command: 'dmGetCollectionList'
			}
		});
	},

	query: function(options, handler, failure) {
		return this.callMethod(handler, failure, { 
			data: {
				command: 'dmQuery',
				params: options
			}
		});
	},


	merge: function(a, b) {
		var merged = a;
		jQuery.each(b, function(key, value) {
			if(merged[key] == undefined)
		  	merged[key] = value;
		});
		return merged;
	},


	url: function() {
		return 'http://' + environment.config.host + environment.config.path;
	}
};

ContentDM.prototype.Result = function(data, status){
	this.data = data;
	this.status = status;
};