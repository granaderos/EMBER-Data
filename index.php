<!Doctype html>
<html>
<head>
    <title>Philippines Beaches!</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="container-fluid" style="margin-top: 50px;">
    <div class="container-fluid">
		<h2>EMBER Data</h2>
		<h4>About Beaches <span id="spanNumRec"></span></h4>
		<hr>
        <div class="row">
            <div class="container-fluid col-lg-5">
                <input type="text" id="txtName" placeholder="Beach/Resort Name" class="form-control" /><br />
                <input type="text" id="txtLocation" placeholder="Location: " class="form-control" /><br />
                <!-- <input type="text" id="txtContact" placeholder="Contact" class="form-control" /><br /> -->
                <textarea type="text" id="txtDescription" placeholder="Description" class="form-control" ></textarea><br />
                <input type="text" id="txtElevation" placeholder="Elevation" class="form-control" /><br />
                <input type="text" id="txtLongitude" placeholder="Longitude" class="form-control" /><br />
                <input type="text" id="txtLatitude" placeholder="Latitude" class="form-control" /><br />
                <!-- <input type="text" id="txtPrice" placeholder="Price" class="form-control" /><br /> -->
                <!-- <select id="txtCrowdDensity" class="form-control">
                    <option value=5>Extremely Crowded</option>
                    <option value=4>Very Crowded</option>
                    <option value=3>Slightly Crowded</option>
                    <option value=2>Crowded</option>
                    <option value=1>Not Crowded</option>
                </select><br /> -->
                <textarea type="text" id="txtThingsToDo" placeholder="Things To Do" class="form-control" ></textarea><br />
                <input type="text" id="txtSandColor" placeholder="Sand Color" class="form-control" /><br />    			
    			<input type="text" id="txtWaterClarity" placeholder="Water Clarity" class="form-control" /><br />
                <input type="text" id="txtWaveItensity" placeholder="Wave Intensity" class="form-control" /><br />
                <!-- <input type="text" id="txtUVIndex" placeholder="UV Index" class="form-control" /><br /> -->
                <!-- <input type="text" id="txtHABPresence" placeholder="HAB Presence" class="form-control" /><br /> -->
                <!-- <textarea type="text" id="txtTideLevel" placeholder="Tide Level" class="form-control"></textarea><br />                 -->
                <button class="btn btn-primary" id="btnAddData">ADD DATA</button>
                <button class="btn btn-danger" id="btnReset">RESET FORM</button>
                
            </div>
            <hr>
            <div class="container-fluid col-lg-5">
                <form id="uploadImageForm" enctype="multipart/form-data" method="POST">
                    <label>Select Beach To Add Image:</label>
                    <select id="selBeaches" name="selBeaches"></select><br />
                    <input type="file" name="inpImage" id="inpImage" /> <br />
                    <button class="btn btn-primary">UPLOAD</button>
                </form>
            </div>
        </div>
        <br />
        <div id="divImageContainer"></div>
        <div>
            <table class="table table-striped" id="tblData"></table>
        </div>
    </div>

    <script src="javascript/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajax({
                type: "POST",
                url: "php/displayImage.php",
                success: function(data) {
                    //$("#divImageContainer").html("<img src='"+data+"' />");
                    $("#divImageContainer").html(data);
                }
            });

            $("#btnReset").click(function() {
                $("#txtName").val("");
                $("#txtLocation").val("");
                $("#txtLatitude").val("");
                $("#txtLongitude").val("");
                $("#txtContact").val("");
                $("#txtDescription").val("");
                $("#txtElevation").val("");
                $("#txtThingsToDo").val("");
                $("#txtSandColor").val("");
                $("#txtWaterClarity").val("");
                $("#txtWaveItensity").val("");
            });

            displaySelBeaches();
            displayRecNum();
            $("#btnAddData").click(function() {
				addData();
			});

            var formData = false;
            if(window.FormData) {
                formData = new FormData();
            }

            $("#uploadImageForm").on("submit", function(e) {
                /*if(formData) {
                    formData.append("reqImage", reqImage);
                    formData.append("studentId", curStudentId);
                    formData.append("reqId", curReqId);*/
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "php/uploadImage.php",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            alert("Image successfully uploaded; " + data);
                        },
                        error: function(data) {
                            alert("oopsy Mj! :( error in uploading image " + JSON.stringify(data));
                        }
                    });
                //}
            });
        });

        function displayRecNum() {
            $.ajax({
                type: "POST",
                url: "php/displayRecNum.php",
                success: function(data) {
                    $("#spanNumRec").html(data);
                }
            });
        }

        function displaySelBeaches() {
            $.ajax({
                type: "POST",
                url: "php/displaySelBeaches.php",
                success: function(data) {
                    $("#selBeaches").html(data);
                }
            });
        }

        function addData() {
            var name = "",
				location = "",
                contact = "",
                description = "",
                elevation = "",
                longitude = "",
				latitude = "",
                // price = "",
                // crowdDensity = "",
                thingsToDo = "",
                sandColor = "",
                waterClarity = "",
                waveIntensity = "";
                // uvIndex = "",
                // habPresence = "",
                // tideLevel = "";

				
			name = $("#txtName").val();
			location = $("#txtLocation").val();
			latitude = $("#txtLatitude").val();
			longitude = $("#txtLongitude").val();
			contact = $("#txtContact").val();
			description = $("#txtDescription").val();
            elevation = $("#txtElevation").val();
            // price = $("#txtPrice").val();
            // crowdDensity = $("#txtCrowdDensity").val();
            thingsToDo = $("#txtThingsToDo").val();
            sandColor = $("#txtSandColor").val();
            waterClarity = $("#txtWaterClarity").val();
            waveIntensity = $("#txtWaveItensity").val();
            // uvIndex = $("#txtUVIndex").val();
            // habPresence = $("#txtHABPresence").val();
            // tideLevel = $("#txtTideLevel").val();
			
			var beachData = {name: name,
						location: location,
						latitude: latitude,
						longitude: longitude,
						contact: contact,
						description: description,
                        elevation: elevation,
                        // price: price,
                        // crowdDensity: crowdDensity,
                        thingsToDo: thingsToDo,
                        sandColor: sandColor,
                        waterClarity: waterClarity,
                        waveIntensity: waveIntensity,
                        // uvIndex: uvIndex,
                        // habPresence: habPresence,
                        // tideLevel: tideLevel
                        }

            $.ajax({
                type: "POST",
                url: "php/addData.php",
                data: beachData,
                success: function(data) {
                    alert("Data added;" + data);
                    displayRecNum();

                    $("#txtName").val("");
                    $("#txtLocation").val("");
                    $("#txtLatitude").val("");
                    $("#txtLongitude").val("");
                    $("#txtContact").val("");
                    $("#txtDescription").val("");
                    $("#txtElevation").val("");
                    $("#txtThingsToDo").val("");
                    $("#txtSandColor").val("");
                    $("#txtWaterClarity").val("");
                    $("#txtWaveItensity").val("");
                }
            })
        }
    </script>
</body>
</html>