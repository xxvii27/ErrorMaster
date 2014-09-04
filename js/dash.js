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
                            </ul>\
                      </div>\
                    <div class='table-responsive'>\
                    <table class='table table-striped'>\
                      <thead>\
                        <tr>\
                           <th>Time</th>\
                           <th>Name</th>\
                        </tr>\
                      </thead>\
                      <tbody id='responseOutput'>\
                      </tbody>\
                    </table>\
                    </div>";

    var settings = "  <h1 class='page-header'>Configuration</h1> " +
        "  <h4 class='sub-header'>Script</h4>" +
        "  <a href='https://gist.github.com/xxvii27/672c6a47160fe223a929/download'>Download Script</a>" +
        "  <br/>" +
        "  <br/>" +
        "  <p>Copy paste downloaded script to the respective head tags of the pages, which errors you want to track. " +
        "     Don't forget to insert your username/email in the script, where 'Insert username/email' indicated</p>";


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

    var access_log = "<h1 class='page-header'>Access Log</h1>" +
        "<div class='dropdown pull-right'>\
            <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>\
                Sort By\
                <span class='caret'></span>\
            </button>\
            <ul id='sort' class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>\
                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>User</a></li>\
                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Access Type</a></li>\
                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Timestamp</a></li>\
            </ul>\
        </div>\
        <div class='table-responsive'>\
            <table class='table table-striped'>\
                <thead>\
                <tr>\
                    <th>User</th>\
                    <th>Access Type</th>\
                    <th>Timestamp</th>\
                </tr>\
                </thead>\
                <tbody id='responseOutput'>\
                </tbody>\
            </table>\
        </div>";


    var summary_content = "  <h1 class='page-header'>Summary</h1>\
               <h4 class='sub-header'>Errors so far..</h4>\
                <div class='table-responsive'>\
                    <table class='table table-striped'>\
                      <thead>\
                        <tr>\
                           <th>Time</th>\
                           <th>Name</th>\
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
        var payload = "user=" + encodeValue(user);
        sendRequest(url, payload);


    }
    document.getElementById("summary").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = summary_content;


        var user = document.getElementById('userid').innerHTML;
        //Performing AJAX Call sending user ID, loading userlist
        var url = "http://104.131.199.129:83/php/load_errors.php"
        var payload = "user=" + encodeValue(user) +"&summary=" +encodeValue("yes");
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

    var accesslog = document.getElementById("accesslog");
    if(accesslog!==null){
        accesslog.onclick = function (){
            document.getElementsByClassName("active")[0].removeAttribute("class");
            this.parentNode.setAttribute("class", "active");
            document.getElementById("dashcontent").innerHTML = access_log;

            var user = document.getElementById('userid').innerHTML;
            //Performing AJAX Call sending user ID, loading userlist
            var url = "http://104.131.199.129:83/php/load_accesslog.php"
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
        var username = $(this).parent().prev().prev().prev().prop("innerText");
        var master = document.getElementById('userid').innerText;
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


        var email = $(this).parent().prev().prev().prev().prop("innerText");

        $('#editUserDialog').modal('show');
        document.getElementById('email').value = email;

        document.getElementById('edituser').onclick = function(){

            var first = document.getElementsByName("first")[1].value;
            var last = document.getElementsByName("last")[1].value;
            var password = document.getElementsByName("password")[1].value;
            var user = document.getElementById('userid').innerText;

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

    //Error Detail
    $(document).on("click", '.errLink', function () {

        var user = document.getElementById('userid').innerHTML;
        var error_name = $(this).prop('innerHTML');
        var time = $(this).parent().prev().prop('innerHTML');

        document.getElementById('errorName').innerHTML = error_name;
        document.getElementById('timestamp').innerHTML =  time;

        var payload = "username=" + encodeValue(user) + "&errorname=" + encodeValue(error_name) + "&time=" + encodeValue(time);
        var url =  "http://104.131.199.129:83/php/load_error_log.php";
        var url2 =  "http://104.131.199.129:83/php/load_comment.php";
        var payload2 = "username=" + encodeValue(user) + "&time=" + encodeValue(time)
            + "&errorname=" + encodeValue(error_name);

        sendRequestThree(url, payload);
        sendComment(url2, payload2);
        $('#errorDetailDialog').modal('show');

    });

    document.getElementById('sendComment').onclick = function (){

       var comment =  document.getElementById('comment').value;
       var user = document.getElementById('userid').innerHTML;
       var url =  "http://104.131.199.129:83/php/comment.php";
       var error_name = document.getElementById('errorName').innerHTML;
       var time =  document.getElementById('timestamp').innerHTML;
       var rating;
       var stars = document.getElementsByName('rating');

       if(stars[0].checked){
           rating = 5;
       }
       else if(stars[1].checked){
           rating = 4;
       }
       else if(stars[2].checked){
           rating = 3;
       }
       else if(stars[3].checked){
           rating = 2;
       }
       else if(stars[4].checked){
           rating = 1;
       }

       var payload = "username=" + encodeValue(user) + "&comment=" + encodeValue(comment) + "&time=" + encodeValue(time)
            + "&errorname=" + encodeValue(error_name) + "&rating=" + encodeValue(rating);

       sendComment(url, payload);

       document.getElementById('comment').value = "";


    }



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

    function sendRequestThree(url, payload)
    {
        var xhr = createXHR();
        if (xhr)
        {
            xhr.open("POST",url,true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4  && xhr.status == 200)
                    document.getElementById('errLog').innerHTML = xhr.responseText;
            };
            xhr.send(payload);
        }

    }

    function sendComment(url, payload)
    {
        var xhr = createXHR();
        if (xhr)
        {
            xhr.open("POST",url,true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4  && xhr.status == 200)
                    document.getElementById('comments').innerHTML = xhr.responseText;
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
