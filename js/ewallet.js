function getdata() {
  let d = localStorage.getItem("userDetail");
  user = JSON.parse(d);
  id = user.userId;
  document.getElementById("userName").innerHTML = user.userName
  w = user.walletDto.walletBalance;
  document.getElementById("walletBalance").innerHTML =user.walletDto.walletBalance ;
 
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

function getPersonalTransaction() {
  let d = localStorage.getItem('userDetail');
  user = JSON.parse(d);
  id = user.userId;
  fetch('http://localhost:8066/enquiry/getPersonalTrans', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
      userId: id,
    }),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data);
      var table = document.getElementById('personalTransaction');
      for (var i = 0; i < data.length; i++) {
        var row = `<tr>
        <td>${i + 1}</td>
        <td>${data[i].details}</td>
        <td>${data[i].amount}</td>
        <td>${data[i].balance}</td>
        <td>${data[i].createdDate}</td>
        <tr>`;
        table.innerHTML += row;
      }
    })
    .catch(function (error) {
      console.log(error);
    });
}

function transferRequest(){
  alert('masuk')
  let detail = localStorage.getItem("userDetail");
  userdetail = JSON.parse(detail)
  userid = userdetail.userId
  amount = document.getElementById("amount").value
  fee = 0
 

  fetch("http://localhost:8066/enquiry/convertPV", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "post",
    body: JSON.stringify({

      userId: userid ,
      amountTransfer : amount,
      fees: fee
    }),
  })
    .then(function (response) {
      alert('Request Success');
      window.location.href='homepage.html'
      return response.json()
    })
    
    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}

getdata();
getGold()
getPersonalTransaction()
