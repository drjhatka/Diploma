$(document).ready(function(){

//initialize ckeditor and laravel file manager
    CKEDITOR.replace('content',{
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    });
    var route_prefix = "/laravel-filemanager";
    $('#lfm').filemanager('image', {prefix: route_prefix});

//change syllabus modules when subject dropdown chnages    
    $('#subject').change(function(){
        $.ajax({
            type: "get",
            url: "/syllabus_modules",
            data: $('#subject').val(),
            //dataType: "dataType",
            success: function (response) {
                var keys = Object.keys(response);
                var values = Object.values(response);
                //console.log(response) 
                var syllabus_module = null;
                for (let [key, value] of Object.entries(response)) {
                    if(key === $('#subject').val()){
                           syllabus_module = value;
                            break;
                        }
                    }
                
               $("#syllabus_module").empty()
                $.each(syllabus_module, function(key,value) {
                    $("#syllabus_module").append($("<option></option>")
                    .attr("value", value).text(value));
                    $("#syllabus_module").trigger('change')
                });
            }
        });
    })
//set default value for syllabus topic
    $.ajax({
        type: "get",
        url: "/syllabus_module_topics/"+$("#subject").val()+"/"+$("#syllabus_module").val(), 
        success: function (response) {
            //console.log(response);
            var keys = Object.keys(response);
            var values = Object.values(response);
            var syllabus_module_topics = response;
            $.each(syllabus_module_topics, function(key,value) {
                $("#syllabus_module_topic").append($("<option></option>")
                .attr("value", key).text(value));
            });
        }
    })

//change syllabus module topics on module change
    $('#syllabus_module').on('change',(function(){
        $.ajax({
            type: "get",
            url: "/syllabus_module_topics/"+$("#subject").val()+"/"+$("#syllabus_module").val(),
            
            success: function (response) {
                var keys = Object.keys(response);
                var values = Object.values(response);
                
                var syllabus_module_topic = response
                $("#syllabus_module_topic").empty()
     
                $.each(syllabus_module_topic, function(key,value) {
                    $("#syllabus_module_topic").append($("<option></option>")
                    .attr("value", key).text(value));
                    
                });
                }
            });
    })).trigger('change')
        

//add resource block on button click
    $("#resource").click(function (e) {
        e.preventDefault()
        //perform error check

        //add element to the original dom
        $("#resource_preview").append(
            '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
        "</button>"+
        "<strong>Resource Type:</strong> <input name='resource_type[]' style='font-weight:bold; color:red; text-align:center' readonly=true value="+$("#resource_type").val()+">"+
        "<strong>Resource Link:</strong> <input name='resource_link[]' style='font-weight:bold; color:red;text-align:center'  readonly=true value='"+$('#resource_link').val()+"'>")+
        "</div>"
        
        
            $('.modal').modal('hide')

            
    })
})