-<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<style>.form-container{
    background-color: rgba(255,255,255,0.9);
    font-family: 'Titillium Web', sans-serif;
    padding: 25px 30px 30px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}
.form-container .title{
    color: #333;
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 0 25px;
}
.form-container .title:after{
    content: '';
    background-color: #0cd674;
    height: 2px;
    width: 150px;
    margin: 5px auto 0;
    clear: both;
    display: block;
}
.form-container .form-horizontal{
    margin: 0 0 20px;
    font-size: 0;
}
.form-container .form-horizontal .sub-title{
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    margin: 0 0 15px;
    padding: 17px 0 0;
    border-top: 1px solid #d1d1d1;
}
.form-horizontal .form-group{
    width: calc(50% - 10px);
    margin: 0 10px 15px 0;
    display: inline-block;
}
.form-horizontal .form-group:nth-child(even){ margin: 0 0 10px 10px; }
.form-horizontal .form-group:nth-child(3),
.form-horizontal .form-group:nth-child(4){
    margin-bottom: 25px;
}
.form-horizontal .form-group.phone-no{ margin: 0 10px 20px 0; }
.form-horizontal .form-group.age{ margin: 0 0 20px 10px; }
.form-horizontal .form-group label{
    color: #999;
    font-size: 13px;
    font-weight: 500;
    font-style: italic;
    margin: 0 0 3px;
}
.form-horizontal .form-control{
    color: #555;
    background-color: transparent;
    font-size: 14px;
    letter-spacing: 1px;
    height: 33px;
    padding: 5px;
    box-shadow: none;
    border: 1px solid #d1d1d1;
    border-radius: 0;
    display: inline-block;
    transition: all 0.3s;
}
.form-horizontal .form-control:focus{
    box-shadow: none;
    border: 1px solid #0cd674;
}
.form-horizontal .btn{
    color: #fff;
    background: #0cd674;
    font-size: 17px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 7px 20px 7px;
    margin: 0 auto 20px;
    border: none;
    border-radius: 0;
    display: block;
    transition: all 0.3s ease;
}
.form-horizontal .btn:hover,
.form-horizontal .btn:focus{
    color: #fff;
    background-color: #0cd674;
    box-shadow: 0 0 10px rgba(0,0,0,0.3),0 0 10px rgba(0,0,0,0.3) inset;
    outline: none;
}
.form-horizontal .user-login{
    color: #333;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    display: block;
}
.form-horizontal .user-login a{
    color: #0cd674;
    transition: all 0.3s ease 0s;
}
.form-horizontal .user-login a:hover{ color: #555; }
.form-container .social-links{
    font-size: 14px;
    text-align: center;
}
.form-container .social-links span{
    font-style: italic;
    margin: 0 0 20px;
    display: block;
    position: relative;
}
.form-container .social-links span:before,
.form-container .social-links span:after{
    content: '';
    background-color: #999;
    height: 1px;
    width: 25%;
    position: absolute;
    top: 50%;
    left: 0;
}
.form-container .social-links span:after{
    left: auto;
    right: 0;
}
.form-container .social-links a{
    color: #fff;
    background-color: #20599F;
    display: inline-block;
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    width: 120px;
    padding: 7px 15px;
    margin: 0 5px;
    transition: all 0.3s ease 0s;
}
.form-container .social-links a i{
    font-size: 13px;
    margin-right: 3px;
}
.form-container .social-links a:nth-child(2){ background-color: #00ADF2; }
.form-container .social-links a:hover{
    text-shadow: 0 0 10px rgba(0,0,0,0.4);
    box-shadow: 0 0 10px rgba(0,0,0,0.4);
}
@media only screen and (max-width:576px){
    .form-container .form-group,
    .form-container .form-group:nth-child(even),
    .form-container .form-group.phone-no,
    .form-container .form-group.age{
        width: 100%;
        margin: 0 0 25px;
    }
}
@media only screen and (max-width:479px){
    .form-container .social-links a{
        width: 80%;
        margin: 0 auto;
        display: block;
    }
    .form-container .social-links a:nth-child(even){ margin: 0 auto 10px; }
}</style>

  <body>





  <div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
                <div class="form-container">
                    <h3 class="title">User Registration</h3>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label>User Name</label>
                            <input class="form-control" name= "name"type="text">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email">
                        </div>
                        <div class="form-group">
                            <label>Password*</label>
                            <input class="form-control" type="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password*</label>
                            <input class="form-control" type="password">
                        </div>
                        <div class="form-group phone-no">
    <label for="country">Country</label>
    <select class="form-control" id="country" onchange="updateCities()">
        <option value="">Select Country</option>
        <option value="pakistan">Australia</option>
        <option value="usa">India</option>
        <option value="canada">UK</option>
        <option value="canada">UAE</option>
        <option value="canada">Indonsia</option>
        <option value="canada">South Africa</option>

        <!-- Add more countries here -->
    </select>
</div>

<div class="form-group age">
    <label for="city">City</label>
    <select class="form-control" id="city">
        <option value="">Select City</option>
        <!-- City options will be populated based on the selected country -->
    </select>
</div>
                        <button class="btn signin">Booking</button>
                        
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>




    <script>
    function updateCities() {
        // Get the selected country
        var country = document.getElementById('country').value;

        // Define city options for each country
        var citiesByCountry = {
            Australia: ['Adelaide', 'Brisbane', 'Canberra', 'Darwin', 'Gold Coast', 'Hobart', 'Melbourne', 'Newcastle', 'Perth'],
            India: ['Ahmedabad', 'Bangloru', 'Channai','Dehli','Hyderabad','Jaipur','Kolkata','Mumbai','Puna' ],
            UK: ['Bristol', 'Cardiff', 'Edingburg','liverpool', 'london','manchester','newcastle',],
            USA: ['boston','chicago','houtan','Las vegas','Los angeles','Miami','New york','San franciso', 'Washington'],
            Indonsia: ['Bali', 'Bandung', 'Batam', 'Makassar', 'Medan', 'Palembang', 'Semarang', 'Surabaya', 'Yogyakarta'],
            South Africa: ['Bloemfontein', 'Cape Town', 'Durban', 'East London', 'Johannesburg', 'Kimberley', 'Polokwane', 'Port Elizabeth', 'Pretoria']
        };

        // Get the city dropdown
        var citySelect = document.getElementById('city');

        // Clear any existing options
        citySelect.innerHTML = '<option value="">Select City</option>';

        // Check if the selected country has cities
        if (country && citiesByCountry[country]) {
            // Populate the city dropdown based on the selected country
            citiesByCountry[country].forEach(function(city) {
                var option = document.createElement('option');
                option.value = city.toLowerCase();
                option.text = city;
                citySelect.appendChild(option);
            });
        }
    }
</script>

</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>