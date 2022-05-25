
    function plotGraph() {
        var canvasCurrent = document.getElementById('divCurrentBar');
        var canvasPrevious = document.getElementById('divPreviousBar');
        var labelDIV = null;
        var cssStyle = null;
        var barDIV = null;
        var labelDIV2 = null;
        var cssStyle2 = null;
        var barDIV2 = null;


        var clrs = [
               "#0000ff", "#430523", "#045000", "#540061", "#240022", "#030005", "#0430ff", "#004332", "#00003f", "#20303f"
        ];

        var obj = {
            "Current": [
            { "Name": "Proctor", "MarketShare": 45.50, "Sales": 200000.00 },
            { "Name": "Unga Group", "MarketShare": 30.50, "Sales": 150000.00 },
            { "Name": "House Of Manji", "MarketShare": 25.50, "Sales": 120000.00 }
            ],
            "Previous": [
            { "Name": "Proctor", "MarketShare": 65.50, "Sales": 350000.00 },
            { "Name": "Unga Group", "MarketShare": 20.50, "Sales": 80000.00 },
            { "Name": "House Of Manji", "MarketShare": 25.50, "Sales": 110000.00 }
            ]
        };

        //if canvas is null, 
        if (canvasCurrent == null) {
            //clear canvas and return

            return false;
        }

        //if no colours defined return
        if (clrs == null) {
            return false;
        }

        //Current vendor sales data
        if (obj.Current != null) {
            var objCurrent = obj.Current;

            for (var counter = 0; counter < objCurrent.length; counter++) {
                //create label div
                labelDIV = document.createElement("DIV");

                labelDIV.innerHTML = objCurrent[counter].Name;

                //Create divLabel style
                labelDIV.style.color = clrs[counter];
                labelDIV.style.fontStyle = "italic";
                labelDIV.style.fontWeight = "bold";

                canvasCurrent.appendChild(labelDIV);

                //create bar div
                //<div style="height: 30px; width:250px; background-color: #0000ff; display: block; margin-bottom:10px;">1</div>
                var gWidth = (Math.round(parseFloat(objCurrent[counter].MarketShare))) * 5;
				var marketShare=Math.round(parseFloat(objCurrent[counter].MarketShare));
				
                barDIV = document.createElement("DIV");
                barDIV.style.height = "30px";
                barDIV.style.width = gWidth + "px";
                barDIV.style.backgroundColor = clrs[counter];
                barDIV.style.display = "block";
                barDIV.style.marginBottom = "10px";
				barDIV.style.color="#ffffff";
				barDiv.style.innerHTML=marketShare;


                canvasCurrent.appendChild(barDIV);

            }
        }

            //Current vendor sales data
            if (obj.Previous != null) {
                var objPrevious = obj.Previous;

                for (var counter = 0; counter < objPrevious.length; counter++) {
                    //create label div
                    labelDIV2 = document.createElement("DIV");
                
                    labelDIV2.innerHTML = objPrevious[counter].Name;

                    //Create divLabel style
                    labelDIV2.style.color = clrs[counter];
                    labelDIV2.style.fontStyle = "italic";
                    labelDIV2.style.fontWeight = "bold";

                    canvasPrevious.appendChild(labelDIV2);

                    //create bar div
                    //<div style="height: 30px; width:250px; background-color: #0000ff; display: block; margin-bottom:10px;">1</div>
                    gWidth = (Math.round(parseFloat(objPrevious[counter].MarketShare))) * 5;

                    barDIV2 = document.createElement("DIV");
                    barDIV2.style.height = "30px";
                    barDIV2.style.width = gWidth + "px";
                    barDIV2.style.backgroundColor = clrs[counter];
                    barDIV2.style.display = "block";
                    barDIV2.style.marginBottom = "10px";
                

                    canvasPrevious.appendChild(barDIV2);

                }
        }
    }