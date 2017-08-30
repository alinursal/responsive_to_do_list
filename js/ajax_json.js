$(document).ready( function(){

    // AJAX

// Call the table on postget.php when we start to run the page
 $.get("include/Proj1Structure.php", function(list1){
      $('#table').html(list1);
     });


 // Call the incompleted tasks on postget.php when we click the noCompleted radio button
 $('#noCompleted').change(function(){
	 $.get("include/Proj1Structure.php?action=list1", function(list1){
             $('#table').html(list1);
            });
	
    }); 


 // Call all tasks on postget.php when we click the Completed radio button
  $('#Completed').change(function(){
     $.get("include/Proj1Structure.php?action=list2", function(list2){
             $('#table').html(list2);
            });
    
    }); 


 // Sort the tasks by date created on postget.php when we click the dateCreated radio button
  $('#dateCreated').change(function(){
     $.get("include/Proj1Structure.php?action=list3", function(list3){
             $('#table').html(list3);
            });
    
    }); 


// Sort the tasks by priority on postget.php when we click the priority radio button
$('#priority').change(function(){
     $.get("include/Proj1Structure.php?action=list4", function(list4){
             $('#table').html(list4);
            });
    
    }); 


// When we click the submitTask button, we submit the new task values on Proj1Structure.php
$('#submitTask').click(function(event){
	$.post("include/Proj1Structure.php?action=new", $('#project1Form').serialize(), function(newTask){
            $('#table').html(newTask);
             });
    event.preventDefault();
    });


// When we click the submitTask2 button, we update the completed tasks on Proj1Structure.php
$('#submitTask2').click(function(event){
    $.post("include/Proj1Structure.php?action=complete", $('#project1Form').serialize(), function(newTask){
            $('#table').html(newTask);
             });
                event.preventDefault();
    });  


// When we click the submitTask3 button, we delete the tasks on Proj1Structure.php
$('#submitTask3').click(function(event){
    $.post("include/Proj1Structure.php?action=delete", $('#project1Form').serialize(), function(newTask){
            $('#table').html(newTask);
             });
                event.preventDefault();
    }); 



});