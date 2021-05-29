<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>employee</title>
</head>
<body>

    <input type="text" id="search">
    <input type="button" value="Search" id="btn_search">
    <br>
    <input type="button" value="Fetch All Records" id="btn_fetchall">
    <br>
    {{ $employee[2]->User }}

    <table id="userTable" style="border-collapse: collapse;" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>username</th>
                <th>name</th>
                <th>email</th>
            </tr>
        </thead>
        <tbody>

        </tbody>


    </table>




    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function(){


            $('#btn_fetchall').click(function(){
	        fetchRecords(0);
             });

             $('#btn_search').click(function(){
          var userid = Number($('#search').val().trim());

	  if(userid > 0){
	    fetchRecords(userid);
	  }

       });

        });

        function fetchRecords(id){
       $.ajax({
         url: 'getUsers/'+id,
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#userTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var username = response['data'][i].username;
                 var name = response['data'][i].name;
                 var email = response['data'][i].email;

                 var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + username + "</td>" +
                   "<td align='center'>" + name + "</td>" +
                   "<td align='center'>" + email + "</td>" +
                 "</tr>";

                 $("#userTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#userTable tbody").append(tr_str);
           }

         }
       });
     }
    </script>

</body>
</html>
