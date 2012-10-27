/*
 * Functions and variables used to handle dynamic update of payment and shipping information forms.
 * We want the options to have corresponding objects
 */
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
        credit_card_number: /[0-9]{10}/,
        zipcode: /{0-9}{5}/,
        expiration_date: /{a}\//,
        cvc:asdf
    }
    
function readCardInfo(obj){ // callback function for select box onselected event
    var rqst = new getXMLHttpRequest();
    rqst.onreadystatechange = function(){
        //remove all the children nodes of select box.
        while(obj.firstChild) obj.removeChild(obj.firstChild);
        if(this.readyState == 4){
            try{
                var d = JSON.parse(this.responseText);
                var chooseOption = new PaymentOption(null, '== choose payment info ==', obj);
                obj.appendChild(chooseOption.ui);
                
                for(var i in d){
                   var op = new PaymentOption(d[i]['credit_card_id'], 
                                              d[i]['credit_card_number'],
                                              obj);

                   obj.appendChild(op.ui);
                }
                var insertOption = new PaymentOption("insert", "insert", obj);
                obj.appendChild(insertOption.ui);
            }catch(exception){
                alert(exception);
            }
        }else{
            
        }

    }
    rqst.open('GET', 'saved_card_list.php');
    rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    rqst.send("");
}

PaymentOption.prototype.buildForm = function(){ // request card information to the server and construct html object.
    //alert("buildForm called");
    //alert(this.ui['value']);
    var targetForm = this.targetForm;
    while(targetForm.firstChild) targetForm.removeChild(targetForm.firstChild);

    if(this.ui['value'] == "insert"){
        //alert("buildForm for insert");
        var formObj = createForm();
        this.targetForm.appendChild(formObj);
        return;
    }
    try{  
        var rqst = new getXMLHttpRequest()();
    }catch(exception){
        
    } 
    rqst.onreadystatechange = function(){
        //remove all the children nodes of select box.
        while(obj.firstChild) obj.removeChild(obj.firstChild);
        
        if(this.readyState == 4){
            //alert(this.responseText);
            var d = JSON.parse(this.responseText);
            var formObj = createForm(d);
            this.ui.targetForm.appendChild(formObj);
        }else{
            
        }
    }

    rqst.open('GET', 'saved_card_list.php?credit_card_id' + this.optionValue);
    rqst.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    rqst.send("");
}

function optionSelected(){
    //alert("optionSelected called");
    
    //event handler for payment select box. It checks which option is selected and excute corresponding work.
    //If choose text is selected, remove html disaplyed. For other options, invoke buildForm function 
    var selectedOption = this.options[this.selectedIndex]["jsObject"];
    //var payTargetForm = document.getElementById("payTargetForm");

    //while(payTargetForm.firstChild) payTargetForm.removeChild(payTargetForm.firstChild);
    if(selectedOption.ui.value == null){
        return;
    }
    //alert("called");
    selectedOption.buildForm();
    //alert("called2");
    
}

function PaymentOption(optionValue, optionText, parentSelect){
    this.ui = document.createElement("option");
    this.optionValue = optionValue;
    this.parentSelect = parentSelect;
    //this.targetForm = null;
    
    this.ui['value'] = optionValue;
    this.ui['text'] = optionText;
    this.ui['jsObject'] = this;
}

function verifyCardNumber(){
    var regEx = /[0-9]{3}/;
    return regEx.test(this.text);
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
                                    '<input type="text" name="credit_card_number"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label>Expiration Date</label>' +
                                    '<input name="expiration_date" type="text"/>' +

                                '</li>' +
                                '<li>' +
                                    '<label>CVC</label>' +
                                    '<input type="text" name="cvc" maxlength="4"/>' +
                                '</li>';
        olObj2['style']['list-style'] = 'none';
        olObj2.innerHTML = '<legend style="font-weight: bold">Billing Information</legend>' +
                                '<li><label for="name">Holder\'s Name:</label>' +
                                    '<input type="text" name="holder_name" />' +
                                '</li>' +
                                '<li><label for="address1">Address 1:</label>' +
                                    '<input type="text" name="address1" />' +
                                '</li>' +
                                '<li><label for="address2">Address 2(Optional):</label>' +
                                    '<input type="text" name="address2"/>' +
                                '</li>' +
                                '<li><label for="name">City:</label>' +
                                    '<input type="text" name="city"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label for="state">State:</label>' +
                                    '<input name="state" type="text"/>' +
                                '</li>' +
                                '<li>' +
                                    '<label name="">Zipcode</label>' +
                                    '<input type="text" name="zipcode"/>' +
                                '</li>';
                            
                         
        butObj['type'] = "button";
        butObj['name'] = "button"
        butObj['value'] = "Save"
        butObj['onclick'] = function(){
            // 1. traverse all the child nodes, and, if a <input> is found, disable it.
            // 2. Verify the values using verfy functions defined below.
            // 3. register XMLHttpRequest handler
            //alert("onsubmit for formObj invoked " + typeof formObj);
            
            var data = "?";
            var c = formObj.getElementsByTagName("*");
            for(var a in c){
                if(c[a].tagName == "INPUT"){
                    c[a].disabled = "true";
                    data += c[a].name + "=" + c[a].value + "&";
                    regExArray[c[a].name].test(c[a].value);
                }
                
            }
            alert(data);
            
            var rqst = new getXMLHttpRequest();
            rqst.onreadystatechange = function(){
                if(this.readyState == 4){
                    //refresh the select box to apply change.

                }
                else {
                    
                }
                
                
            }
            rqst.open("post", "save_info.php", true);
            rqst.send(data);
            return;
        }

        formObj.appendChild(olObj1);
        formObj.appendChild(olObj2);
        formObj.appendChild(butObj);
        
       // alert("createForm finishing");
        return formObj;
    }
    
    formObj['method'] = 'post';
    formObj['action'] = 'url';
    var credit_card_number  = (form_info_array != undefined)?form_info_array['credit_card_number']:null;
    var credit_card_id  = (form_info_array != undefined)?form_info_array['credit_card_id']:null;
    var expiration_date  = (form_info_array != undefined)?form_info_array['expiration_date']:null;
    var cvc  = (form_info_array != undefined)?form_info_array['cvc']:null;
    var holder_name  = (form_info_array != undefined)?form_info_array['holder_name']:null;
    var address1  = (form_info_array != undefined)?form_info_array['address1']:null;
    var address2  = (form_info_array != undefined)?form_info_array['address2']:null;
    var city  = (form_info_array != undefined)?form_info_array['city']:null;
    var state  = (form_info_array != undefined)?form_info_array['state']:null;
    var zipcode  = (form_info_array != undefined)?form_info_array['zipcode']:null;
    
    formObj.innerHTML = '<ol style="list-style: none">' +
                            '<legend style="font-weight: bold">Card Information</legend>' +
                                '<li><label>Card Number</label>' +
                                    '<input type="text" name="card_number" value="'+ credit_card_number + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label>Expiration Date</label>' +
                                    '<input name="expiration_date" type="text" value="'+ expiration_date + '" disabled />' +
                                '</li>' +
                                '<li>' +
                                    '<label>CVC</label>' +
                                    '<input type="text" name="CVC" maxlength="4" value="'+ cvc +'" disabled/>' +
                                '</li>' +
                            '</ol>' +
                            '<ol style="list-style: none">' +
                                '<legend style="font-weight: bold">Billing Information</legend>' +
                                '<li><label for="name">Holder\'s Name:</label>' +
                                    '<input type="text" name="name" value="'+ holder_name + '" width="200" disabled/>' +
                                '</li>' +
                                '<li><label for="address1">Address 1:</label>' +
                                    '<input type="text" name="address1" value="'+ address1 + '" disabled/>' +
                                '</li>' +
                                '<li><label for="address2">Address 2(Optional):</label>' +
                                    '<input type="text" name="address2" value="'+ address2 + '" disabled/>' +
                                '</li>' +
                                '<li><label for="name">City:</label>' +
                                    '<input type="text" name="city" value="'+ city + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label for="state">State:</label>' +
                                    '<input name="state" type="text" value="'+ state + '" disabled/>' +
                                '</li>' +
                                '<li>' +
                                    '<label name="">Zipcode</label>' +
                                    '<input type="text" name="zipcode" value="'+ zipcode + '" disabled/>' +
                                '</li>' +
                                '</ol>' +
                                '<input type="button" value="Remove" onclick="javascript:test(document.getElementById(\'payment_info\'));"/>';
    return formObj;
}

window.onload = function(){
    PaymentOption.prototype.targetForm = document.getElementById("payTargetForm");

    var paymentSelect = document.getElementById('payment_select');
    
    paymentSelect['onchange'] = optionSelected;

    readCardInfo(paymentSelect);
    //alert(PaymentOption.prototype.targetForm);
    //alert(document.getElementById("payTargetForm"));
    
}