
    function getdata(){
      let u = localStorage.getItem('userDetail')
         d = JSON.parse(u)
         n = d.userName
         let e = localStorage.getItem('password')
         p = JSON.parse(e)
         console.log(p)
        fetch('http://18.139.2.253:8066/cardio-0.0.1-SNAPSHOT/enquiry/getUserDetail', {
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
            console.log(data.walletDto.pinValue)
          document.getElementById('pinValue').innerHTML = data.walletDto.pinValue
          document.getElementById('username').innerHTML = data.userName
          document.getElementById('p-name').innerHTML = data.userName
          document.getElementById('fullName').innerHTML = data.fullName
          document.getElementById('joinedDate').innerHTML = data.joinedDate
          document.getElementById('packageName').innerHTML = data.packages.packages_NAME
          document.getElementById('packageValue').innerHTML = data.packages.pin_VALUE
          document.getElementById('status').innerHTML = data.userStatus
          document.getElementById('joinedDate').innerHTML = data.joinedDate
          document.getElementById('pinValue').innerHTML = data.walletDto.pinValue
          document.getElementById('sponsorBy').innerHTML = data.sponserBy
          document.getElementById('refferal').innerHTML = data.userName
         
            
          })
          .catch(function (error) {
            console.log(error);
          });
      }
  
      function getGold(){
          fetch("http://18.139.2.253:8066/cardio-0.0.1-SNAPSHOT/enquiry/getGold", {
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
  
      function updatePrice(){
          price = document.getElementById("gold_price").value
          fetch("http://18.139.2.253:8066/cardio-0.0.1-SNAPSHOT/enquiry/updateGold", {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "post",
      body: JSON.stringify({
  
        goldId: 1 ,
        goldPrice : price
      }),
    })
      .then(function (response) {
        alert('Gold Price Update');
        window.location.href='admin-homepage.html'
        return response.json()
      })
      
      .catch(function (error) {
        // alert('Invalid Credential')
        console.log(error);
      });
      }
      
  
      function reloadPin(){
          let u = localStorage.getItem('userDetail')
          data = JSON.parse(u)
          userId = data.userId
  
         
          pin = document.getElementById("reloadAmount").value
          fetch("http://18.139.2.253:8066/cardio-0.0.1-SNAPSHOT/enquiry/updatePv?userId="+userId+"&amount="+pin, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "get",
      
    })
      .then(function (response) {
        let u = localStorage.getItem('userDetail')
         d = JSON.parse(u)
         n = d.userName
         let e = localStorage.getItem('password')
         p = JSON.parse(e)
         console.log(p)
        fetch('http://18.139.2.253:8066/cardio-0.0.1-SNAPSHOT/enquiry/getUserDetail', {
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
      
            //return response.text;
          })
          .then(function (data) {
            window.location.href ='admin-homepage.html'
            document.getElementById('pinValue').innerHTML = data.walletDto.pinValue
            console.log(data.walletDto.pinValue)
            
          })
          .catch(function (error) {
            console.log(error);
          });
      })
      
      .catch(function (error) {
        // alert('Invalid Credential')
        console.log(error);
      });
      }
  
      // getdata()
      // getGold()
      
  