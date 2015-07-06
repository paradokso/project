$(document).ready(function() {
	Dropzone.autoDiscover = false;

	var myDropzone = new Dropzone("div.box-file", { 
		url: ".",
		clickable:'#dropzonePreview',
		addRemoveLinks: true,
		dictCancelUpload: "Удалить файл",
		dictCancelUploadConfirmation: "Вы действительно желаете удалить файл?",
		dictRemoveFile: "Удалить",
		dictInvalidFileType: "Вы не можете загружать файлы этого типа",
		acceptedFiles: '.jpg, .jpeg, .pdf, .xls, .doc',
		maxFiles: '1', 
		dictMaxFilesExceeded: "Вы можете загрузить только 1 файл",
		init: function() {
	   	 	this.on("addedfile", function(file) { $("#open, .note_long").hide(); });
		}
	});

	//disable button until file is fully loaded
	$("#submit").addClass("unactive");

	myDropzone.on('success', function () {
       	    $("#submit").removeClass("unactive");
    	});

	myDropzone.on('removedfile', function () {
       	   $("#submit").addClass("unactive");
    	});
	

    // prohibit uploading of the file with wrong file-type
	myDropzone.on('error', function () {
       	   $("#submit").addClass("unactive");
    	});
    
	 
	//prohibit adding more than one file
	$('#form').on("mouseover click", function(){
		if ($(this).find('.dz-preview').size()==1){
			$("#file").prop('required', false);
			$(this).find(".box-file").addClass('no-mouse-events');
		} else if ($(this).find('.dz-preview').size()>1) {
			$(this).find(".box-file").removeClass('no-mouse-events');
		} else{
			$(this).find(".box-file").removeClass('no-mouse-events');
			$("#open, .note_long").fadeIn();
			$("#file").prop('required', true)
		}
	})



	// Smooth scroll
	var scroll = function() {
	    $('a[href*=#]:not([href=#])').click(function() {
	        if (location.pathname.replace(/^\//, '') ==
	            this.pathname.replace(/^\//, '') &&
	            location.hostname == this.hostname) {
	            var target = $(this.hash);
	            target = target.length ? target : $(
	                '[name=' + this.hash.slice(1) + ']'
	            );
	            if (target.length) {
	                var position = target.offset().top;
	                $('html,body').animate({
	                    scrollTop: position
	                }, 1000);
	                return false;
	            }
	        }
	    });
	};

	scroll();
	 
    // allow use only system keys and digits
	$(".Input").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, +C, +V, +X and alternatives with Command
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode == 67 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode == 86 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
            (e.keyCode == 88 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

	// limit numbers of digits written in inputs
	$(".Input").on('keyup keydown', function (e) {
		var curLen = $(this).val().length+1;
		var normLen = $(this).data('len');

		if (curLen-1>normLen){
			var curInput = $(this).val();
			var newInput = curInput.slice(0,curInput.length-1)
			$(this).val(newInput)
			return false;
		}
	});

	// Disable KPP when INN has 12 symb
    $("#INN").on("keyup keydown blur focus", function(){
    	if ($("#INN").val().length==10){
	    	$("#KPP").prop('required', true).attr('pattern', '[0-9]{9}');
	    } else {
		$("#KPP").prop('required', false).removeAttr('pattern');
	    }
    })

    // AJAX form sending
 
    $('#form').submit(function(event) {  
	    var form = $(this);
	    var link = '../../setter.php'; 
		$('.meter').fadeIn();
	    $.ajax({
	      type: form.attr('method'),
	      url: link,
	      data: form.serialize(),
	      success: function(response) {
	    }
	    }).done(function(response) {
	        myDropzone.removeAllFiles(true); // clear load zone
			$("#open, .note_long").fadeIn();
			$("#response_18").empty().siblings('p').remove();

			//parse the output of PHP-script
			response =response.replace(/(\r\n|\n|\r)/gm," ");
			var array = [];
			var str="";
			var separator = ">>>>";
			var separatorIndexes = sepIndexes(response, separator); 
			var len = separatorIndexes.length;
			
			for (var i=0;i<len; i++){
				var j = separatorIndexes[i+1];
				//from 1 symbol after separator to next separator
				str = response.slice(separatorIndexes[i]+separator.length,j); 	
				array.push(str);
			}
 
			//inform about error
			if (array[0] =="Incorrect number of arguments " || array.length == 0){
				alert ("Кажется, вы пытались загрузить неправильный тип файла. \nИзмените входные данные и попытайтесь еще раз");
				$('.meter').fadeOut();
				$('.payment').fadeOut();
				return false;
			};
			//insert output in the tags
			if (array.length<=18){
				for (var i=0; i < array.length; i++){
					$("#response_"+i).text(array[i]);
				}
			}
			if (array.length>18){
				for (var i=0; i < 19; i++){
					$("#response_"+i).text(array[i]);
				}
				for (var i = 19; i <  array.length; i++){
					var nod = array[i];
		 			$( "<p>"+nod+"</p>" ).appendTo( ".warnings" );	
				}
			}
			$(".download").find($('a')).attr('href',array[17]);
		      	$('.payment').fadeIn();
			$(window).delay(100).scrollTop($('#payment').offset().top);
		      $('.meter').fadeOut();
	    }).fail(function() {
	      alert('Что-то пошло не так... Попробуйте еще раз');
	    });
	    event.preventDefault(); // Prevent the form from submitting via the browser.
  });
 
	/*get position of separator
	* last element in array is ==-1, that is why we get rid of it
	*	
	*/
	function sepIndexes(response, separator){
		var answer = [];
		for (var i=0; i<response.length; i++){
			var index = response.indexOf(separator, i);
			if (answer.indexOf(index)==-1 && index!==-1 ){
				answer.push(index)
			}
		}
		return answer;
	}
});
 
 
