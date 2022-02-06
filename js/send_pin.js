function getdata() {
  let u = localStorage.getItem('userDetail')
  d = JSON.parse(u)
  n = d.userName
  let e = localStorage.getItem('password')
  
 fetch('http://localhost:8066/enquiry/getUserDetail', {
   headers: {
     Accept: 'application/json',
     'Content-Type': 'application/json',
   },
   method: 'post',
   body: JSON.stringify({
     userName: n,
     key: e,
   }),
 })
   .then(function (response) {
     return response.json();
   })
   .then(function (data) {
  document.getElementById('userName').innerHTML = data.userName;
  w = data.walletDto.pinValue;
  b = document.getElementById('walletBalance');
  b.value = w;
     
   })
   .catch(function (error) {
     console.log(error);
   });
}

function sendPin(){
  let detail = localStorage.getItem("userDetail");
  userdetail = JSON.parse(detail)
  userid = userdetail.userId
  amount = document.getElementById("amount").value
  member = document.getElementById("memberName").value
  fee = 0
 

  fetch("http://localhost:8066/enquiry/sendPv", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "post",
    body: JSON.stringify({

      memberName : member,
      userId: userid ,
      amountTransfer : amount,
      fees: fee
    }),
  })
    .then(function (response) {
      alert('Request Success');
      window.location.href='send_pins.html'
      return response.json()
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

getdata();
getGold()