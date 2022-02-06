function getdata() {
  let d = localStorage.getItem("userDetail");
  user = JSON.parse(d);
  id = user.userId;
  document.getElementById("username").innerHTML = user.userName
  w = user.walletDto.walletBalance;
  // document.getElementById("walletBalance").innerHTML =user.walletDto.pinValue ;
  fetch("http://localhost:8066/enquiry/getGenealogy?userId="+id, {
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
          document.getElementById('parent').innerHTML = data.userName
          sub = data.subUserName 
          var c = document.getElementById('child');
       for(var i=0;i<sub.length;i++){
        var u =`<li>
        <a>${sub[i]}</a>
        </li>`
        c.innerHTML += u;
       }
      })
      
      .catch(function (error) {
        // alert('Invalid Credential')
        console.log(error);
      });
 
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



getdata()
getGold()