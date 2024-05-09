<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>masdon</title>
    <!-- Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Syncopate:wght@700&display=swap" rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css"
rel="stylesheet"
/>



    <style>
      #loading {
          display: flex;
          position: fixed;
          z-index: 100;
          width: 100%;
          height: 100%;
        }
        body{
            background-color: rgb(243, 201, 243);
        }
        .bg-image-vertical , section{
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
        }

        @media (min-width: 1025px) {
        .h-custom-2 {
        height: 100%;
        }
        }
        @media (max-width: 500px) {
        .logos {
        margin-left: 20px;
        }
        }
     
        
        #form2Example18, #form2Example28{
            background-color: #fff
        }
        .logo-name{
            font-family: 'Silkscreen', cursive;
font-family: 'Syncopate', sans-serif;
        }


    </style>
</head>
<body class="">
    <section class="vh-100 page " style="margin-bottom: -1000px;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 text-black">
      
              <div class="px-5 ms-xl-4 d-flex align-items-center logos" style="margin-top: 100px">
                <i><img src="{{ asset('assets/img/logo-pdgi.png') }}" class="me-2" width="80px" alt=""></i>
                <span class="h1 fw-bold mb-0 logo-name" style="margin-right: 200px;">masdon</span>
              </div>
      
              <div class="d-flex align-items-center  h-custom-2 px-5 ms-xl-4 pt-5 pt-xl-0 " style="margin-top: -150px;">
      
                <form style="width: 23rem;" class="" action="{{ route('login') }}" method="post">
                    @csrf
                  <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
      
                  <div class="form-outline  mb-4" >
                    <input type="email" style="" id="form2Example18" name="email"  class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example18">Email address</label>
                  </div>
      
                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example28" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example28">Password</label>
                  </div>
      
                  <div class="pt-1 mb-4">
                    <button class="btn btn-secondary btn-lg btn-block"  type="submit">Login</button>
                  </div>
      

                      
                </form>
      
              </div>
      
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
              <img src="{{ asset('assets/img/masdon.jpg') }}"
                alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
          </div>
        </div>
        
        <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
        ></script>
        
      </section>
      {{-- LOADING  --}}
      <center>
      <div id="loading" class=""  >
        <div class="spinner-border" style="width: 5rem; height: 5rem; margin-top: 300px;" role="status">
          
        </div>
      </div>
      <center>

      {{-- end loading --}}
      <script type="text/javascript">
        const wait = (delay = 0) =>
          new Promise(resolve => setTimeout(resolve, delay));

        const setVisible = (elementOrSelector, visible) => 
          (typeof elementOrSelector === 'string'
            ? document.querySelector(elementOrSelector)
            : elementOrSelector
          ).style.display = visible ? 'block' : 'none';

          
        setVisible('.page', false);
        setVisible('#loading', true);
      
        document.addEventListener('DOMContentLoaded', () =>
          wait(1000).then(() => {
            
            setVisible('.page', true);
            setVisible('#loading', false);
      
          }));
      </script>
</body>
</html>