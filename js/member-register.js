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

function packageList() {
  fetch("http://localhost:8066/enquiry/getPackageList", {
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

    
    fetch('http://localhost:8066/enquiry/registerMember', {
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
      window.location.href='homepage.html'
      return response.json()
      
    //return response.text;
    })
    .then(function (data) {
        console.log(data)
    //   alert(data.userName);
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

function checkUsername(){
  var username = document.getElementById("user_name").value;
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


// getdata();
// getGold()
// packageList();
