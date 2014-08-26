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
                        <td><a href='error.jsp'>Name Error: Variable Undefined</a></td>\
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
                          " <button type= 'button' class='btn btn-default'><span class='glyphicon glyphicon-plus'></span></button>" +
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
                                <tbody>\
                                <tr>\
                                  <td>Thomas A Powell</td>\
                                  <td>5</td>\
                                  <td>8</td>\
                                  <td><span class='staton'>Online</span>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-minus'></span></a>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-cog'></span></a></td>\
                                </tr>\
                                <tr>\
                                  <td>Chuck Norris</td>\
                                  <td>4</td>\
                                  <td>12</td>\
                                  <td><span class='statoff'>Offline</span>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-minus'></span></a>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-cog'></span></a></td>\
                                </tr>\
                                 <tr>\
                                  <td>Angus MacGyver</td>\
                                  <td>2</td>\
                                  <td>9</td>\
                                  <td><span class='staton'>Online</span>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-minus'></span></a>\
                                      <button type='button' class='btn btn-default pull-right'><span class='glyphicon glyphicon-cog'></span></a></td>\
                                </tr>\
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

    if(page === "dash.html" || page === "dash.jsp")          
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
        document.getElementsByClassName("active")[0].removeAttribute("class");
        this.parentNode.setAttribute("class", "active");
	    document.getElementById("dashcontent").innerHTML = user_management;
    }




	
}
