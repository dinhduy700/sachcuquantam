<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
</head>
<body>
	<input type="text" name="text" id="test" value="" name="" onchange="fchange()">
	<script src="http://127.0.0.1:8000/assets/libs/jquery/jquery.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
	<textarea name="editor1"></textarea>
    <script>
    	var options = {
            filebrowserImageBrowseUrl: 'http://127.0.0.1:8000/test2',

          };
          $('#test').change(function(){
          	console.log('12');
          });
          function fchange(a)
          {
          	console.log(a);
          }
            CKEDITOR.replace( 'editor1', options );
    </script>
</body>
</html>