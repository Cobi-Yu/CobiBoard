var app = angular.module("board",[]);
app.config(function ($httpProvider) {
	// $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	$httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded; charset=utf-8";
	$httpProvider.defaults.transformRequest = function(data) {
		if (data != undefined) return $.param(data);
	};
});
