
let token = document.head.querySelector('meta[name="csrf-token"]').content;

function activeUser(userId,route,isActive) {
   $.ajax({
     url: route,
     method: "PUT",
     dataType:"json",
     data:{_token:token},
     success:function(data){
        console.log(data);
       if (data['value'] == 1) {
         $('.admin-active'+userId).parent('td').html(`<span class='badge badge-success'>${isActive}</span>`);
          new Noty({
                text: data['msg'],
                type: 'success',
                timeout: 6000,
            }).show();
       }else if(data['value'] == 0){
            new Noty({
                text: data['msg'],
                type: 'warning',
                timeout: 6000,
            }).show();
        }
     }
   });
}