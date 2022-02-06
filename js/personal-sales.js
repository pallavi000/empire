function getdata() {
  let d = localStorage.getItem("userDetail");
  user = JSON.parse(d);
  var id = user.userId;
  document.getElementById("username").innerHTML = user.userName
  document.getElementById("walletBalance").innerHTML = user.walletDto.walletBalance
  fetch("http://localhost:8066/enquiry/getPersonalTrans", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "post",
    body: JSON.stringify({
      userId : id ,
     
    }),
  })
    .then(function (response) {
      return response.json();

      //return response.text;
    })
    .then(function (data) {
        var table = document.getElementById('personalList')
        for (var i = 0; i < data.length; i++){
			var row = `<tr>
							<td>${i+1}</td>
              <td>${data[i].details}</td>
              <td>${data[i].amount}</td>
					    <td>${data[i].balance}</td>
              <td>${data[i].createdDate}</td>
					  </tr>`
			table.innerHTML += row
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



getdata();
getGold()
