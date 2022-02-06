function getdata() {
  let d = localStorage.getItem('userDetail');
  user = JSON.parse(d);
  id = user.userId;
  document.getElementById('userName').innerHTML = user.userName;
  
}



function searchTransaction() {
  
  document.getElementById('allTransaction').innerHTML =''
  input = document.getElementById('searchTransaction').value;
 
 
  fetch('http://localhost:8066/enquiry/getUserPersonalTrans', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
      userName: input,
    }),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
    
      console.log(data);
      var table = document.getElementById('allTransaction');
      for (var i = 0; i < data.length; i++) {
        var row = `<tr>
        <td>${i + 1}</td>
        <td>${data[i].details}</td>
        <td>${data[i].amount}</td>
        <td>${data[i].createdDate}</td>
        <td>${data[i].status}</td>
        <tr>`;
        table.innerHTML += row;
      }
     
      
    })
    .catch(function (error) {
      console.log(error);
    });


}

function getGold() {
  fetch('http://localhost:8066/enquiry/getGold', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'get',
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      let gp = localStorage.setItem('goldPrice', data);
      console.log(data);
      document.getElementById('priceGold').innerHTML = data.goldPrice;
    })

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}
function sendPin() {
  let detail = localStorage.getItem('userDetail');
  userdetail = JSON.parse(detail);
  userid = userdetail.userId;
  amount = document.getElementById('amount').value;
  member = document.getElementById('memberName').value;
  fee = 12;

  fetch('http://localhost:8066/enquiry/sendPv', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
      memberName: member,
      userId: userid,
      amountTransfer: amount,
      fees: fee,
    }),
  })
    .then(function (response) {
      alert('Request Success');
      window.location.href = 'admin_send_pins.html';
      return response.json();
    })

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}

getdata();
getGold();
// getPersonalTransaction();
