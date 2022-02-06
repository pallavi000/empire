
    function getdata(){
        let d = localStorage.getItem('userDetail')
        data = JSON.parse(d)
       
       var p = data.walletDto.pinValue;
       var pins = document.getElementById('pins')
       pins.value =  p
     
       var n = data.userName
       var name = document.getElementById('user')
       name.value = n

      document.getElementById('username').innerHTML = data.userName
      
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
    getdata()
