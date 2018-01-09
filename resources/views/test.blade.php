<!DOCTYPE html>
<html>
<head>
	<title>API</title>
</head>
<body>


	<label>Productd Id</label>
	<input type="text" name="id" id="id"><br>
	<input type="submit" value="click" id="submit">

	<div id="result">
		
	</div>		

</body>
</html>


<script src="{{ asset('themes/js/jquery.js') }}" type="text/javascript"></script> 
<script type="text/javascript">
	$(document).ready(function(){

		$('#submit').click(function(){
			var id = $('#id').val();
			var url = "{{route('getData')}}";
			$.ajax(url,{
				type:'GET',
				data:{id:id},
				success:function(data){
					console.log(data);
				}
			});
		});
		
	});
</script>
