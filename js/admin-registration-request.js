function getdata() {
  let d = localStorage.getItem('userDetail');
  data = JSON.parse(d);
  console.log(data);
  document.getElementById('username').innerHTML = data.userName;
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

function getRegistrationList() {
  fetch('http://localhost:8066/enquiry/getInactiveUser', {
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
      var table = document.getElementById('transactionRequest');
      for (var i = 0; i < data.length; i++) {
        var row = `<tr>
							<td>${i+1}</td>
							<td>${data[i].userName}</td>
							<td>${data[i].fullName}</td>
              <td>${data[i].packages.packages_NAME}</td>
              <td>${data[i].userStatus}</td>
              <td>${data[i].joinedDate}</td>
              <td>
             
<select onchange="requestAction(${data[i].userId})">

    
  <option value="">Approve/Reject</option>
  <option value="ACCEPTED">Approve</option>
  <option value="REJECTED">Reject</option>
 
</select>
              </td>
                          
					  </tr>`;
        table.innerHTML += row;
      }
    })

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}

function requestAction(val) {
  alert(val);

  fetch('http://localhost:8066/enquiry/activeUser?userId=' + val, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'get',
  })
    .then(function (response) {
      window.location.href = 'admin-registration-request.html';
      return response.json();
    })
    .then(function (data) {})

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}
function searchRegistrationRequest() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById('searchRequest');
  filter = input.value.toUpperCase();
  table = document.getElementById('transactionRequest');
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

getdata();
getGold();
getRegistrationList();
