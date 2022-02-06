
    function getdata(){
        let d = localStorage.getItem('userDetail')
        data = JSON.parse(d)
        console.log(data)

        var full = data.fullName
        var fn = document.getElementById("fullName")
        fn.value = full

      
        
        var sponsor = data.sponserBy
        var by = document.getElementById("sponsorBy")
        by.value = sponsor;

        document.getElementById("profileName").innerHTML = data.userName
        document.getElementById("fullname").innerHTML = data.fullName
        document.getElementById("p-name").innerHTML = data.userName
       

     

        userId = data.userId
     
    }

    getdata()


    function bankDetailUpdate(){

        let g = localStorage.getItem('userDetail')
        retrieveData = JSON.parse(g)
        
        getUserId = retrieveData.userId

        namaBank = document.getElementById('namaBank').value
        accNumber = document.getElementById('accNumber').value

        fetch('http://localhost:8066/enquiry/updateBankDetail', {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    method: 'post',
    body: JSON.stringify({
        

            userId : getUserId ,
            bankName : namaBank,
            bankAccNum : accNumber
        
    }),
  })
    .then(function (response) {
      let d = localStorage.getItem('userDetail')
      k = JSON.parse(d)
      if(k.userType == 'AD'){
        window.location.href='bank-details.html'
      }
      else{

      }
      alert('Updated Bank Detail!');

      
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
    

 