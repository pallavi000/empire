function getdata() {
  let d = localStorage.getItem("userDetail");
  user = JSON.parse(d);
  id = user.userId;
  document.getElementById("userName").innerHTML = user.userName
  w = user.walletDto.walletBalance;
  b = document.getElementById("walletBalance");
  b.value = w;

}

function requestWithdraw(){
  let detail = localStorage.getItem("userDetail");
  userdetail = JSON.parse(detail)
  userid = userdetail.userId
  amount = document.getElementById("amount").value
  fee = 0
  
 if(userdetail.bankName==null || userdetail.bankAccNum==null ){
  alert('No Bank Details found!')
}
 
 else{

  fetch("http://localhost:8066/enquiry/withdraw", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "post",
    body: JSON.stringify({
      userId: userid,
      amount: amount,
      fees: fee ,
     
    }),
  })
    .then(function (response) {
      alert('Request Success');
      window.location.href='homepage.html'
      return response.json()
    })
    
    .catch(function (error) {
      console.log(error);
    });
}
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
