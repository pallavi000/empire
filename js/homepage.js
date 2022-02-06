
    function getdata(){
        let d = localStorage.getItem('userDetail')
        data = JSON.parse(d)
        console.log(data)
        document.getElementById('username').innerHTML = data.userName
        document.getElementById('p-name').innerHTML = data.userName
        document.getElementById('fullName').innerHTML = data.fullName
        document.getElementById('joinedDate').innerHTML = data.joinedDate
        document.getElementById('walletBalance').innerHTML = data.walletDto.walletBalance
        document.getElementById('pinValue').innerHTML = data.walletDto.pinValue
        document.getElementById('bonusSponsor').innerHTML = data.walletDto.bonusSponser
        document.getElementById('bonusKeyIn').innerHTML = data.walletDto.bonusKeyin
        document.getElementById('status').innerHTML = data.userStatus
        document.getElementById('expiredDate').innerHTML = data.expiredDate
      
        link = 'https://empiregold.com/'+data.userName

        ref = document.getElementById('element').innerHTML = link
      if (data.packages==null ){
        document.getElementById('packageName').innerHTML = "NULL"
        document.getElementById('packageValue').innerHTML = "NULL"
        document.getElementById('reinvestDate').innerHTML = "NULL"

      }
      else{

        document.getElementById('packageName').innerHTML = data.packages.packages_NAME
        document.getElementById('packageValue').innerHTML = data.packages.pin_VALUE
        document.getElementById('reinvestDate').innerHTML = "NULL"

      }

        if(data.walletDto.gram==null){
        document.getElementById('goldIngram').innerHTML = 0
        }
        else{
             document.getElementById('goldIngram').innerHTML = data.walletDto.gram
        }
        document.getElementById('goldValue').innerHTML = data.walletDto.goldValue

         
        document.getElementById('sponsorBy').innerHTML = data.sponserBy
        
    }

    function personalTransaction(){
      let d = localStorage.getItem('userDetail')
        data = JSON.parse(d)
        id = data.userId
      fetch("http://localhost:8066/enquiry/getPersonalTrans", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          method: "post",
          body: JSON.stringify({

           userId : id
          })
          
        })
          .then(function (response) {
            return response.json()
          })
          .then(function(data){
             

            console.log(data)
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

    getGold()
    personalTransaction()
    getdata()
