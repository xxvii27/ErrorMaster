//Javascript Controller

window.onload = function (){

    var all_errors = "<h1 class='page-header'>All Errors</h1>\
                     <div class='dropdown pull-right'> \
                        <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>\
                            Sort By\
                            <span class='caret'></span>\
                        </button>\
                            <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>\
                                <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Categories</a></li>\
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
                      <tbody>\
                       <tr>\
                        <td>Mon 18 Aug 8:15 PM</td>\
                        <td>2</td>\
                        <td><a href='error.html'>Name Error: Variable Undefined</a></td>\
                        <td><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></td>\
                      </tr>\
                      <tr>\
                        <td>Sun 17 Aug 6:27 PM</td>\
                        <td>4</td>\
                        <td><a href='#error'>Reference Error: Function undefined</a></td>\
                        <td><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></td>\
                      </tr>\
                      <tr>\
                        <td>Sat 16 Aug 5:23 PM </td>\
                        <td>5</td>\
                        <td><a href='#error'>Syntax Error at Image onclick()</a></td>\
                        <td><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span><span class='glyphicon glyphicon-star'></span></td>\
                      </tr>\
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
        " <button type= 'button' class='btn btn-default' data-toggle='modal' data-target='.bs-example-modal-lg'><span class='glyphicon glyphicon-plus'></span></button>" +
        " </div>" +
        " <div class='dropdown pull-right'> \
          <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown'>\
              Sort By\
              <span class='caret'></span>\
          </button>\
              <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>\
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
               <h4 class='sub-header'>Errors so far...</h4>\
               <p>5 Script Errors Found</p>\
               <p>15 Parameter Errors Found</p>\
               <p>8 Invalid Arguments Found</p>\
               <h4 class='sub-header'>Statistics</h4>\
               <div class='row placeholders'>\
                 <div class='col-xs-6 col-sm-3 placeholder'>\
                    <img src='../images/200.png' class='img-responsive' alt='200x200'>\
                    <h4>Errors By Category</h4>\
                   <span class='text-muted'>Something else</span>\
                 </div>  \
               </div>          ";



    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page === "dash.html" || page === "dash.jsp" || page === "dash.php")
        document.getElementById("dashcontent").innerHTML = summary_content;


    document.getElementById("allerrors").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = all_errors;
    }
    document.getElementById("summary").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = summary_content;
    }
    document.getElementById("settings").onclick = function (){
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
        document.getElementById("dashcontent").innerHTML = settings;
    }
    document.getElementById("users").onclick = function (){

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


    //Add user button
    document.getElementById("adduser").onclick = function () {

        var first = document.getElementsByName("first")[0].value;
        var last = document.getElementsByName("last")[0].value;
        var email = document.getElementsByName("email")[0].value;
        var password = document.getElementsByName("password")[0].value;
        var user = document.getElementById('userid').innerHTML;

        var url = "http://104.131.199.129:83/php/addmember.php";
        var payload = "firstname=" + encodeValue(first) + "&lastname=" + encodeValue(last) + "&email=" + encodeValue(email) + "&password=" + encodeValue(password) +
                            "&user=" + encodeValue(user);
        sendRequest(url, payload);

        $('#addUserDialog').modal('hide');



    }

    //Delete User Buttons

    $(document).on("click", '.delete', function (e) {
        alert("test");
    });


        /*var delButton =  document.getElementsByClassName("delete");
        delButton[0].onclick = function(){
            alert("test");
        }*/


   /* for(var i = 0; i<delButton.length; i++){
        delButton[i].onclick = function(){
            //var url = "http://104.131.199.129:83/php/deleteuser.php";

            var username = delButton[i].parentNode.previousSibling.previousSibling.previousSibling.innerHTML;

            alert(username);
            //sendRequest(url, payload);

        }
    }*/




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

    function handleResponse(xhr)
    {
        if (xhr.readyState == 4  && xhr.status == 200)
        {
            var responseOutput = document.getElementById("responseOutput");
            responseOutput.innerHTML = xhr.responseText;
        }
        else if(xhr.status == 403){
            document.getElementById("dashcontent").innerHTML = xhr.responseText;
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
