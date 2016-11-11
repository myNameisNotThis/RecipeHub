<?php
require 'update_functions.php';

function update_fooditem($id,$updates) {
	
	$statement = $pdo->prepare( item_build_query($updates,$pdo) );
	item_bindValues($updates,$id,$statement);
	
	if( $statement->execute() ) {
		
		return true;
		
	} else {
		
		print_r( $pdo->errorInfo() );
		return false;
		
	}
	
}