<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Load More in Laravel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
   .wrapper > ul#results li {
     margin-bottom: 2px;
     background: #e2e2e2;
     padding: 20px;
     width: 97%;
     list-style: none;
   }
   .ajax-loading{
     text-align: center;
   }

  .result {
    background-color: #1fc8db;
    
    width: 100%;
    padding: 1em;
    margin: 0.5em;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 9px;
    border: solid 2px honeydew;
  }
</style>


</head>
  
<body>
  
  <div class="container">
    <div class="wrapper">
      <ul id="results"><!-- results appear here --></ul>
        <div class="ajax-loading">
          <!-- <img src="{{ asset('images/loading.gif') }}" /> -->
        </div>
    </div>
  </div>
</body>
<script>
  var SITEURL = "{{ url('/') }}";
  var page = 1;  
  load_more(page);  
 
  $(window).scroll(function() {  
    if($(window).scrollTop() + $(window).height() >= $(document).height()){  
      page++; //page number increment
      load_more(page); //load content   
    }
  });


  function load_more(page){
    $.ajax({
      url: "posts?page=" + page,
      type: "get",
      datatype: "html",
      beforeSend: function(){
        $('.ajax-loading').show();
      }
    })
    .done(function(data){
      if(data.length == 0){
        console.log(data.length);
        $('.ajax-loading').html("No more  !");
           return;
        }
        $('.ajax-loading').hide(); //hide loading animation once data is received
        $("#results").append(data); //append data into #results element          
        console.log('data.length');
    })
    .fail(function(jqXHR, ajaxOptions, thrownError){
          alert('No response from server');
    });
  }
</script>
</html>