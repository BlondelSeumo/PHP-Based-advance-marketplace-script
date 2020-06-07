    $('.WebsiteSettings').on('submit',function(){
        event.preventDefault();
            var formdata = $('.WebsiteSettings').serialize();
            $('#loadingImage').show();
            $.ajax({
            url: baseUrl+'Requirements/websiteSettings_submit',
            data:formdata,
            type: "POST",
            success:function(data){
                if(data.indexOf("Success") > -1){
                    document.getElementById("validationmsg").style.color = "#32CD32";
                    document.getElementById("validationmsg").innerHTML= data;
                    sessionStorage.removeItem('user');
                    //location.reload();
                    window.location.replace(baseUrl+"finish");
                }
                else
                {
                    document.getElementById("validationmsg").style.color = "#B22222";
                    document.getElementById("validationmsg").innerHTML= data;
                }
            },
            complete: function(){
                $('#loadingImage').hide();
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            }); 
    });