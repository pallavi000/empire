function getdata(){
    let d = localStorage.getItem('userDetail')
    data = JSON.parse(d)
    console.log(data)
    document.getElementById('username').innerHTML = data.userName
    document.getElementById('p-name').innerHTML = data.userName
    document.getElementById('fullName').innerHTML = data.fullName
    document.getElementById('joinedDate').innerHTML = data.joinedDate
    document.getElementById('packageName').innerHTML = data.packages.packages_NAME
    document.getElementById('packageValue').innerHTML = data.packages.package_VALUE
    document.getElementById('status').innerHTML = data.userStatus
    
    s = data.sponserBy
    console.log(s)
    b = document.getElementById('sponsorBy')
    b.value = s
   
    
}

function getGold(){
    fetch("http://localhost:8066/enquiry/getGold", {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        method: "get",
        
      })
        .then(function (response) {
          return response.json()
        })
        .then(function(data){
            let gp = localStorage.setItem("goldPrice",data)
            console.log(data)
            document.getElementById("priceGold").innerHTML = data.goldPrice


        })
        
        .catch(function (error) {
          // alert('Invalid Credential')
          console.log(error);
        });
}
getGold()

getdata()
