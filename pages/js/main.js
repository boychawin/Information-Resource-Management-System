jQuery(document).ready(function(){

       
    var heading = $("h1").text();

    var title = $('title');

    var meta = $('#meta-info').text();

    title.text(heading)

 $("#confirm-delete").on('click',function(){
       $("#hide").removeClass("hide");
   }) 
   
   $(".reject-btn").click(function(){
       var id = this.id;
     
       var reason = $("#reason-reject");
       reason.attr('id', "#reason-reject-" + id);
                  
       reason.toggleClass("hide").fadeIn();
       
       $("#booking_id").val(id);
       
   })
   
    $('delete-account').submit(function(){

       if(window.prompt("Are you sure you want to do this?")){
           $.ajax({
               
           })
       }
    });

    var pass = $("#password");

    pass.on("change", function(){
        if($(this).val() < 10000000){
            $(".error-line1").text("รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร");
        }else if($(this).val() === ''){
            $(".error-line1").text("ต้องป้อนรหัสผ่าน");
        }else{
               $(".error-line1").addClass("hide");
        }
    });

    $("#conf-pass").on("change", function(){

        if($(this).val() !== pass.val()){

            $(".error-line2").text("รหัสผ่านไม่ตรงกัน");
        }else if($(this).val() === ''){
            $(".error-line2").text("ยืนยันรหัสผ่านของคุณ");
        }else{
            $(".error-line2").addClass("hide");
        }
    });
        
   $('#start').on('change',function(){
       
        var start = $('#start').val();
        
        var day = start.split('-').join('');
        
        var type_num = $("#numdays").val();
        
        var num = parseInt(type_num);
        
        var end = $("#end").val();
        
        var day2 = end.split('-').join('');
        
        var dif = parseInt(day2) - parseInt(day)

        if(dif > num){
            day += num;
            var re = '/[4]+[2]+[2]/';
            
            day = day.split(re);
            
            $("#end").val()
           $('#error').html("Error! day1: "+day+"<br>Day2: "+day2+"<br>Difference: "+diff);
       }
       
    });
    
    var id =  $("#select-user").val();
    
    $("#select-user").on('change', function(){
        
        var id = $(this).val();

        $('#staff_id').val(id);        
    })
    
    $('#staff_id').val(id)
    
    $("#booking-type").on('change',function(){
        
        var val = $(this).val();
        if(val !== ''){
            $('#booking_id').val(val);
        }
        
        var type = document.getElementById('booking_type');
        
        
        $('#numdays').val(type.label);
       
    })
    
    $("#select-user").on("change",function(){
        var labl = document.getElementById("lft").label;
        $("#level").val(labl);
    })
    
    $("#btn-toggle").click(function(){
         $(this).fadeOut('fast',function(){
             $("#add").fadeIn("slow");
         });
        
    })
    
})