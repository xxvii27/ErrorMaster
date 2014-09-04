window.onload = function (){

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
                    xhr.open("POST",url,false);
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



            //Add user button
            var adduser = document.getElementById("adduser")
            if(adduser !== null){
                    adduser.onclick = function () {

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
                var payload = "sort=" + encodeValue(sort_options) + "&admin=" + encodeValue("yes");
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
                        alert("User Edited !!! Bug Notice: If not edited on database, do edit twice consecutively. ");

                    }

                }


            });







}