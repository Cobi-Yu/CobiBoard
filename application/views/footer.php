<?php
	if(isset($js)){
		foreach ($js as $path) {
			echo '<script src="/asset/js/'.$path.'.js"></script>';
		}
	}
?>

</body>
</html>
