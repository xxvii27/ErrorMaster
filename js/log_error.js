/**
 * Created by xxvii27 on 9/2/14.
 */
window.onerror = function(msg, url, line)
{

    function createXHR()
    {
        try { return new XMLHttpRequest(); } catch(e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch (e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch (e) {}
        try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
        try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}

        return null;
    }

    function prepareRequest(url, payload)
    {
        var xhr = createXHR();
        if (xhr)
        {
            xhr.open("POST",url,true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            return xhr;
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

    var master = "llesmana@ucsd.edu";

    var payload = "msg=" + encodeValue(msg) + '&url=' + encodeValue(url) + "&line=" + encodeValue(line) + "&master=" + encodeValue(master);
    var url_req = "http://104.131.199.129:83/php/log_error.php";
    var req = prepareRequest(url_req, payload);
    req.onreadystatechange = function(){
        if (req.readyState == 4  && req.status == 200){
            console.log('error logged');
            req.send(payload);
        }
    };
    req.send(payload);



}
