<?php
    	session_start();
	$t_id=$_SESSION["user_id"];
?>    
<html>  
   <head>  
      <title>RHCMS</title>  
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">        
      <link rel = "stylesheet"  
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">  
      <link rel = "stylesheet"  
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">  
      <script type = "text/javascript"  
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>             
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">  
      </script>   
   </head>  
   <body class = "container"style="">     
      <div class = "row">  
      <br>
      <h5>Public interest feedback</h5>
         <form action="image_upload.php" method="post" enctype="multipart/form-data" style="padding:20px;box-shadow:1px 1px 10px lightgray;">  
            <div class = "row">  
               <div class = "input-field col s12">  
                  <i class = "material-icons prefix">home</i>  
                  <input placeholder = "House No." value = "" id = "name"  
                     type = "text" class = "active validate"  required />  
                  <label for = "name">House 'no.</label>  
               </div>
               <div class = "input-field col s12">  
                  <i class = "material-icons prefix">file</i>  
                 <textarea name="feedback"style="height:200px;"placeholder="Feedback">
                     
                     
                 </textarea> 
                    
               </div>
               
              </div> 
                 <input type="hidden" name="id"id="iis">
          Select file : <input type='file' name='upload_image' id='file' class='form-control' name="image1"><br><br>
          
                 <input type="hidden" name="id"id="iis">
          Select file : <input type='file' name='upload_image' id='file' class='form-control' name="image" name="image2"><br><br>
          
                 <input type="hidden" name="id"id="iis">
          Select file : <input type='file' name='upload_image' id='file' class='form-control' name="image3"><br><br>
          <input type='submit' class='btn btn-info' value='Upload' id='btn_upload' name="feedback">
                 
         </form>         
      </div>  
   </body>     
</html>  