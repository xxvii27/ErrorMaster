//Javascript Controller

window.onload = function (){

    var all_errors = "<h1 class='page-header'>All Errors</h1>\
                     <div class='dropdown pull-right'> \
                        <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>\
                            Sort By\
                            <span class='caret'></span>\
                        </button>\
                            <ul id='sort' class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>\
                                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Name</a></li>\
                                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Time</a></li>\
                                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Count</a></li>\
                                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Severity</a></li>\
                            </ul>\
                      </div>\
                    <div class='table-responsive'>\
                    <table class='table table-striped'>\
                      <thead>\
                        <tr>\
                           <th>Time</th>\
                           <th>Count</th>\
                           <th>Name</th>\
                           <th>Severity</th>\
                        </tr>\
                      </thead>\
                      <tbody id='responseOutput'>\
                      </tbody>\
                    </table>\
                    </div>";

    var settings = "  <h1 class='page-header'>Configuration</h1> " +
        "  <h4 class='sub-header'>Script</h4>" +
        "  <code>Javascript Code</code>" +
        "  <br/>" +
        "  <br/>" +
        "  <p>Copy paste code above to the respective head tags of the pages, which errors you want to track.</p>";


    var user_management = " <h1 class='page-header'>Users</h1>  " +
        " <div class='btn-group pull-right'>" +
        " <button type= 'button' class='btn btn-default' data-toggle='modal' data-target='#addUserDialog'><span class='glyphicon glyphicon-plus'></span></button>" +
        " </div>" +
        " <div class='dropdown pull-right'> \
          <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>\
              Sort By\
              <span class='caret'></span>\
          </button>\
              <ul id='sort' class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>\
                  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>User</a></li>\
                  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Status</a></li>\
                  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'># of Error Types</a></li>\
                  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Total Errors</a></li>\
              </ul>\
          </div>\
        <div class='table-responsive'>\
            <table class='table table-striped'>\
              <thead>\
                <tr>\
                   <th>User</th>\
                   <th># of Error Types</th>\
                   <th>Total Errors</th>\
                   <th>Status</th>\
                </tr>\
              </thead>\
              <tbody id='responseOutput'>\
              </tbody>\
            </table>\
          </div> ";

    var summary_content = "  <h1 class='page-header'>Summary</h1>\
               <h4 class='sub-header'>Errors so far..</h4>\
                <div class='table-responsive'>\
                    <table class='table table-striped'>\
                      <thead>\
                        <tr>\
                           <th>Time</th>\
                           <th>Count</th>\
                           <th>Name</th>\
                           <th>Severity</th>\
                        </tr>\
                      </thead>\
                      <tbody id='responseOutput'>\
                      </tbody>\
                    </table>\
                    </div> ";



    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page === "dash.php"){
        document.getElementById("dashcontent").innerHTML = summary_content;

        var user = document.getElementById('userid').innerHTML;
        //Performing AJAX Call sending user ID, loading userlist
        var url = "http://104.131.199.129:83/php/load_errors.php"
        var payload = "user=" + encodeValue(user) +"&summary=" +encodeValue("yes");
        sendRequest(url, payload);

    }


    document.getElementById("allerrors").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = all_errors;

        var user = document.getElementById('userid').innerHTML;
        //Performing AJAX Call sending user ID, loading userlist
        var url = "http://104.131.199.129:83/php/load_errors.php"
        var payload = "user=" + encodeValue(user) +"&summary=" +encodeValue("yes");
        sendRequest(url, payload);


    }
    document.getElementById("summary").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = summary_content;


        var user = document.getElementById('userid').innerHTML;
        //Performing AJAX Call sending user ID, loading userlist
        var url = "http://104.131.199.129:83/php/load_errors.php"
        var payload = "user=" + encodeValue(user);
        sendRequest(url, payload);
    }

    var config = document.getElementById("settings");
    if(config !== null){
        config.onclick = function (){
            document.getElementsByClassName("active")[0].removeAttribute("class");
            this.parentNode.setAttribute("class", "active");
            document.getElementById("dashcontent").innerHTML = settings;
        }
    }

    var userlist = document.getElementById("users");
    if(userlist !== null){

        userlist.onclick = function (){

            //Get User ID
            var user = document.getElementById('userid').innerHTML;

            document.getElementsByClassName("active")[0].removeAttribute("class");
            this.parentNode.setAttribute("class", "active");
            document.getElementById("dashcontent").innerHTML = user_management;

            //Performing AJAX Call sending user ID, loading userlist
            var url = "http://104.131.199.129:83/php/users.php"
            var payload = "user=" + encodeValue(user);
            sendRequest(url, payload);

       }
    }



    //Add user button
    document.getElementById("adduser").onclick = function () {

        var first = document.getElementsByName("first")[0].value;
        var last = document.getElementsByName("last")[0].value;
        var email = document.getElementsByName("email")[0].value;
        var password = document.getElementsByName("password")[0].value;
        var user = document.getElementById('userid').innerHTML;


        if(first === "" || last === "" || email === "" || password === "")
           alert("Empty form detected, make sure you enter all information");
        else if( validateEmail(email) === false ){
           alert("Not a valid e-mail address");
        }
        else{

              var url = "http://104.131.199.129:83/php/addmember.php";
              var payload = "firstname=" + encodeValue(first) + "&lastname=" + encodeValue(last) + "&email=" + encodeValue(email) + "&password=" + encodeValue(password) +
                                  "&user=" + encodeValue(user);
              sendRequest(url, payload);

              $('#addUserDialog').modal('hide');

        }


    }

    document.getElementById("changePass").onclick = function () {
        $('#changePassDialog').modal('show');
        $('#changePassSubmit').click(function(){
           var newpass = document.getElementsByName('pass')[0].value;
           if(newpass === "")
                alert("Empty Password");
            else{
               var url = "http://104.131.199.129:83/php/updateCred.php";
               var payload = "password=" + encodeValue(newpass) + "&update=" + encodeValue("pass");
               sendRequestTwo(url, payload);
               $('#changePassDialog').modal('hide');
           }
        });
    }

    var changeCode = document.getElementById("changeCode");
    if(changeCode!==null){
            changeCode.onclick = function () {
                $('#changeCodeDialog').modal('show');
                $('#changeCodeSubmit').click(function(){
                    var newcode = document.getElementsByName('code')[0].value;
                    if(newcode === "")
                        alert("Empty Code");
                    else{
                        var url = "http://104.131.199.129:83/php/updateCred.php";
                        var payload = "code=" + encodeValue(newcode) + "&update=" + encodeValue("code");
                        sendRequestTwo(url, payload);
                        $('#changeCodeDialog').modal('hide');
                    }
                });

            }
    }


            //Delete User Buttons

    $(document).on("click", '.delete', function () {

       var url = "http://104.131.199.129:83/php/deleteuser.php";
       var username = $(this).parent().prev().prev().prev().prop("innerHTML");
       var master = document.getElementById('userid').innerHTML;
       var payload = "username=" + encodeValue(username) + "&master=" + encodeValue(master);
       if( confirm("Are you sure you want to remove this user ? Bug Notice: If not removed, remove again") ) {
           sendRequest(url, payload);
       }

    });

    //Sort  Buttons

     $(document).on("click", '#sort li', function () {

           var url = "http://104.131.199.129:83/php/sort.php";
           var sort_options = $(this).children().prop("innerHTML");
           var payload = "sort=" + encodeValue(sort_options);
           sendRequest(url, payload);
     });

     //Edit Buttons
      $(document).on("click", '.edit', function () {


          var email = $(this).parent().prev().prev().prev().prop("innerHTML");

          $('#editUserDialog').modal('show');
          document.getElementById('email').value = email;

          document.getElementById('edituser').onclick = function(){

                var first = document.getElementsByName("first")[1].value;
                var last = document.getElementsByName("last")[1].value;
                var password = document.getElementsByName("password")[1].value;
                var user = document.getElementById('userid').innerHTML;

                if(first === "" || last === "" || email === "" || password === "")
                   alert("Empty form detected, make sure you enter all information");
                else if( validateEmail(email) === false ){
                   alert("Not a valid e-mail address");
                }
                else{

                      var url = "http://104.131.199.129:83/php/edit.php";
                      var payload = "firstname=" + encodeValue(first) + "&lastname=" + encodeValue(last) + "&email=" + encodeValue(email) + "&password=" + encodeValue(password) +
                                          "&user=" + encodeValue(user);
                      sendRequest(url, payload);

                      $('#editUserDialog').modal('hide');
                      alert("User Edited !!! Bug Notice: If change doesn't take effect, do edit twice consecutively. ");

                }

          }


     });







   /* for(var i = 0; i<delButton.length; i++){
        delButton[i].onclick = function(){
            //var url = "http://104.131.199.129:83/php/deleteuser.php";

            var username = delButton[i].parentNode.previousSibling.previousSibling.previousSibling.innerHTML;

            alert(username);
            //sendRequest(url, payload);

        }
    }*/


function validateEmail(x) {
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        return false;
    }
}

//AjaX Functions Below Courtesy of ajaxref.com

    function createXHR()
    {
        try { return new XMLHttpRequest(); } catch(e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch (e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch (e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
        try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}

        return null;
    }

    function sendRequest(url, payload)
    {
        var xhr = createXHR();
        if (xhr)
        {
            xhr.open("POST",url,true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){handleResponse(xhr);};
            xhr.send(payload);
        }

    }

    function sendRequestTwo(url, payload)
    {
        var xhr = createXHR();
        if (xhr)
        {
            xhr.open("POST",url,true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4  && xhr.status == 200)
                    alert("Credentials Changed")

             };
            xhr.send(payload);
        }

    }

    function handleResponse(xhr)
    {
        if (xhr.readyState == 4  && xhr.status == 200)
        {
            var responseOutput = document.getElementById("responseOutput");
            responseOutput.innerHTML = xhr.responseText;
        }

    }

    function encodeValue(val)
    {
        var encodedVal;
        if (!encodeURIComponent)
        {
            encodedVal = escape(val);
            /* fix the omissions */
            encodedVal = encodedVal.replace(/@/g, '%40');
            encodedVal = encodedVal.replace(/\//g, '%2F');
            encodedVal = encodedVal.replace(/\+/g, '%2B');
        }
        else
        {
            encodedVal = encodeURIComponent(val);
            /* fix the omissions */
            encodedVal = encodedVal.replace(/~/g, '%7E');
            encodedVal = encodedVal.replace(/!/g, '%21');
            encodedVal = encodedVal.replace(/\(/g, '%28');
            encodedVal = encodedVal.replace(/\)/g, '%29');
            encodedVal = encodedVal.replace(/'/g, '%27');
        }
        /* clean up the spaces and return */
        return encodedVal.replace(/\%20/g,'+');
    }





}
