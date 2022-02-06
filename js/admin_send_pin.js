function getdata() {
  
  let u = localStorage.getItem('userDetail')
  d = JSON.parse(u)
  n = d.userName
  let e = localStorage.getItem('password')
  p = JSON.parse(e)
  console.log(p)
 fetch('http://localhost:8066/enquiry/getUserDetail', {
   headers: {
     Accept: 'application/json',
     'Content-Type': 'application/json',
   },
   method: 'post',
   body: JSON.stringify({
     userName: n,
     key: p,
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
      var table = document.getElementById('pinHistory');
      for (var i = 0; i < data.length; i++) {
        var row = `<tr>
        <td>${i + 1}</td>
        <td>${data[i].details}</td>
        <td>${data[i].amount}</td>
        <td>${data[i].createdDate}</td>
        <td>${data[i].balance}</td>
        <tr>`;
        table.innerHTML += row;
      }

      //   var table = document.getElementById("pinHistory");
      // for (var i = 0; i < data.length; i++) {
      //   var row = `<tr>
      // 				<td>${data[i].transId}</td>
      // 				<td>${data[i].details}</td>
      // 				<td>${data[i].amount}</td>
      //         <td>${data[i].createdDate}</td>
      //         <td>${data[i].balance}</td>

      // 		  </tr>`;
      //   table.innerHTML += row;
      // }
    })
    .catch(function (error) {
      console.log(error);
    });
}

function searchHistory() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('searchHistory');
  filter = input.value.toUpperCase();
  table = document.getElementById('pinHistory');
  tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
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
getPersonalTransaction();
