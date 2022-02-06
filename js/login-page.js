// function test(){
//   let mysql = require('mysql');

// // First you need to create a connection to the database
// // Be sure to replace 'user' and 'password' with the correct values
// const con = mysql.createConnection({
//   host: 'localhost',
//   user: 'root',
//   password: 'root',
//   database:'empiregold_uat',
//   port:8889
// });

// con.connect(function(err) {
//   if (err) throw err;
//   //Select all customers and return the result object:
//   con.query("SELECT * FROM USER_TABLE", function (err, result, fields) {
//     if (err) throw err;
//     console.log(result);
//   });
// });
// }  



function home() {
 
  var name = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  localStorage.setItem('password', password)

  if (name == '') {
    {
      alert('message');
      return false;
    }
  }
  fetch('http://18.139.2.253:8080/cardio-0.0.1-SNAPSHOT/enquiry/getUserDetail', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
      userName: name,
      key: password,
    }),
  })
    .then(function (response) {
      // alert('You are logged in');

      return response.json();

      //return response.text;
    })
    .then(function (data) {
      localStorage.setItem('userDetail', JSON.stringify(data));
      if (data.userId == '' || data.userId == null) {
        alert('wrong password / inactive user');
        return false;
      }
      if (data.userType == 'AD') {
        window.location.href = 'admin-homepage.html';
      } else {
        window.location.href = 'homepage.html';
      }
    })
    .catch(function (error) {
      // alert('Invalid Credential')
      console.log(error);
    });
}

// test()