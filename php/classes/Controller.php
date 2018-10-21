<?php

    include "DatabaseConnection.php";
    
    class Controller extends DatabaseConnection {

    	function addBeach($name, 
                            $location, 
                            $description,
                            $elevation,
                            $longitude,
                            $latitude, 
                            $thingsToDo, 
                            $sandColor, 
                            $waterClarity, 
                            $waveIntensity
                        ){

    		$this->open_connection();

			$sql = $this->dbHolder->prepare("INSERT INTO beaches VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$sql->execute(array($name, 
                                    $location, 
                                    $description,
                                    $elevation,
                                    $longitude,
                                    $latitude, 
                                    $thingsToDo, 
                                    $sandColor, 
                                    $waterClarity, 
                                    $waveIntensity
                                    ));

    		$this->close_connection();
    	}

        function displaySpecificBeach($beachId) {
            $this->open_connection();

            $sql = $this->dbHolder->prepare("SELECT * FROM beach WHERE beachId = ?;");
            $sql->execute(array($beachId));
            $data = $sql->fetch();
            $this->close_connection();
            
            return $data;
        }

        function searchBeach($keyWord) {
            $this->open_connection();

            $sql = $this->dbHolder->prepare("SELECT beachId, name FROM beaches WHERE name LIKE ? OR location LIKE ?;");
            $sql->execute(array("%".$keyWord."%", "%".$keyWord."%"));
            $data = $sql->fetch();

            $this->close_connection();

            return $data;
        }

        function getListSortedByAffordability() {
            $this->open_connection();

            $sql = $this->dbHolder->prepare("SELECT * FROM beaches ORDER BY price DESC LIMIT 5;");
            $data = $sql->fetch();
            $this->close_connection();

            return $data;
        }

        function getListSortedByCrowdDensity() {
            $this->open_connection();

            $sql = $this->dbHolder->prepare("SELECT * FROM beaches ORDER BY crowdDensity ;");
            $data = $sql->fetch();
            $this->close_connection();

            return $data;

            $this->close_connection();
        }

        function displayImage() {
            $this->open_connection();

            $sql = $this->dbHolder->query("SELECT * FROM images LIMIT 1;");
            $con = $sql->fetch();


            echo '<img src="data:image/jpeg;base64,' . base64_encode($con[2]) . '" width="290" height="290">';
            //echo '<img src="data:image/jpeg;base64,'.base64_encode($con[2]).'" width="500" height="100"/>';
            //header('Content-type: image/jpeg');
            //echo $con[2];

            //echo "<img src='data:".$con[3].";base64,".base64_encode($con[2])."'/>";

            $this->close_connection();
        }

        function uploadBeachImage($id, $image, $type) {
            $this->open_connection();

            $sql = $this->dbHolder->prepare("INSERT INTO images VALUES (null, ?, ?, ?);");
            $sql->execute(array($id, $image, $type));

            $this->close_connection();
        }

        function displayRecNum() {
            $this->open_connection();

            $sql1 = $this->dbHolder->query("SELECT count(*) FROM beaches;");
            $num = $sql1->fetch()[0];

            if($num == 1) $num = "(".$num." record)";
            else $num = "(".$num." records)";

            echo $num;


            $this->close_connection();
        }
		
		function displaySelBeaches() {
			$this->open_connection();
			
			$sql = $this->dbHolder->query("SELECT beachId, name FROM beaches ORDER BY name;");
			
			$data = "";
			while($con = $sql->fetch()) {
				$data .= "<option value=".$con[0].">".$con[1]."</option>";
			}
			echo $data;
			
			$this->close_connection();
		}

    }
