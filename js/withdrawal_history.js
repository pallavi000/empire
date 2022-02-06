function getdata() {
  let d = localStorage.getItem("userDetail");
  user = JSON.parse(d);
  var id = user.userId;
  document.getElementById("username").innerHTML = user.userName
  document.getElementById("walletBalance").innerHTML = user.walletDto.walletBalance
  fetch("http://localhost:8066/enquiry/getWithdrawalHistory?userId=" + id, {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "GET",
  })
    .then(function (response) {
      return response.json();

      //return response.text;
    })
    .then(function (data) {
      if(data==''){
        var table = document.getElementById('withdrawHistory')
       var d = `<div style="text-align:center">No Data Available</div>`
       table.innerHTML = d
      }
      else{
        var table = document.getElementById('history')
        for (var i = 0; i < data.length; i++){
			var row = `<tr>
							<td>${i+1}</td>
              <td>${data[i].withdrawalAmount}</td>
							<td>${data[i].withdrawalFee}</td>
              <td>${data[i].withdrawalFee+data[i].withdrawalAmount}</td>
              <td>${data[i].createdDate}</td>
              <td>${data[i].approvedDate}</td>
              <td>${data[i].withdrawalStatus}</td>
					  </tr>`
			table.innerHTML += row
        }
      }
    })
    .catch(function (error) {
      console.log(error);
    });
}

function myFunction(){
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("history");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
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