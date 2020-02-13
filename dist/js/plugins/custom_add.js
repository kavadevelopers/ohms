	function readURL(input) {
        if (input.files && input.files[0]) {
            
            var FileSize = input.files[0].size / 1024 / 1024; // in MB
            var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
            
            if (FileSize > 2) {
                alert("Maxiumum Image Size Is 1 Mb.");
                input.value = '';
                return false;
            }
            else{
                if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $("#imgProfile").attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    alert("Only Allowed '.jpg' OR '.png' OR '.jpeg' Extension ");
                    input.value = '';
                    return false;
                }
            }
        }
    }

    function img_return(input,id) {

        var FileSize = input.files[0].size / 1024 / 1024; // in MB
            var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
            
            if (FileSize > 2) {
                alert("Maxiumum Image Size Is 1 Mb.");
                input.value = '';
                return false;
            }
            else{
                if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imgProfile1'+id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input .files[0]);
                    }
                }
                else
                {
                    alert("Only Allowed '.jpg' OR '.png' OR '.jpeg' Extension ");
                    input.value = '';
                    return false;
                }
            }
    }

    function img_return_seller(input,id) {
        var FileSize = input.files[0].size / 1024 / 1024; // in MB
            var extension = input.files[0].name.substring(input.files[0].name.lastIndexOf('.')+1);
            
            if (FileSize > 2) {
                alert("Maxiumum Image Size Is 1 Mb.");
                input.value = '';
                return false;
            }
            else{
                if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
                	if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imgProfile2'+id).attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input .files[0]);
                    }
                 }
                else
                {
                    alert("Only Allowed '.jpg' OR '.png' OR '.jpeg' Extension ");
                    input.value = '';
                    return false;
                }
            }

    }