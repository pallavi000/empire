function getdata() {
  let d = localStorage.getItem("userDetail");
  data = JSON.parse(d);
  console.log(data);
  document.getElementById("username").innerHTML = data.userName;
}

function getGold() {
  fetch("http://localhost:8066/enquiry/getGold", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "get",
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      let gp = localStorage.setItem("goldPrice", data);
      console.log(data);
      document.getElementById("priceGold").innerHTML = data.goldPrice;
    })

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}

function getPendingTransaction() {
  fetch("http://localhost:8066/enquiry/getTransaction", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "get",
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      localStorage.setItem('pendingTransaction', JSON.stringify(data));
     
    
      var table = document.getElementById("transactionRequest");
      for (var i = 0; i < data.length; i++) {
        var row = `<tr>
							<td>${i+1}</td>
							<td>${data[i].details}</td>
							<td>${data[i].amount}</td>
              <td>${data[i].status}</td>
              <td>${data[i].createdDate}</td>
              <td>
             
<select onchange="requestAction(this.value,${data[i].transId})">

    
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

function searchRequest(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchRequest");
  filter = input.value.toUpperCase();
  table = document.getElementById("transactionRequest");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  }

function requestAction(val,data){
alert(val)
alert(data)
  
  fetch("http://localhost:8066/enquiry/updateTransaction", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: 'post',
    body: JSON.stringify({

      transId: data,
      action : val
    }),
  })
    .then(function (response) {
      window.location.href='admin-transaction-request.html'
      return response.json();
    })
    .then(function (data) {
      
    })

    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });

}

getdata();
getGold();
getPendingTransaction();
