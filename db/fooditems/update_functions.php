<?php

function item_build_query($updates) {
	
	$statement = "UPDATE fooditems SET (";
	end($updates);
	$last = key($updates);
	
	if( count( $updates ) === 1 ) {
		
		reset($updates);
		$statement = "UPDATE fooditems SET " . key($updates) . " = " . ":" . key($updates) . " WHERE id = :id";
		return $statement;
		
	} else {
		
		foreach( $updates as $column=>$value ) {
			
			if( $column === $last ) {
				
				$statement .= $column . ")";
				
			} else {
				
				$statement .= $column . ",";
				
			}
			
		}
		
		$statement .= " = (";
		
		foreach( $updates as $column=>$value ) {
			
			if( $column === $last ) {
				
				$statement .= ":" . $column . ")";
				
			} else {
				
				$statement .= ":" . $column . ",";
				
			}
			
		}
		
		$statement .= " WHERE id = :id";
		
		return $statement;		
		
	}
	
}

function item_bindValues($updates,$id,&$statement) {

	foreach( $updates as $column=>$value  ) {
		
		$statement->bindValue( ":" . $column,$value );
		
	}
	
	$statement->bindValue(":id",$id);
	
}