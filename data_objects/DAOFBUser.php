<?php
include_once ("utils/DBUtils.php");

function DAOFBUser_getHCUserId($fbID){
	$query = "SELECT user_id FROM fb_user_users WHERE fb_id = '".$fbID."'";
  	$id = getRow($query);
   	return $id;
}

function DAOFBUser_isFBUserRegistered($fbID){
    $query = "SELECT updated_time  FROM fb_users WHERE fb_id = '".$fbID."'";
    $n = getRow($query);
    return $n==1;
}

function DAOFBUser_registerOrUpdateUser($fbUser){
	$query = "SELECT updated_time FROM fb_users WHERE fb_id = '".$fbUser['id']."'";
	$n = getRow($query);

	if($n!=null){
		// print_r($query.' = '.$n);
		// print_r($n.' = '.$fbUser['updated_time']);
		if($n==$fbUser['updated_time']){
			return true;
		}else{
			$query = "DELETE FROM fb_users WHERE fb_id = '".$fbUser['id']."'";
			$n = runQuery($query);
		}
	}
	//Log
	include_once('data_objects/DAOLog.php');

	DAOLog_log($fbUser['name'].' registered', print_r($fbUser,true));

	if(isset($fbUser['hometown'])){
		DAOFBUser_insertHometownIfNotExists($fbUser['hometown']);
	}
	if (isset($fbUser['location'])) {
		DAOFBUser_insertLocationIfNotExists($fbUser['location']);
	}
	if(isset($fbUser['education'])){
		DAOFBUser_insertFBUserEducationIfNotExists($fbUser['id'],$fbUser['education']);	
	}

	if(isset($fbUser['location'])){
		$locationId = "'".$fbUser['location']['id']."'";
	}else{
		$locationId = "null";
	}
	
	if(isset($fbUser['hometown'])){
		$hometownId = "'".$fbUser['hometown']['id']."'";
	}else{
		$hometownId = "null";
	}

	if(isset($fbUser['gender'])){
		$gender = "'".$fbUser['gender']."'";
	}else{
		$gender = "null";
	}

   	$insertQ = "INSERT INTO fb_users(fb_id, name, first_name, last_name, link,
      username, hometown_id, location_id, gender, updated_time) VALUES
    ('".$fbUser['id']."', 
    	'".$fbUser['name']."',
    	'".$fbUser['first_name']."',
    	'".$fbUser['last_name']."',
    	'".$fbUser['link']."',
    	'".$fbUser['username']."',
    	".$hometownId.",
    	".$locationId.",
    	".$gender.",
		'".$fbUser['updated_time']."');";
    runQuery($insertQ);
}

function DAOFBUser_insertHometownIfNotExists($fbHometown){
	$query = "SELECT count(hometown_id) FROM fb_hometowns where hometown_id = '".$fbHometown['id']."'";
	$n = getRow($query);
	// print_r('hometown query = '.$n);
	// print_r($fbHometown);
	if($n==0){
		$insert = "INSERT INTO fb_hometowns (hometown_id, name) VALUES ('".$fbHometown['id']."','".$fbHometown['name']."')";
		runQuery($insert);
	}
}

function DAOFBUser_insertLocationIfNotExists($fbLocation){
	$query = "SELECT count(location_id) FROM fb_locations WHERE location_id = '".$fbLocation['id']."'";
	$n = getRow($query);
	if($n==0){
		$insert = "INSERT INTO fb_locations (location_id, name) VALUES ('".$fbLocation['id']."','".$fbLocation['name']."')";
		runQuery($insert);
	}
}
function DAOFBUser_insertFBUserEducationIfNotExists($fb_id, $fbEducation){
	
	$deleteQuery="DELETE FROM fb_user_education where fb_id = '".$fb_id."'";
	runQuery($deleteQuery);
	
	foreach ($fbEducation as $key => $value) {
		DAOFBUser_insertSchoolIfNotExists($value['school']);

		if(isset($value['year'])){
			$year = "'".$value['year']['name']."'";
		}else{
			$year= "null";
		}
		$insertQuery = "INSERT INTO fb_user_education (fb_id, school_id, year, type) VALUES 
			('".$fb_id."',
			'".$value['school']['id']."',
			".$year.",
			'".$value['type']."')";
		runQuery($insertQuery);
	}
	
}
function DAOFBUser_insertSchoolIfNotExists($fbSchool){
	$query = "SELECT count(school_id) FROM fb_schools where school_id = '".$fbSchool['id']."'";
	$n = getRow($query);
	if($n==0){
		$insert = "INSERT INTO fb_schools (school_id, name) VALUES ('".$fbSchool['id']."','".$fbSchool['name']."')";
		runQuery($insert);
	}
}



?>