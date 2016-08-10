<?php

	function validate_data($data){
		$data = str_replace( array( '(' , ')' ) , '' , $data );
		$data = strip_tags($data);
		return trim( stripslashes( htmlspecialchars( $data , ENT_QUOTES ) ) );
	}
	

?>