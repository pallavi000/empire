function registerGuest(){
    alert('masuk')
   sponsorby = document.getElementById("sponsorBy").value
   FullName = document.getElementById("FullName").value
   Email = document.getElementById("Email").value
   mobilePhone = document.getElementById("mobilePhone").value
   userName = document.getElementById("userName").value
   password = document.getElementById("password").value

   fetch('http://localhost:8066/enquiry/registerGuest', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
      userName: userName,
      password: password,
      email: Email,
      telNo : mobilePhone,
      sponserBy : sponsorby,
      fullName : FullName
    }),
  })
    .then(function (response) {
      alert('Registered');
    //   window.location.href='homepage.html'
      return response.json()
      
    //return response.text;
    })
    .then(function (data) {
        // localStorage.setItem('userDetail', JSON.stringify(data));
        console.log(data)
    //   alert(data.userName);
    })
    .catch(function (error) {
        // alert('Invalid Credential')
      console.log(error);
    });


}