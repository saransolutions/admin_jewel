<?php

function getDBConnection(){
	$username = getenv("DB_USER");
	$password = getenv("DB_PASS");
	$name = getenv("DB_NAME");
	$conn=mysqli_connect('localhost', $username, $password, $name) or die("error occurred on getConnection " . mysqli_error($conn));
	return $conn;
}
function executeSQL($sql){
	if (!mysqli_query(getDBConnection(), $sql))
	{
		die($sql . ' - executeSQL Error: ' . mysqli_error());
	}
}

function selectSQL($sql){
	$query= mysqli_query(getDBConnection(), $sql) or die ("error occured in selectSQL ".mysqli_error()." sql - ".$sql);
	return $query;
}


function getFetchArray($sql){
    $conn=getDBConnection();
	$result= mysqli_query($conn, $sql) or die ("Er:getFetchArray ".mysqli_error()." sql - ".$sql);
	$rows=null;
	while ($row=mysqli_fetch_array($result, MYSQLI_BOTH)){
		$rows[] = $row;
	}
	/* free result set */
	mysqli_free_result($result);
	/* close connection */
	mysqli_close($conn);
	return $rows;
}

function getSingleValue($sql){
	$conn=getDBConnection();
	$result= mysqli_query($conn, $sql) or die ("getSingleValue ".mysqli_error()." sql - ".$sql);
	$value=null;
	if($result){
	    while ($row=mysqli_fetch_array($result, MYSQLI_BOTH)){
	           $value = $row[0];
	    }
	}
	/* free result set */
	mysqli_free_result($result);
	/* close connection */
	mysqli_close($conn);
	return $value;
}

function cheNull($value){
	if(is_null($value) || strlen($value) == 0){
		return 'NULL';
	}else{
		return $value;
	}
}

function cheSNull($value){
	if(is_null($value) || strlen($value)==0){
		return 'NULL';
	}else{
		return "'".$value."'";
	}
}
function verifyUser($username, $password){
    $bid = -1;
	$sql = "SELECT bid, role FROM ".getenv("DB_NAME").".bookies WHERE username ='".$username."' and password = '".$password."'";
	$rows = getFetchArray($sql);
    if ($rows != null){
        $rowCounts= count($rows);
        if($rowCounts != 0) {
            foreach ($rows as $result)
            {
                $bid= $result['bid'];
                $role= $result['role'];
				if($role== "admin"){
					$_SESSION['role']= $role;
                }
                $_SESSION['bid']= $bid;
                $_SESSION['user']= $username;
                return $bid;
            }
        }
    }
    return $bid;
}
?>
