<?php

$error= true;
$isValid = true;
$taskName = "";
$priority = "";
$sortBy = "";
$includeCompleted = false;
include("../database/common.php");

	
	if( $_SERVER['REQUEST_METHOD'] == "GET") {

		if (isset($_GET['action']) && !empty($_GET['action'])) {

	$action = $_GET['action'];

	/*
		This section of code would be requested if the action is GET. 
		The specific action is included in the URL, such as "index.php?action=xxxxx"
	*/	
		if ($action == "list1"){

			// After Ajax call, run the reloadPage PHP function with variables below to see the incompleted tasks 
			
			$includeCompleted = true;
			$sortBy = "dateCreated";
			reloadPage($sortBy,$includeCompleted);

		}else if ($action == "list2") {

			// After Ajax call, run the default reloadPage PHP function to see the all tasks 

			reloadPage();

		}else if ($action == "list3") {

           // After Ajax call, run the default reloadPage PHP function to sort the tasks by date created 

			reloadPage(); 

		}else if ($action == "list4") {

			// After Ajax call, run the reloadPage PHP function with variables below to sort the tasks by priority 

			$includeCompleted = false;
			$sortBy = "priority desc";
			reloadPage($sortBy,$includeCompleted);
		}


} else {

	        // run the default reloadPage PHP function
			reloadPage(); 
		
	}

} else if ( ($_SERVER['REQUEST_METHOD'] == 'POST' )) {  

    // we get action links for Post Method
	$action = $_GET['action'];

		if ($action == "new" ){
			
       // get the POST variables to store them on Database
			$taskName = $_POST['taskName'];
			$priority = $_POST['priority'];
			

        // validation for a new empty task
            if (empty($taskName)) {
            
                 $isValid = false;
                 
                 reloadPage(); 

	             echo "<b>"."A new task must be filled in!"."</b>"."<br/><br/>";
            
            }

          // validation for a new empty priority
            if (empty($priority)) {
            
                 $isValid = false;

                 reloadPage(); 

	             echo "<b>"."Priority must be filled in!"."</b>"."<br/><br/>";
            
            }

           // After validation, store the new task on Database
            if ( $isValid == true ) { 

            	$q2=  $conn->query("INSERT INTO task(description, priority) values ('".$taskName."', '".$priority."')");
           
           // Database validation
            	if ($conn->insert_id > 0){

                      $error=true;

                                       }else{
                       $error=false;
                                            }                        
    if ($error){
          reloadPage(); 
		  } else {
 echo "<b>"."There was an issue about database. Please try again!"."</b>";
		  }

            } // end of if($isValid == true)


// begin of action == complete
		} else if ($action == "complete") {

			  //$completeTask = $conn->escape_string($_POST['completeTask']);

// After Ajax call, if completeTask POST variable is not empty, update the completed tasks on Database
if (isset($_POST['completeTask'])) {

               // Use foreach loop to get the task ID
			  foreach (  $_POST['completeTask'] as $value ) {

              // Update task table where completed is equal to 1 also we add the current date
			  $q3=  $conn->query("UPDATE task SET completed = 1, dateCompleted = NOW() WHERE id=".$value."");

			 // $q3 = sprintf("UPDATE task SET completed = '%d', dateCompleted = '%d' WHERE itemID = '%d'", 1, NOW(), $value);

                       // Database validation
			           	if ($conn->affected_rows > 0){

                      $error=true;

                                       }else{
                       $error=false;
                                            }

}

          if ($error){
          reloadPage(); 
		  } else {
 echo "<b>"."There was an issue about database. Please try again!"."</b>"."<br/><br/>";
		  }


}else {

	reloadPage(); 

	echo "<b>"."Please first select the tasks for Complete Tasks button!"."</b>"."<br/><br/>";
}
// end of action == complete
// begin of action == delete
		 } else if ( $action == "delete" ) {

// After Ajax call, if completeTask POST variable is not empty, delete the tasks on Database
		 	if (isset($_POST['completeTask'])) { 

               // Use foreach loop to get the task ID
			  foreach (  $_POST['completeTask'] as $value ) {

               // Delete tasks on Database
			  $q4=  $conn->query("DELETE FROM task WHERE id=".$value."");

                        // Database validation
			           	if ($conn->affected_rows > 0){

                            $error=true;

                                       }else{

                            $error=false;
                    
                                            }

		 }

		  if ($error){
          reloadPage(); 
		  } else {
 echo "<b>"."There was an issue about database. Please try again!"."</b>"."<br/><br/>";
		  }

}else {
reloadPage(); 
echo "<b>"."Please first select the tasks for Delete Tasks button!"."</b>"."<br/><br/>";
}

// end of action == delete
		}

// end of REQUEST_METHOD = POST
	} else {
      
      // run the default reloadPage PHP function
      reloadPage(); 
	}





//this function should be called after every action that modifies the database AND on first page load.
function reloadPage($sortBy = "dateCreated", $includeCompleted = false){
  
$term = "";
global $conn;

 // if includeCompleted is equal to true, show the query
 if ( $includeCompleted == true ) {

 $term = "WHERE completed != 1";

 } 

// the query we use everytime with or without PHP objects as long as we call the reloadPage function
$q=  $conn->query("SELECT * FROM task ".$term." ORDER BY ".$sortBy." ");

        // Database validation
   		if ($q->num_rows > 0){
			
			// Print table with selecting task rows to show from database
			print "<table class='formStyle'>
					<tr class='formTitle'>
						<th>Description</th>
						<th>Priority</th>
						<th>Date Created</th>
						<th>Date Completed</th>
					</tr>";

			while($row = $q->fetch_assoc()){
				if ($row['completed'] == "1") {
					print "<tr class='formStyleBack' style='text-decoration: line-through;'>";
				} else {
					print "<tr class='formStyleBack'>";
				}
					print "<td><input type='checkbox' name='completeTask[]' value='".$row['id']."'/>"."&nbsp;".$row['description']."</td>";
				if ( $row["priority"]=="1" ) {
					print "<td>Very Low</td>";
				} else if ( $row["priority"]=="2" ) {
					print "<td>Low</td>";
				} else if ( $row["priority"]=="3" ) {
					print "<td>Medium</td>";
				} else if ( $row["priority"]=="4" ) {
					print "<td>Important</td>";
				} else if ( $row["priority"]=="5" ) {
					print "<td>Very Important</td>";
				}
				print "<td>$row[dateCreated]</td>";
                print "<td>$row[dateCompleted]</td>";
				print "</tr>";
			}
			print "</table>";
			print "<br/>";
		}else{
			print "There are no rows returned from database!"."<br/><br/>";
		}

	//include the code to fetch the content from the database here.
	//i would suggest putting this code within a function so it can be called after each other action
	//however you may also include it on it's own at the end of the file if you wish 

} // end of reloadPage function


?>