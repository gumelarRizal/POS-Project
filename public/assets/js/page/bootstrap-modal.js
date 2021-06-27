"use strict";

$("#modal-1").fireModal({
    body: 'Modal body text goes here.'
});
$("#modal-2").fireModal({
    body: 'Modal body text goes here.',
    center: true
});

let modal_3_body = '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += '[\n';
modal_3_body += ' {\n';
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n"
modal_3_body += "   }\n"
modal_3_body += ' }\n';
modal_3_body += ']';
modal_3_body += '</code></pre>';
$("#modal-3").fireModal({
    title: 'Modal with Buttons',
    body: modal_3_body,
    buttons: [{
        text: 'Click, me!',
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {
            alert('Hello, you clicked me!');
        }
    }]
});

$("#modal-4").fireModal({
    footerClass: 'bg-whitesmoke',
    buttons: [{
        text: 'No Action!',
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$("#modal-5").fireModal({
    title: 'Add',
    body: $("#modal-create-part"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    onFormSubmit: function (modal, e, form) {
        // Form Data
        let form_data = $(e.target).serialize();
        console.log(form_data)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DO AJAX HERE
        // $.ajax({
        //     type:"POST",
        //     url:"{{ url('/Menu')}}",
        //     data : form_data,
        //     success:function(data){
            //     }
            // })
            let fake_ajax = setTimeout(function () {
                        form.stopProgress();
                        modal.find('.modal-body').prepend('<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Data berhasil di simpan.</div></div>')
                
                    clearInterval(fake_ajax);
                }, 1000);
                
                e.preventDefault();
    },
    shown: function (modal, form) {
        console.log(form)
    },
    buttons: [{
        text: 'Save',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$("#modal-6").fireModal({
    body: '<p>Now you can see something on the left side of the footer.</p>',
    created: function (modal) {
        modal.find('.modal-footer').prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
    },
    buttons: [{
        text: 'No Action',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function (modal) {}
    }]
});

$('.oh-my-modal').fireModal({
    title: 'My Modal',
    body: 'This is cool plugin!'
});
