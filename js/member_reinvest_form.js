


function reinvest() {
    let d = localStorage.getItem('userDetail')
    storedData = JSON.parse(d)
    console.log(storedData)

        var p = storedData.walletDto.pinValue;
       var pins = document.getElementById('pins')
       pins.value =  p
     
       var n = storedData.userName
       var name = document.getElementById('username')
       name.value = n

       document.getElementById('userName').innerHTML = storedData.userName
      
       var cp = storedData.packages.packages_NAME
       var currentPlan = document.getElementById('currentPackage')
       currentPlan.value = cp
    
  fetch('http://localhost:8066/enquiry/getPackageList', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'get',
   
  })
    .then(function (response) {
      return response.json()
    })
    .then(function (data) {
        localStorage.setItem('userDetail', JSON.stringify(data));
        console.log(data)
        var plan = document.getElementById("inputPlan");
           
        //Add the Options to the DropDownList.
        for (var i = 0; i < data.length; i++) {
            var planList = document.createElement("OPTION");

            //Set Customer Name in Text part.
            planList.innerHTML = data[i].packages_NAME;

           
            //Add the Option element to DropDownList.
            plan.add(planList);
        }
    })
    .catch(function (error) {
      console.log(error);
    });
}

reinvest()
