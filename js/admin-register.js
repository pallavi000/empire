function getdata() {
  let gd = localStorage.getItem("userDetail");
  if(gd) {
    userData = JSON.parse(gd);
    console.log(userData);
  
    document.getElementById("p-name").innerHTML = userData.userName;
  
      s = userData.sponserBy;
     b = document.getElementById("sponsorBy");
    b.value = s;
  
    userId = userData.userId;
  }
  
}
function upload(){
  const form = document.getElementById("fileUpload")

fetch("http://18.139.2.253:8080/cardio-0.0.1-SNAPSHOT/enquiry/uploadMember", {
  headers: {
        "Content-Type": "multipart/form-data;boundary=----WebKitFormBoundaryQ0pBuvRC1EzDAQWT",
      },
      method: "POST",
      body: ({
        file:form})
      
    }).then(function (response) {
        return response.json()
      })
     
      .catch(function (error) {
        console.log(error);
      });
  
}

function packageList() {
  fetch("http://18.139.2.253:8080/cardio-0.0.1-SNAPSHOT/enquiry/getPackageList", {
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
      console.log(data);
      var plan = document.getElementById("inputPlan");

      let defaultOption = document.createElement("option");
      defaultOption.text = "Choose Plan";

      plan.add(defaultOption);

      //Add the Options to the DropDownList.
      for (var i = 0; i < data.length; i++) {
        var planList = document.createElement("OPTION");
        planList.text = "Choose Plan";

        planList.innerHTML = data[i].packages_NAME;

        //Add the Option element to DropDownList.
        plan.add(planList);
      }

      $("#inputPlan").on("change", function () {
        var selectIndex = this.selectedIndex;
       
        selectPlan = data[selectIndex-1].packages_ID;
        console.log(selectPlan);

        pin_value = data[selectIndex-1].pin_VALUE;
        console.log(pin_value);

        var p = pin_value;
        var i = document.getElementById("pins");
        i.value = p;

        localStorage.setItem("packageID",selectPlan);

      });
    })
    .catch(function (error) {
      console.log(error);
    });
}

function register(){

    var packageID = localStorage.getItem("packageID");
    username = document.getElementById("username").value
    password = document.getElementById("password").value
    national_id = document.getElementById("nationalID").value
    fullname = document.getElementById("fullName").value
    email = document.getElementById("email").value
    address = document.getElementById("address").value
    city = document.getElementById("city").value
    state = document.getElementById("state").value
    country = document.getElementById("inputCountry").value
    postcode = document.getElementById("postcode").value
    phone = document.getElementById("phone").value
    sponsor = document.getElementById("sponsorBy").value
    secretkey = document.getElementById("secretkey").value
    joindate = document.getElementById("joinDate").value
    
    fetch('http://18.139.2.253:8080/cardio-0.0.1-SNAPSHOT/enquiry/registerMember', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({

    userName: username,
    password: password,
    email: email,
    fullName: fullname,
    telNo: phone,
    sponserBy: sponsor,
    packageId: packageID,
    addressNo:address,
    city: city,
    state: state,
    postcode : postcode,
    country : country,
    secretKey: secretkey,
    joinedDate: joindate
    }),
  })
    .then(function (response) {
      alert('Successfully registered');
      window.location.href='admin-homepage.html'
      return response.json()
      
    //return response.text;
    })
    .then(function (data) {
        console.log(data)
       
    })
    .catch(function (error) {
        // alert('Invalid Credential')
      console.log(error);
    });
    

}

function searchRegister(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchHistory");
  filter = input.value.toUpperCase();
  table = document.getElementById("pinHistory");
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

  function checkUsername(){
    var username = document.getElementById("username2").value;
    var messages = document.getElementById("checkingUsername");

    if(username.trim().length==0) {
      return false;
    }
  
    axios.post('./checkusername.php', {'username': username}).then(res=>{
      console.log(res.data)
      if(res.data.error) {
        messages.style.color = "red";
        messages.innerHTML = "Username already exist";
      } else {
        messages.style.color = "green";
        messages.innerHTML = "Username is available";
      }
    }).catch(err=>{
        console.log(err.request.response)
    })
    
  //   fetch("http://18.139.2.253:8080/cardio-0.0.1-SNAPSHOT/enquiry/checkExistingUserName?userName="+username, {
  // headers: {
  //       "Content-Type": "multipart/form-data;boundary=----WebKitFormBoundaryQ0pBuvRC1EzDAQWT",
  //     },
  //     method: "get"
  //   }).then(function (response) {
  //       return response.json()
  //     })
  //     .then(function (data) {
  //       console.log(data)
  //       if(data.error=='user exist'){
  //         messages.style.color = "red";
  //         messages.innerHTML = "Username already exist";
  //       }
  //       else{
  //         messages.style.color = "green";
  //         messages.innerHTML = "Username is available";
  //       }
  //     })
  //    .catch(function (error) {
  //       console.log(error);
  //     });

  }

  function checkPassword(){
    document.getElementById("message").style.display = "block";
    password = document.getElementById("password")
    letter = document.getElementById("letter");
    capital = document.getElementById("capital");
    number = document.getElementById("number");
    length = document.getElementById("length");


// When the user clicks outside of the password field, hide the message box
password.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
password.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(password.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(password.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(password.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(password.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
  }

  function showPassword(){
    var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  }


  $("#inputPlan").on("change", function () {
    const selectPlan = $(this).value
    const pin_value = $(this).find(':selected').attr('pinvalue')
    var p = pin_value;
    var i = document.getElementById("pins");
    i.value = p;
    localStorage.setItem("packageID",selectPlan);
});


getdata();
packageList();
