/*
 * Functions and variables used to handle dynamic update of payment and shipping information forms.
 * We want the options to have corresponding objects
 */

window.onload = function(){
    //PaymentOption.prototype.targetForm = document.getElementById("payTargetForm");
    //ShipmentOption.prototype.targetForm = document.getElementById("shippingTargetForm");
    var paymentSelect = document.getElementById('payment_select');
    var shipmentSelect =document.getElementById('shipment_select'); 

    paymentSelect['onchange'] = optionSelected;
    shipmentSelect['onchange'] = optionSelected;
    readCardInfo(paymentSelect);
    readShippingInfo(shipmentSelect);
}

function getXMLHttpRequest() 
{
    if (window.XMLHttpRequest) {
        return new window.XMLHttpRequest;
    }
    else {
        try {
            return new ActiveXObject("MSXML2.XMLHTTP.3.0");
        }
        catch(ex) {
            return null;
        }
    }
}

var regExArray = 
    {
        credit_card_number: /^[0-9]{10}$/,
        billing_zipcode: /^[0-9]{5}$/,
        recipient_zipcode: /^[0-9]{5}$/,
        expiration_date: /^(1|2|3|4|5|6|7|8|9|10|11|12){1}\/20[0-9]{2}$/,
        holder_name: /[0-9a-zA-Z]+/,
        cvc: /^[0-9]{3,4}$/,
        billing_address1: /[0-9a-zA-Z]+/,
        billing_address2: /[0-9a-zA-Z]*/,
        recipient_address1: /[0-9a-zA-Z]+/,
        recipient_address2: /[0-9a-zA-Z]*/,
        billing_state: /^[a-zA-Z]{2}$/,
        recipient_state: /^[a-zA-Z]{2}$/,
        billing_city: /^[a-zA-Z]+/,
        recipient_city: /^[a-zA-Z]+/,
        description: /[0-9a-zA-Z]+/,
        recipient_name: /[0-9a-zA-Z]+/
    }

function verifyInput(inputObj){
    
    if(regExArray[inputObj.name] != null){
        if(regExArray[inputObj.name].test(inputObj.value)){
            inputObj['style']['border'] = '2px solid green';
            inputObj['verified'] = 'true';
        }else{
            inputObj['style']['border'] = '2px solid red';
            inputObj['verified'] = 'false';

        }
    }
}

function readCardInfo(obj){ // callback function for select box onselected event
    var rqst = getXMLHttpRequest();
    rqst.onreadystatechange = function(){
        //remove all the children nodes of select box.
        var targetForm = document.getElementById("payTargetForm")
        
        while(obj.firstChild) obj.removeChild(obj.firstChild);
        while(targetForm.firstChild) targetForm.removeChild(targetForm.firstChild);
        if(this.readyState == 4){
            try{
                var d = JSON.parse(this.responseText);
                var chooseOption = new PaymentOption(null, '== choose payment info ==', obj, targetForm);
                obj.appendChild(chooseOption.ui);
                
                for(var i in d){
                   var op = new PaymentOption(d[i]['credit_card_id'], 
                                              d[i]['credit_card_number'],
                                              obj,
                                              targetForm);

                   obj.appendChild(op.ui);
                }
                var insertOption = new PaymentOption("insert", "insert", obj, targetForm);
                obj.appendChild(insertOption.ui);
            }catch(exception){
                alert(exception);
            }
        }else{
            
        }

    }
    rqst.open('GET', 'saved_card_list.php');
    rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    rqst.send(null);
}

function readShippingInfo(shipmentSelect){
    var rqst = getXMLHttpRequest();
    rqst.onreadystatechange = function(){
            var targetForm = document.getElementById("shipTargetForm");
            
            while(shipmentSelect.firstChild) shipmentSelect.removeChild(shipmentSelect.firstChild);
            while(targetForm.firstChild) targetForm.removeChild(targetForm.firstChild);
            if(this.readyState == 4){
                
                //alert(this.responseText);
                var d = JSON.parse(this.responseText);
                var chooseOption = new PaymentOption(null, '==choose shipment info==', shipmentSelect, targetForm); 
                shipmentSelect.appendChild(chooseOption.ui);
                for(var i in d){
                    shipmentSelect.appendChild(new PaymentOption(
                    d[i]['user_address_id'], d[i]['description'], shipmentSelect, targetForm).ui);
                }
                var insertOption = new PaymentOption("insert", "insert", shipmentSelect, targetForm);
                shipmentSelect.appendChild(insertOption.ui);
            }
        }

    rqst.open('GET', 'saved_shipping_list.php');
    rqst.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    rqst.send(null);
}

PaymentOption.prototype.buildForm = function(){ // request card information to the server and construct html object.
    //alert("buildForm called");
    //alert(this.ui['value']);
    var targetForm = this.targetForm;
    while(targetForm.firstChild) targetForm.removeChild(targetForm.firstChild);
    if(this.ui.value == "null") return false;

    var formBuildFunction;
    var url;
    if(this.parentSelect == document.getElementById('payment_select')){
        formBuildFunction = createForm;
        url = "saved_card_info.php?credit_card_id=" + this.ui.value;
    }
    else{
         formBuildFunction = createShipmentForm;
         url = "saved_shipping_info.php?user_address_id=" + this.ui.value;
    }


    if(this.ui['value'] == "insert"){
        //alert("buildForm for insert");
        
        var formObj = formBuildFunction.call(null);
        targetForm.appendChild(formObj);
        return;
    }
    var rqst = getXMLHttpRequest();
    rqst.onreadystatechange = function(){
        //remove all the children nodes of select box.
        
        if(this.readyState == 4){
            //alert(this.responseText);
            try{
                var d = JSON.parse(this.responseText);
                var formObj = formBuildFunction.call(null, d);
                targetForm.appendChild(formObj);

            }catch(ex){
                alert(this.responseText);
            }
        }else{
            
        }
    }

    rqst.open('GET', url);
    rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    rqst.send(null);
}

function optionSelected(){
    var selectedOption = this.options[this.selectedIndex]["jsObject"];
    selectedOption.buildForm();    
}

function PaymentOption(optionValue, optionText, parentSelect, targetForm){
    this.ui = document.createElement("option");
    this.optionValue = optionValue;
    this.parentSelect = parentSelect;
    this.targetForm = targetForm;
    
    this.ui['value'] = optionValue;
    this.ui['text'] = optionText;
    this.ui['jsObject'] = this;
}


// build a form object that contains credit card information as stored in the database, or empty form to take in input.
function createForm(){
    var formObj = document.createElement("form");
    //alert("createForm invoked");
    //alert(createForm.arguments.length);
    if(createForm.arguments.length <1){
        formObj['action'] = "";
        formObj['method'] = "";
        formObj['name'] = "payInfoForm"
      //  alert("No arguments passed");
        var olObj1 = document.createElement("ol");
        var olObj2 = document.createElement("ol");
        var butObj = document.createElement("input");
        
        olObj1['style']['list-style'] = 'none';
        olObj1.innerHTML = '<legend style="font-weight: bold">Card Information</legend>' +
                                '<li><label>Card Number</label>' +
                                    '<input type="text" name="credit_card_number" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label>Expiration Date</label>' +
                                    '<input name="expiration_date" type="text" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label>CVC</label>' +
                                    '<input type="text" name="cvs" maxlength="4" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>';
        olObj2['style']['list-style'] = 'none';
        olObj2.innerHTML = '<legend style="font-weight: bold">Billing Information</legend>' +
                                '<li><label for="name" alt="holder name">Holder\'s Name:</label>' +
                                    '<input type="text" name="holder_name" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li><label for="address1">Address 1:</label>' +
                                    '<input type="text" name="billing_address1" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li><label for="address2">Address 2(Optional):</label>' +
                                    '<input type="text" name="billing_address2" onkeyup="javascript:verifyInput(this); return false;" verified="true"/>' +
                                '</li>' +
                                '<li><label for="name">City:</label>' +
                                    '<input type="text" name="billing_city" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label for="state">State:</label>' +
                                    '<input name="billing_state" type="text" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label name="">Zipcode</label>' +
                                    '<input type="text" name="billing_zipcode" onkeyup="javascript:verifyInput(this); return false;"/>' +
                                '</li>';
                            
                         
        butObj['type'] = "button";
        butObj['name'] = "button"
        butObj['value'] = "Save"
        butObj['onclick'] = function(){
            // 1. traverse all the child nodes, and, if a <input> is found, disable it.
            // 2. Verify the values using verfy functions defined below.
            // 3. register XMLHttpRequest handler
            //alert("onsubmit for formObj invoked " + typeof formObj);
            
            var data = "";
            //var data = new Array();
            var c = formObj.getElementsByTagName("*");
            for(var a in c){
                if(c[a].tagName == "INPUT" && c[a].type != "button"){
                    data += c[a].name + "=" + c[a].value + "&";
                    //data[c[a].name] = c[a].value;
                    if(c[a].verified == undefined || c[a].verified == "false"){
                        alert(c[a].value + " is not valid input for " + c[a].name);
                        return false;
                    }
                }
                
            }
            
            var rqst = getXMLHttpRequest();
            rqst.onreadystatechange = function(){
                if(this.readyState == 4){
                    if(this.responseText == 'true'){
                        readCardInfo(document.getElementById("payment_select"));
                    }
                    else{
                        alert(this.responseText);
                    }
                }
            }
            rqst.open("POST", "save_info.php", true);
            rqst.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
            rqst.send(data);
            return;
        }

        formObj.appendChild(olObj1);
        formObj.appendChild(olObj2);
        formObj.appendChild(butObj);
        
       // alert("createForm finishing");
        return formObj;
    }
    //alert("create form for saved card info");
    var form_info_array = createForm.arguments[0];
    var credit_card_number  = (form_info_array != undefined)?form_info_array['credit_card_number']:null;
    var credit_card_id  = (form_info_array != undefined)?form_info_array['credit_card_id']:null;
    var expiration_date  = (form_info_array != undefined)?form_info_array['expiration_date']:null;
    var cvc  = (form_info_array != undefined)?form_info_array['cvc']:null;
    var holder_name  = (form_info_array != undefined)?form_info_array['holder_name']:null;
    var address1  = (form_info_array != undefined)?form_info_array['billing_address1']:null;
    var address2  = (form_info_array != undefined)?form_info_array['billing_address2']:null;
    var city  = (form_info_array != undefined)?form_info_array['billing_city']:null;
    var state  = (form_info_array != undefined)?form_info_array['billing_state']:null;
    var zipcode  = (form_info_array != undefined)?form_info_array['billing_zipcode']:null;
    formObj['submit'] = function(){
        alert(credit_card_id);
        rqst = getXMLHttpRequest();
        rqst.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.responseText == true){
                    readCardInfo(document.getElementById("payment_select"));
                }else{
                    alert(this.responseText);
                }
            }
        }
        rqst.open('get', 'remove_card_info.php?credit_card_id='+ credit_card_id);
        rqst.send(null);
        return false;
    }
    formObj.innerHTML = '<ol style="list-style: none">' +
                            '<legend style="font-weight: bold">Card Information</legend>' +
                                '<li><label>Card Number</label>' +
                                    '<input type="hidden" name="credit_card_id" value="'+ credit_card_id + '"/>' +
                                    '<input type="text" name="credit_card_number" value="'+ credit_card_number + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label>Expiration Date</label>' +
                                    '<input name="expiration_date" type="text" value="'+ expiration_date + '" disabled />' +
                                '</li>' +
                                '<li>' +
                                    '<label>CVC</label>' +
                                    '<input type="text" name="cvs" maxlength="4" value="'+ cvc +'" disabled/>' +
                                '</li>' +
                            '</ol>' +
                            '<ol style="list-style: none">' +
                                '<legend style="font-weight: bold">Billing Information</legend>' +
                                '<li><label for="name">Holder\'s Name:</label>' +
                                    '<input type="text" name="holder_name" value="'+ holder_name + '" width="200" disabled/>' +
                                '</li>' +
                                '<li><label for="address1">Address 1:</label>' +
                                    '<input type="text" name="billing_address1" value="'+ address1 + '" disabled/>' +
                                '</li>' +
                                '<li><label for="address2">Address 2(Optional):</label>' +
                                    '<input type="text" name="billing_address2" value="'+ address2 + '" disabled/>' +
                                '</li>' +
                                '<li><label for="name">City:</label>' +
                                    '<input type="text" name="billing_city" value="'+ city + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label for="state">State:</label>' +
                                    '<input name="billing_state" type="text" value="'+ state + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label name="">Zipcode</label>' +
                                    '<input type="text" name="billing_zipcode" value="'+ zipcode + '" disabled/>' +
                                '</li>' +
                                '</ol>' +
                                '<input type="button" value="Remove" onclick="javascript:submit()"/>';
    return formObj;
}

function createShipmentForm(){
    var shipmentForm = document.createElement("form");
    if(createShipmentForm.arguments.length < 1){
        shipmentForm['submit'] = function(){
            //verify forms
            //var testdata;
            //var arr = this.getElementsByTagName("*");
            //for(var j in arr){
            //    testdata += arr[j]['tagName'] + ":" + arr[j]['name'] +":" + arr[j]['value'] +"\n";
                
            //}
            //alert(testdata);
            //alert(this.innerHTML);
            var data = "";
            var c = this.getElementsByTagName("*");
            for(var a in c){
                if(c[a].tagName == "INPUT" && c[a].type != "button"){
                    data += c[a].name + "=" + c[a].value + "&";
                    //data[c[a].name] = c[a].value;
                    if(c[a].verified == undefined || c[a].verified == "false"){
                        alert(c[a].value + " is not valid input for " + c[a].name);
                        return false;
                    }
                }
                
            }
/*
            var childElems = this.getElementsByTagName("INPUT");
            var data = "";
            for(var i in childElems){
                if(childElems[i]['tagNam'] == "INPUT")
                data += childElems[i]['name'] + "=" + childElems[i]['value'] + "&";
                //alert(data);
                if(childElems[i]['type'] != "button" && 
                    (childElems[i]['verified'] == undefined || childElems[i]['verified'] == "false")){
                    alert(childElems[i]['value'] + " is invalid input for " + childElems[i]['name']);
                    return false;
                }
            }
            */
            alert(data);

            rqst = getXMLHttpRequest();
            rqst.onreadystatechange = function(){
                if(this.readyState == 4){
                    if(this.responseText == "true"){
                       readShippingInfo(document.getElementById("shipment_select"));
                    }else{
                        alert(this.responseText);
                    }
                }
            }
            rqst.open("POST", "save_shipment.php", true);
            rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            rqst.send(data);
            
            return false;
        }
        shipmentForm.innerHTML = '<ol style="list-style: none">'+
            '<li><label for="description">Description</label>'+
                '<input type="text" name="description" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
            '<li><label for="name">Recipient Name:</label>'+
                '<input type="text" name="recipient_name" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
            '<li><label for="address1">Address 1:</label>'+
                '<input type="text" name="recipient_address1" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
            '<li><label for="address2">Address 2(Optional):</label>'+
                '<input type="text" name="recipient_address2" onkeyup="javascript:verifyInput(this); return false;" verified="true"/>'+
            '</li>'+
            '<li><label for="name">City:</label>'+
                '<input type="text" name="recipient_city" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
            '<li>'+
                '<label for="name">State:</label> <input type="text" name="recipient_state" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
            '<li>'+
                '<label name="">Zipcode</label>'+
                '<input type="text" name="recipient_zipcode" onkeyup="javascript:verifyInput(this); return false;"/>'+
            '</li>'+
        '</ol>' +
        '<input type="button" name="button" value="Save" onclick="javascript:submit();"/>';

        return shipmentForm;
    }
    var form_info_array = createShipmentForm.arguments[0];
    var user_address_id = (form_info_array != undefined)?form_info_array['user_address_id']:null;
    var description  = (form_info_array != undefined)?form_info_array['description']:null;
    var recipient_name  = (form_info_array != undefined)?form_info_array['name']:null;
    var recipient_address1  = (form_info_array != undefined)?form_info_array['address1']:null;
    var recipient_address2  = (form_info_array != undefined)?form_info_array['address2']:null;
    var recipient_city  = (form_info_array != undefined)?form_info_array['city']:null;
    var recipient_state  = (form_info_array != undefined)?form_info_array['state']:null;
    var recipient_zipcode  = (form_info_array != undefined)?form_info_array['zipcode']:null;
    shipmentForm.submit = function(){
        var rqst = getXMLHttpRequest();
        rqst.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.responseText == true)
                    readShippingInfo(document.getElementById("shipment_select"));
                else{
                    alert(this.responseText);
                }
            }
        }
        rqst.open("GET", "remove_shipping_info.php?user_address_id=" + user_address_id);
        rqst.send(null);            
    }
    
    shipmentForm.innerHTML = '<ol style="list-style: none">'+
            '<li><label for="description">Description</label>'+
                '<input type="hidden" name="user_address_id" value="'+ user_address_id+'"/>' +
                '<input type="text" name="description" value="'+ description +'" disabled/>'+
            '</li>'+
            '<li><label for="name">Recipient Name:</label>'+
                '<input type="text" name="recipient_name" value="'+ recipient_name +'" disabled/>'+
            '</li>'+
            '<li><label for="address1">Address 1:</label>'+
                '<input type="text" name="recipient_address1" value="'+ recipient_address1 +'" disabled/>'+
            '</li>'+
            '<li><label for="address2">Address 2(Optional):</label>'+
                '<input type="text" name="recipient_address2" value="'+ recipient_address2 +'" disabled/>'+
            '</li>'+
            '<li><label for="name">City:</label>'+
                '<input type="text" name="recipient_city" value="'+ recipient_city +'" disabled/>'+
            '</li>'+
            '<li>'+
                '<label for="name">State:</label>' +
                '<input type="text" name="recipient_state" value="'+ recipient_state +'" disabled/>'+
            '</li>'+
            '<li>'+
                '<label name="">Zipcode</label>'+
                '<input type="text" name="recipient_zipcode" value="'+ recipient_zipcode +'" disabled/>'+
            '</li>'+
        '</ol>' +
        '<input type="button" name="button" value="Remove" onclick="javascript:submit();"/>';

    return shipmentForm;
}

function order(formObj){
    
    var list = formObj.getElementsByTagName("INPUT");
    var p = "";
    for(var i in list){
        //if(list[i].tagName == "BUTTON") continue;
        p += list[i]['name'] + "="+ list[i]['value'] + "&";
    }
    alert(p);
    rqst = getXMLHttpRequest();
    rqst.onreadystatechange = function(){
        if(this.readyState == 4){
            alert(this.responseText);
        }
    }
    rqst.open("POST", "checkout.php", true);
    rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    rqst.send(p);
    return false;
}
