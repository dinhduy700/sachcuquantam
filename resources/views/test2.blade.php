<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
</head>
<body>
	<div class="text2">getUrlParam</div>
	<button id="click">
		Click me
	</button>
	<script src="http://127.0.0.1:8000/assets/libs/jquery/jquery.min.js"></script>
	<script>
		function getUrlParam(paramName) {
		  var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
		  var match = window.location.search.match(reParam);
		  return ( match && match.length > 1 ) ? match[1] : null;
		}
		$('#click').click(function(){
			window.opener.CKEDITOR.tools.callFunction(getUrlParam('CKEditorFuncNum'), 'http://127.0.0.1:8000/storage/photos/banner_1.jpg');
			window.opener.fchange(11212);
		})
		
	</script>

</body>
</html>