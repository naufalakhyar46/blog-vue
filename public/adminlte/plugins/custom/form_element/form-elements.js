$(document).ready(function() {
    
    "use strict";
    
    $('.summernote').summernote({
        height: 400,
        fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '72'],
          toolbar: [
            // [groupName, [list of button]]
            ['style', ['style','bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']],
            ['height', ['height']]
          ]
});
   
});