<!-- 

sudo subl testphp.php

http://127.0.0.1/testphp2.php

http://boston.craigslist.org/gbs/cpg/5812003406.html

 -->


 
<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>



<!DOCTYPE html>
<html>
<body>


<?php

//p("this shows that the site is working.");

function run(){

	//two simple test cases
	// $diagram = array_of_dots1();
	// $diagram = array_of_dots2();

	//the diagram given in the picture
	// $diagram = array_of_dots3();

	//the diagram with the "F" point added 
	$diagram = array_of_dots4();

	$diff_ways = alg($diagram);

	print_solution($diff_ways);

}

class Dot{

	//note: the name variable is for debugging. 
	function Dot($name){
		$this->name=$name;
		$this->children = array();
	}

	function add_children($children){
		//$this->children = $children;
		foreach($children as $child_name => $child_obj) {
			$this->children[$child_name]=$child_obj;
		}

	}

	function get_children(){
		return $this->children;
	}

	//returns name, the name of the object (A,B,C...)
	function n(){
		return $this->name;
	}

	//not working
	function kv () {
		
		return array($this->name,$this);

		//not working
		//return each(array($this->name,$this));

	}
}

//triangle
function array_of_dots1(){

	p("regular triangle");

	$A = new Dot("A");
	$B = new Dot("B");
	$C = new Dot("C");

	$A->add_children(array($B->n()=>$B,$C->n()=>$C));
	$B->add_children(array($A->n()=>$A,$C->n()=>$C));
	$C->add_children(array($A->n()=>$A,$B->n()=>$B));

	return array($A,$B,$C);
}

//triangle with line (CD) sticking out of it. 
function array_of_dots2(){

	p("triangle with additional line");

	$A = new Dot("A");
	$B = new Dot("B");
	$C = new Dot("C");
	$D = new Dot("D");

	$A->add_children(array($B->n()=>$B,$C->n()=>$C));
	$B->add_children(array($A->n()=>$A,$C->n()=>$C));
	$C->add_children(array($A->n()=>$A,$B->n()=>$B,$D->n()=>$D));
	$D->add_children(array($C->n()=>$C));

	return array($A,$B,$C,$D);
}


//{"DE":true,"EC":true,"CA":true,"AB":true,"BD":true,"DC":true,"CB":true,"BE":true}
function array_of_dots3(){

	p("diagram in assignment");

	$A = new Dot("A");
	$B = new Dot("B");
	$C = new Dot("C");
	$D = new Dot("D");
	$E = new Dot("E");

	$A->add_children(array($B->n()=>$B,$C->n()=>$C));
	$B->add_children(array($A->n()=>$A,$C->n()=>$C,$D->n()=>$D,$E->n()=>$E));
	$C->add_children(array($A->n()=>$A,$B->n()=>$B,$D->n()=>$D,$E->n()=>$E));
	$D->add_children(array($B->n()=>$B,$C->n()=>$C,$E->n()=>$E));
	$E->add_children(array($B->n()=>$B,$C->n()=>$C,$D->n()=>$D));

	return array($A,$B,$C,$D,$E);
}


//{"EC":true,"CA":true,"AB":true,"BF":true,"FC":true,"CB":true,"BD":true,"DF":true,"FE":true,"ED":true}
function array_of_dots4(){

	p("diagram in assignment with 'F' point");

	$A = new Dot("A");
	$B = new Dot("B");
	$C = new Dot("C");
	$D = new Dot("D");
	$E = new Dot("E");
	$F = new Dot("F");

	$A->add_children(array($B->n()=>$B,$C->n()=>$C));
	$B->add_children(array($A->n()=>$A,$C->n()=>$C,$D->n()=>$D,$F->n()=>$F));
	$C->add_children(array($A->n()=>$A,$B->n()=>$B,$E->n()=>$E,$F->n()=>$F));
	$D->add_children(array($B->n()=>$B,$E->n()=>$E,$F->n()=>$F));
	$E->add_children(array($C->n()=>$C,$D->n()=>$D,$F->n()=>$F));
	$F->add_children(array($B->n()=>$B,$C->n()=>$C,$D->n()=>$D,$E->n()=>$E));

	return array($A,$B,$C,$D,$E,$F);
}

function calc_size($array_of_dots){

	$ht = [];

	foreach($array_of_dots as $par_loc => $par){

		$children = $par->get_children();

		foreach($children as $child_name => $child){

			$ht = check_and_update_ht($par->n(),$child_name,$ht);
		}

	}

	return count($ht);
}

function check_and_update_ht($par_name,$child_name,$ht){

	// $par_name = $par->n();

	// $child_name = $child->n();

	// p("par_name is: " . $par_name);
	// p("child_name is: " . $child_name);
	// p("array_key_exists(".$par_name . $child_name.") is: " . array_key_exists($par_name . $child_name,$ht));
	// p("array_key_exists(".$child_name . $par_name.") is: " . array_key_exists($child_name . $par_name,$ht));

	if(array_key_exists($par_name . $child_name,$ht) == false and 
	   array_key_exists($child_name . $par_name,$ht) == false){

		$ht[$par_name . $child_name] = true;//have seen it 
	}

	return $ht;

}



function print_solution($diff_ways){

	p("@@@@THE FINAL RESULTS@@@@");

	for($i = 0; $i < count($diff_ways); $i++){

		//select one of the set of solutions 
		$obj = $diff_ways[$i]; 

		// p("1");
		// pa($obj);

		for($i1 = 0; $i1 < count($obj); $i1++){

			//select one of the solutions from the selected set.
			$obj1 = $obj[$i1]; 

			// p("2");
			pa($obj1);

			// foreach($obj1 as $key => $value){

			// 	//p("3");
			// 	p($key);
			// }
		}

	}

}

function pa($array){

	echo "<br>".json_encode($array)."</br>";
}

//print double array 
function pda($array){

	for($i = 0; $i < count($array); $i++){
		echo "<br>".json_encode($array[$i])."</br>";
	}
}

function p($string){

	echo "<br>".$string."</br>";
}


function alg($diagram){

	$final_results = array();

	//$size = calc_size($diagram);
	$point_count = count($diagram);

	$line_count = calc_size($diagram);
	//$size = 10;

	for($i = 0; $i < $point_count; $i++){

		$hash_table = array();

		$obj = $diagram[$i];

		//p("letter going in is: " . $obj->n() . "==============");

		//$points_solution_set = traverse($obj,$hash_table,$size);
		$points_solution_set = traverse($obj,$hash_table,$line_count);

		array_push($final_results, $points_solution_set);
	}

	return $final_results;
}

//http://php.net/manual/en/function.is-array.php


function traverse($obj,$current_row,$size){

	//p("parent name is: " . $obj->n());

	$final_solution_set = array();

	foreach($obj->get_children() as $con_obj_name => $con_obj) {

		//p("child is: " . $con_obj_name);

		//if haven't seen this one 
		if(have_not_visited_line($current_row,$obj->n(),$con_obj_name) == true){

			// p("have not seen.");
			// p("combo is: " . $obj->n() . $con_obj_name);

			//update row
			$tmp_current_row = update_hash_table($current_row,$obj->n(),$con_obj_name);

			//if we (in theory) have gone through all of the lines
			if(count($tmp_current_row) == $size){
				//then add it to tmp_final_solution
				array_push($final_solution_set,$tmp_current_row);
			}

			//p("do recurrsive call on " . $con_obj_name);

			//get a table. 
			$tmp_final_solution_set = traverse($con_obj,$tmp_current_row,$size);

			//p("finished recurrsive call. Back to parent: ". $obj->n());

			//put the table into the current final_solution_set
			foreach($tmp_final_solution_set as $row){
				//p("adding rows to final_solution. row is:");
				//pa($row);
				array_push($final_solution_set,$row);
			}

			//(in the future) do another recurrsive call so that we don't have
			//to test the points individually. 

		}
		// else{
		// 	p("have seen.");
		// 	p("row is: ");
		// 	pa($current_row);
		// }
		
	}
	//p("returning final solution set");
	return $final_solution_set;

}


function update_hash_table($ht,$obj_name,$con_obj_name){

	//p("(update_hash_table)");

	//p("obj_name+con_obj_name is: ". ($obj_name.$con_obj_name));

	// p("obj_name is : $obj_name");
	// p("con_obj_name is : $con_obj_name");

	$ht[$obj_name . $con_obj_name] = true;//have seen it 

	return $ht;
}


function have_not_visited_line($ht,$obj_name,$con_obj_name){

	//p("(have_not_visited_line) test");

	//if AB was seen the BA was seen. 

	//p("obj_name is: ". $obj_name);
	// p("table so far: ");
	// pa($ht);

	// p("obj_name is: '" . $obj_name . "' and child name is: '" . $con_obj_name ."'");

	// p("obj_name is: " . $obj_name);
	// p("con_obj_name is: " . $con_obj_name);

	//if($ht[$obj_name . $con_obj_name] == null and $ht[$con_obj_name . $obj_name] = null){
	if(array_key_exists($obj_name . $con_obj_name,$ht) == false and 
	   array_key_exists($con_obj_name . $obj_name,$ht) == false){
	//if(array_key_exists($obj_name . $con_obj_name,$ht) == false){
		//p("array_key_exists('$str1',".json_encode($ht).") is: " . array_key_exists($str1,$ht));
		//p("return true (haven't seen)");
		return true;
	}
	else{
		//p("return false (have seen)");
		return false;
	}
}

run();


?>



</body>
</html>
