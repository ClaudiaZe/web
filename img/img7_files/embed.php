window.cfields = [];
window._show_thank_you = function(id, message, trackcmp_url, email) {
    var form = document.getElementById('_form_' + id + '_'), thank_you = form.querySelector('._form-thank-you');
    form.querySelector('._form-content').style.display = 'none';
    thank_you.innerHTML = message;
    thank_you.style.display = 'block';
    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._show_unsubscribe = function(id, message, trackcmp_url, email) {
    var form = document.getElementById('_form_' + id + '_'), unsub = form.querySelector('._form-thank-you');
    var branding = form.querySelector('._form-branding');
    if (branding) {
        branding.style.display = 'none';
    }
    form.querySelector('._form-content').style.display = 'none';
    unsub.style.display = 'block';
    form.insertAdjacentHTML('afterend', message)
    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._show_error = function(id, message, html) {
    var form = document.getElementById('_form_' + id + '_'),
        err = document.createElement('div'),
        button = form.querySelector('button'),
        old_error = form.querySelector('._form_error');
    if (old_error) old_error.parentNode.removeChild(old_error);
    err.innerHTML = message;
    err.className = '_error-inner _form_error _no_arrow';
    var wrapper = document.createElement('div');
    wrapper.className = '_form-inner _show_be_error';
    wrapper.appendChild(err);
    button.parentNode.insertBefore(wrapper, button);
    var submitButton = form.querySelector('[id^="_form"][id$="_submit"]');
    submitButton.disabled = false;
    submitButton.classList.remove('processing');
    if (html) {
        var div = document.createElement('div');
        div.className = '_error-html';
        div.innerHTML = html;
        err.appendChild(div);
    }
};
window._show_pc_confirmation = function(id, header, detail, show, email) {
    var form = document.getElementById('_form_' + id + '_'), pc_confirmation = form.querySelector('._form-pc-confirmation');
    if (pc_confirmation.style.display === 'none') {
        form.querySelector('._form-content').style.display = 'none';
        pc_confirmation.innerHTML = "<div class='_form-title'>" + header + "</div>" + "<p>" + detail + "</p>" +
        "<button class='_submit' id='hideButton'>Manage preferences</button>";
        pc_confirmation.style.display = 'block';
        var mp = document.querySelector('input[name="mp"]');
        mp.value = '0';
    } else {
        form.querySelector('._form-content').style.display = 'inline';
        pc_confirmation.style.display = 'none';
    }

    var hideButton = document.getElementById('hideButton');
    // Add event listener to the button
    hideButton.addEventListener('click', function() {
        var submitButton = document.querySelector('#_form_2573_submit');
        submitButton.disabled = false;
        submitButton.classList.remove('processing');
        var mp = document.querySelector('input[name="mp"]');
        mp.value = '1';
        const cacheBuster = new URL(window.location.href);
        cacheBuster.searchParams.set('v', new Date().getTime());
        window.location.href = cacheBuster.toString();
    });

    const vgoAlias = typeof visitorGlobalObjectAlias === 'undefined' ? 'vgo' : visitorGlobalObjectAlias;
    var visitorObject = window[vgoAlias];
    if (email && typeof visitorObject !== 'undefined') {
        visitorObject('setEmail', email);
        visitorObject('update');
    } else if (typeof(trackcmp_url) != 'undefined' && trackcmp_url) {
        // Site tracking URL to use after inline form submission.
        _load_script(trackcmp_url);
    }
    if (typeof window._form_callback !== 'undefined') window._form_callback(id);
};
window._load_script = function(url, callback, isSubmit) {
    var head = document.querySelector('head'), script = document.createElement('script'), r = false;
    var submitButton = document.querySelector('#_form_2573_submit');
    script.charset = 'utf-8';
    script.src = url;
    if (callback) {
        script.onload = script.onreadystatechange = function() {
            if (!r && (!this.readyState || this.readyState == 'complete')) {
                r = true;
                callback();
            }
        };
    }
    script.onerror = function() {
        if (isSubmit) {
            if (script.src.length > 10000) {
                _show_error("6780866037886", "Sorry, your submission failed. Please shorten your responses and try again.");
            } else {
                _show_error("6780866037886", "Sorry, your submission failed. Please try again.");
            }
            submitButton.disabled = false;
            submitButton.classList.remove('processing');
        }
    }

    head.appendChild(script);
};
(function() {
    if (window.location.search.search("excludeform") !== -1) return false;
    var getCookie = function(name) {
        var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }
    var setCookie = function(name, value) {
        var now = new Date();
        var time = now.getTime();
        var expireTime = time + 1000 * 60 * 60 * 24 * 365;
        now.setTime(expireTime);
        document.cookie = name + '=' + value + '; expires=' + now + ';path=/; Secure; SameSite=Lax;';
    }
        var cookie = getCookie('_form_2573_');
    if (cookie) {
        var cookie_date = new Date(Date.parse(cookie));
        var reveal_on_date = new Date(cookie_date);
        var now = new Date();
        reveal_on_date.setDate(cookie_date.getDate() + parseInt('14', 10));
        if (reveal_on_date > now) {
            return;
        }
    }
            var addEvent = function(element, event, func) {
        if (element.addEventListener) {
            element.addEventListener(event, func);
        } else {
            var oldFunc = element['on' + event];
            element['on' + event] = function() {
                oldFunc.apply(this, arguments);
                func.apply(this, arguments);
            };
        }
    }
    var _removed = false;
    var _form_output = '\<style\>@import url(https:\/\/fonts.bunny.net\/css?family=ibm-plex-sans:400,600);\<\/style\>\<style\>\n#_form_6780866037886_{font-size:14px;line-height:1.6;font-family:arial, helvetica, sans-serif;margin:0}#_form_6780866037886_ *{outline:0}._form_hide{display:none;visibility:hidden}._form_show{display:block;visibility:visible}#_form_6780866037886_._form-top{top:0}#_form_6780866037886_._form-bottom{bottom:0}#_form_6780866037886_._form-left{left:0}#_form_6780866037886_._form-right{right:0}#_form_6780866037886_ input[type=\"text\"],#_form_6780866037886_ input[type=\"tel\"],#_form_6780866037886_ input[type=\"date\"],#_form_6780866037886_ textarea{padding:6px;height:auto;border:#979797 1px solid;border-radius:4px;color:#000000 !important;font-size:14px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}#_form_6780866037886_ textarea{resize:none}#_form_6780866037886_ ._submit{-webkit-appearance:none;cursor:pointer;font-family:arial, sans-serif;font-size:14px;text-align:center;background:#004CFF !important;border:0 !important;-moz-border-radius:1px !important;-webkit-border-radius:1px !important;border-radius:1px !important;color:#FFFFFF !important;padding:14px !important}#_form_6780866037886_ ._submit:disabled{cursor:not-allowed;opacity:0.4}#_form_6780866037886_ ._submit.processing{position:relative}#_form_6780866037886_ ._submit.processing::before{content:\"\";width:1em;height:1em;position:absolute;z-index:1;top:50%;left:50%;border:double 3px transparent;border-radius:50%;background-image:linear-gradient(#004CFF, #004CFF), conic-gradient(#004CFF, #FFFFFF);background-origin:border-box;background-clip:content-box, border-box;animation:1200ms ease 0s infinite normal none running _spin}#_form_6780866037886_ ._submit.processing::after{content:\"\";position:absolute;top:0;bottom:0;left:0;right:0;background:#004CFF !important;border:0 !important;-moz-border-radius:1px !important;-webkit-border-radius:1px !important;border-radius:1px !important;color:#FFFFFF !important;padding:14px !important}@keyframes _spin{0%{transform:translate(-50%, -50%) rotate(90deg)}100%{transform:translate(-50%, -50%) rotate(450deg)}}#_form_6780866037886_ ._close-icon{cursor:pointer;background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/esfkyjh1u_forms-close-dark.png\");background-repeat:no-repeat;background-size:14.2px 14.2px;position:absolute;display:block;top:11px;right:9px;overflow:hidden;width:16.2px;height:16.2px}#_form_6780866037886_ ._close-icon:before{position:relative}#_form_6780866037886_ ._form-body{margin-bottom:30px}#_form_6780866037886_ ._form-image-left{width:150px;float:left}#_form_6780866037886_ ._form-content-right{margin-left:164px}#_form_6780866037886_ ._form-branding{color:#fff;font-size:10px;clear:both;text-align:left;margin-top:30px;font-weight:100}#_form_6780866037886_ ._form-branding ._logo{display:block;width:130px;height:14px;margin-top:6px;background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/hh9ujqgv5_aclogo_li.png\");background-size:130px auto;background-repeat:no-repeat}#_form_6780866037886_ .form-sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);border:0}#_form_6780866037886_ ._form-label,#_form_6780866037886_ ._form_element ._form-label{font-weight:bold;margin-bottom:5px;display:block}#_form_6780866037886_._dark ._form-branding{color:#333}#_form_6780866037886_._dark ._form-branding ._logo{background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/jftq2c8s_aclogo_dk.png\")}#_form_6780866037886_ ._form_element{position:relative;margin-bottom:10px;font-size:0;max-width:100%}#_form_6780866037886_ ._form_element *{font-size:14px}#_form_6780866037886_ ._form_element._clear{clear:both;width:100%;float:none}#_form_6780866037886_ ._form_element._clear:after{clear:left}#_form_6780866037886_ ._form_element input[type=\"text\"],#_form_6780866037886_ ._form_element input[type=\"date\"],#_form_6780866037886_ ._form_element select,#_form_6780866037886_ ._form_element textarea:not(.g-recaptcha-response){display:block;width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:inherit}#_form_6780866037886_ ._field-wrapper{position:relative}#_form_6780866037886_ ._inline-style{float:left}#_form_6780866037886_ ._inline-style input[type=\"text\"]{width:150px}#_form_6780866037886_ ._inline-style:not(._clear)+._inline-style:not(._clear){margin-left:20px}#_form_6780866037886_ ._form_element img._form-image{max-width:100%}#_form_6780866037886_ ._form_element ._form-fieldset{border:0;padding:0.01em 0 0 0;margin:0;min-width:0}#_form_6780866037886_ ._clear-element{clear:left}#_form_6780866037886_ ._full_width{width:100%}#_form_6780866037886_ ._form_full_field{display:block;width:100%;margin-bottom:10px}#_form_6780866037886_ input[type=\"text\"]._has_error,#_form_6780866037886_ textarea._has_error{border:#F37C7B 1px solid}#_form_6780866037886_ input[type=\"checkbox\"]._has_error{outline:#F37C7B 1px solid}#_form_6780866037886_ ._show_be_error{float:left}#_form_6780866037886_ ._error{display:block;position:absolute;font-size:14px;z-index:10000001}#_form_6780866037886_ ._error._above{padding-bottom:4px;bottom:39px;right:0}#_form_6780866037886_ ._error._below{padding-top:8px;top:100%;right:0}#_form_6780866037886_ ._error._above ._error-arrow{bottom:-4px;right:15px;border-left:8px solid transparent;border-right:8px solid transparent;border-top:8px solid #FFDDDD}#_form_6780866037886_ ._error._below ._error-arrow{top:0;right:15px;border-left:8px solid transparent;border-right:8px solid transparent;border-bottom:8px solid #FFDDDD}#_form_6780866037886_ ._error-inner{padding:12px 12px 12px 36px;background-color:#FFDDDD;background-image:url(\"data:image\/svg+xml,%3Csvg width=\'16\' height=\'16\' viewBox=\'0 0 16 16\' fill=\'none\' xmlns=\'http:\/\/www.w3.org\/2000\/svg\'%3E%3Cpath fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8ZM9 3V9H7V3H9ZM9 13V11H7V13H9Z\' fill=\'%23CA0000\'\/%3E%3C\/svg%3E\");background-repeat:no-repeat;background-position:12px center;font-size:14px;font-family:arial, sans-serif;font-weight:600;line-height:16px;color:#000;text-align:center;text-decoration:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;box-shadow:0px 1px 4px rgba(31, 33, 41, 0.298295)}@media only screen and (max-width:319px){#_form_6780866037886_ ._error-inner{padding:7px 7px 7px 25px;font-size:12px;line-height:12px;background-position:4px center;max-width:100px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}}#_form_6780866037886_ ._error-inner._form_error{margin-bottom:5px;text-align:left}#_form_6780866037886_ ._button-wrapper ._error-inner._form_error{position:static}#_form_6780866037886_ ._error-inner._no_arrow{margin-bottom:10px}#_form_6780866037886_ ._error-arrow{position:absolute;width:0;height:0}#_form_6780866037886_ ._error-html{margin-bottom:10px}.pika-single{z-index:10000001 !important}#_form_6780866037886_ input[type=\"text\"].datetime_date{width:69%;display:inline}#_form_6780866037886_ select.datetime_time{width:29%;display:inline;height:32px}#_form_6780866037886_ input[type=\"date\"].datetime_date{width:69%;display:inline-flex}#_form_6780866037886_ input[type=\"time\"].datetime_time{width:29%;display:inline-flex}._form-wrapper{z-index:9999999}#_form_6780866037886_._animated{-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both}#_form_6780866037886_._animated._fast{-webkit-animation-duration:0.4s;animation-duration:0.4s}@-webkit-keyframes _fadeIn{0%{opacity:0}100%{opacity:1}}@keyframes _fadeIn{0%{opacity:0}100%{opacity:1}}#_form_6780866037886_._fadeIn{-webkit-animation-name:_fadeIn;animation-name:_fadeIn}@media (min-width:320px) and (max-width:667px){::-webkit-scrollbar{display:none}#_form_6780866037886_{margin:0;width:100%;min-width:100%;max-width:100%;box-sizing:border-box}#_form_6780866037886_ *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-size:1em}#_form_6780866037886_ ._form-content{margin:0;width:100%}#_form_6780866037886_ ._form-inner{display:block;min-width:100%}#_form_6780866037886_ ._form-title,#_form_6780866037886_ ._inline-style{margin-top:0;margin-right:0;margin-left:0}#_form_6780866037886_ ._form-title{font-size:1.2em}#_form_6780866037886_ ._form_element{margin:0 0 20px;padding:0;width:100%}#_form_6780866037886_ ._form-element,#_form_6780866037886_ ._inline-style,#_form_6780866037886_ input[type=\"text\"],#_form_6780866037886_ label,#_form_6780866037886_ p,#_form_6780866037886_ textarea:not(.g-recaptcha-response){float:none;display:block;width:100%}#_form_6780866037886_ ._row._checkbox-radio label{display:inline}#_form_6780866037886_ ._row,#_form_6780866037886_ p,#_form_6780866037886_ label{margin-bottom:0.7em;width:100%}#_form_6780866037886_ ._row input[type=\"checkbox\"],#_form_6780866037886_ ._row input[type=\"radio\"]{margin:0 !important;vertical-align:middle !important}#_form_6780866037886_ ._row input[type=\"checkbox\"]+span label{display:inline}#_form_6780866037886_ ._row span label{margin:0 !important;width:initial !important;vertical-align:middle !important}#_form_6780866037886_ ._form-image{max-width:100%;height:auto !important}#_form_6780866037886_ input[type=\"text\"]{padding-left:10px;padding-right:10px;font-size:16px;line-height:1.3em;-webkit-appearance:none}#_form_6780866037886_ input[type=\"radio\"],#_form_6780866037886_ input[type=\"checkbox\"]{display:inline-block;width:1.3em;height:1.3em;font-size:1em;margin:0 0.3em 0 0;vertical-align:baseline}#_form_6780866037886_ button[type=\"submit\"]{padding:20px;font-size:1.5em}#_form_6780866037886_ ._inline-style{margin:20px 0 0 !important}}#_form_6780866037886_ .sms_consent_checkbox{position:relative}#_form_6780866037886_ .sms_consent_checkbox input[type=\"checkbox\"]{float:left;margin:5px 10px 10px 0}#_form_6780866037886_ .sms_consent_checkbox .sms_consent_message{display:inline;width:95%;float:left;text-align:left;margin-bottom:10px}#_form_6780866037886_ .sms_consent_checkbox .sms_consent_message.sms_consent_mini{width:90%}#_form_6780866037886_ .sms_consent_checkbox ._error._above{right:auto;bottom:0}#_form_6780866037886_ .sms_consent_checkbox ._error._above ._error-arrow{right:auto;left:5px}@media (min-width:320px) and (max-width:667px){#_form_6780866037886_ .sms_consent_checkbox ._error._above{top:-30px;left:0;bottom:auto}}#_form_6780866037886_{position:fixed;left:0;right:0;padding:30px 50px 30px 30px;text-align:center;font-size:17px;z-index:10000000;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;background:#4E5468 !important;height:60px !important;color:#FFFFFF !important}#_form_6780866037886_._floating-bar ._form-content,#_form_6780866037886_._floating-bar input,#_form_6780866037886_._floating-bar ._submit{font-family:\"IBM Plex Sans\", Helvetica, sans-serif, \"IBM Plex Sans\", arial, sans-serif}#_form_6780866037886_ ._form-content{position:absolute;left:0;margin:0 auto;padding:0;width:100%;top:15px}#_form_6780866037886_ ._form-element{vertical-align:middle}#_form_6780866037886_ ._form-content input[type=\"text\"]{margin-bottom:0}#_form_6780866037886_ ._form-inner{position:relative;width:auto;display:inline-block}#_form_6780866037886_ ._form-thank-you{position:absolute;top:50%;left:0;margin:-13.5px auto 0 auto;padding:0;width:100%}#_form_6780866037886_ ._form-title{margin-right:10px;vertical-align:middle}#_form_6780866037886_ ._error-inner._form_error{position:absolute;right:0;margin-top:10px;margin-bottom:0;width:302px;line-height:130%;text-align:left}#_form_6780866037886_ ._error-inner._form_error ._error-html{margin-top:10px;margin-bottom:0}#_form_6780866037886_ button,#_form_6780866037886_ input[type=\"submit\"]{vertical-align:middle}#_form_6780866037886_ ._ac-circle-branding{z-index:3;background-size:30px 30px;height:30px;width:30px;background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/g3dmwx1m2_forms-ac-logo.png\");position:absolute;left:20px;top:50%;margin-top:-15px}#_form_6780866037886_ ._ac-circle-branding a{display:block;height:100%;left:0;top:0;width:100%}#_form_6780866037886_._dark ._ac-circle-branding{background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/kaqgazmuf_forms-ac-logo-dark.png\")}#_form_6780866037886_ ._close-icon{background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/gxwooby50_forms-close-light.png\");position:absolute;top:50%;margin-top:-8.1px;right:20px;font-size:14px;height:16.2px;width:16.2px;background-size:16.2px 16.2px}#_form_6780866037886_._dark ._close-icon{background-image:url(\"https:\/\/d226aj4ao1t61q.cloudfront.net\/esfkyjh1u_forms-close-dark.png\")}#_form_6780866037886_._dark ._ac-circle-branding{color:rgba(0, 0, 0, 0.6)}#_form_6780866037886_ ._form-element{display:inline-block;position:relative}@media (min-width:1px) and (max-width:880px){#_form_6780866037886_ input,#_form_6780866037886_ button,#_form_6780866037886_ ._form-title{font-size:12px}#_form_6780866037886_ input{width:100px}}@media (min-width:1px) and (max-width:667px){#_form_6780866037886_{position:fixed;margin:0;padding:13px 23px;height:auto !important}#_form_6780866037886_ .sms_consent_message{margin-top:10px;font-size:14px}#_form_6780866037886_ ._form-content{position:relative;text-align:center;margin:0 auto 15px auto}#_form_6780866037886_ ._form-title{font-size:1em;display:block;min-width:100%;padding-right:20px}#_form_6780866037886_ ._ac-circle-branding{display:none}#_form_6780866037886_ ._form-content button{padding:10px 16px;font-size:14px}#_form_6780866037886_ ._close-icon{top:20px;margin-top:0;min-width:16.2px;max-width:16.2px;display:inline-block}#_form_6780866037886_ ._form-thank-you{position:relative;top:initial;left:initial;margin:12px 0}}@-webkit-keyframes _slideInDown{0%{-webkit-transform:translateY(-100%);transform:translateY(-100%);visibility:visible}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes _slideInDown{0%{-webkit-transform:translateY(-100%);transform:translateY(-100%);visibility:visible}100%{-webkit-transform:translateY(0);transform:translateY(0)}}#_form_6780866037886_._slideInDown{-webkit-animation-name:_slideInDown;animation-name:_slideInDown}@-webkit-keyframes _slideInUp{0%{-webkit-transform:translateY(100%);transform:translateY(100%);visibility:visible}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes _slideInUp{0%{-webkit-transform:translateY(100%);transform:translateY(100%);visibility:visible}100%{-webkit-transform:translateY(0);transform:translateY(0)}}#_form_6780866037886_._slideInUp{-webkit-animation-name:_slideInUp;animation-name:_slideInUp}\n#_form_6780866037886_ ._close-icon{left:20px !important}#_form_6780866037886_ ._field_email{margin:0px !important;padding:10px !important;border:0px !important;-webkit-border-radius:0 !important;border-radius:2px !important;-webkit-box-shadow:none !important;box-shadow:none !important;font-family:IBM Plex Sans !important}#_form_6780866037886_ ._submit{margin:0px !important;-webkit-border-radius:0 !important;border-radius:2px !important;-webkit-box-shadow:none !important;box-shadow:none !important;padding:10px !important;border:0px !important;font-family:IBM Plex Sans !important}#_form_6780866037886_ . _form_2173{border-top:1px solid #000 !important}#_form_6780866037886_ ._form-title{font-family:IBM Plex Sans}\<\/style\>\n\n\<form method=\"POST\" action=\"https://ac.activehosted.com\/proc.php\" id=\"_form_6780866037886_\" class=\"_form _form_2573 _floating-bar _animated _fast  _form-bottom\" novalidate\>\n    \<input type=\"hidden\" name=\"u\" value=\"6780866037886\" \/\>\n    \<input type=\"hidden\" name=\"f\" value=\"2573\" \/\>\n    \<input type=\"hidden\" name=\"s\" \/\>\n    \<input type=\"hidden\" name=\"c\" value=\"0\" \/\>\n    \<input type=\"hidden\" name=\"m\" value=\"0\" \/\>\n    \<input type=\"hidden\" name=\"act\" value=\"sub\" \/\>\n    \<input type=\"hidden\" name=\"v\" value=\"2\" \/\>\n        \<div class=\"_form-content\"\>\n        \<div class=\"_form-inner\"\>\n                            \<span class=\"_form-title\"\>Consulta cómo hacen marketing más de 150.000 empresas\<\/span\>\n                        \<div class=\"_consent-container\"\>\n            \<div\>\n                                \<div class=\"_form-element\"\>\<label class=\"form-sr-only\" for=\"_field_email\"\>Type your email\<\/label\>\<input type=\"text\" name=\"email\" id=\"_field_email\" class=\"_field_email\" placeholder=\"Dirección de correo electrónico\" \>\<\/div\>\n                                                    \<button id=\"_form_2573_submit\" type=\"submit\" class=\"_submit\"\>Comienza tu prueba gratis\<\/button\>\n                            \<\/div\>\n                        \<\/div\>\n        \<\/div\>\n    \<\/div\>\n    \<div class=\"_form-thank-you\" style=\"display:none;\"\>\<\/div\>\n    \<i class=\"_close-icon _close\"\>\<\/i\>\n\<\/form\>\n';
        var _form_outer = document.createElement('div');
    _form_outer.className = '_form-wrapper';
    _form_outer.innerHTML = _form_output;
    if (!document.body) { document.firstChild.appendChild(document.createElement('body')); }
    document.body.appendChild(_form_outer);
        var form_to_submit = document.getElementById('_form_6780866037886_');
    var scroll_pos = +'20', shown = false, scrollTimeout = null;
    _form_outer.className = _form_outer.className + ' _form_hide';
    var onScroll = function() {
        if (scrollTimeout) clearTimeout(scrollTimeout);
        scrollTimeout = window.setTimeout(checkPercentage, 100);
    };
    var checkPercentage = function() {
        if (_removed || shown) return;
        // document.documentElement = <html>
        // document.body = <body>
        // The first non-zero scrollTop value.
        var top = document.documentElement.scrollTop || document.body.scrollTop;
        // The first non-zero scrollHeight value.
        var height_scroll = document.documentElement.scrollHeight || document.body.scrollHeight;
        // The lower clientHeight value.
        var height_client = Math.min(document.documentElement.clientHeight, document.body.clientHeight);
        var percentage = top / (height_scroll - height_client) * 100;
        if (percentage >= scroll_pos) {
            _form_outer.className = _form_outer.className.replace(/ ?_form_hide ?/g, '');
            _form_outer.className = _form_outer.className + ' _form_show';
            form_to_submit.className = form_to_submit.className + ' ' + '_slideInUp';
            shown = true;
                    }
    };
    addEvent(window, 'scroll', onScroll);
    onScroll();
    var close_icon = _form_outer.querySelector('._close');
    var close_form = function() {
        if (_form_outer) _form_outer.parentNode.removeChild(_form_outer);
        remove_tooltips();
        _removed = true;
                setCookie("_form_2573_", new Date());
            };
    addEvent(close_icon, 'click', close_form);
    var allInputs = form_to_submit.querySelectorAll('input, select, textarea'), tooltips = [], submitted = false;

    var getUrlParam = function(name) {
        if (name.toLowerCase() !== 'email') {
            var params = new URLSearchParams(window.location.search);
            return params.get(name) || false;
        }
        // email is a special case because a plus is valid in the email address
        var qString = window.location.search;
        if (!qString) {
            return false;
        }
        var parameters = qString.substr(1).split('&');
        for (var i = 0; i < parameters.length; i++) {
            var parameter = parameters[i].split('=');
            if (parameter[0].toLowerCase() === 'email') {
                return parameter[1] === undefined ? true : decodeURIComponent(parameter[1]);
            }
        }
        return false;
    };

    var acctDateFormat = "%m/%d/%Y";
    var getNormalizedDate = function(date, acctFormat) {
        var decodedDate = decodeURIComponent(date);
        if (acctFormat && acctFormat.match(/(%d|%e).*%m/gi) !== null) {
            return decodedDate.replace(/(\d{2}).*(\d{2}).*(\d{4})/g, '$3-$2-$1');
        } else if (Date.parse(decodedDate)) {
            var dateObj = new Date(decodedDate);
            var year = dateObj.getFullYear();
            var month = dateObj.getMonth() + 1;
            var day = dateObj.getDate();
            return `${year}-${month < 10 ? `0${month}` : month}-${day < 10 ? `0${day}` : day}`;
        }
        return false;
    };

    var getNormalizedTime = function(time) {
        var hour, minutes;
        var decodedTime = decodeURIComponent(time);
        var timeParts = Array.from(decodedTime.matchAll(/(\d{1,2}):(\d{1,2})\W*([AaPp][Mm])?/gm))[0];
        if (timeParts[3]) { // 12 hour format
            var isPM = timeParts[3].toLowerCase() === 'pm';
            if (isPM) {
                hour = parseInt(timeParts[1]) === 12 ? '12' : `${parseInt(timeParts[1]) + 12}`;
            } else {
                hour = parseInt(timeParts[1]) === 12 ? '0' : timeParts[1];
            }
        } else { // 24 hour format
            hour = timeParts[1];
        }
        var normalizedHour = parseInt(hour) < 10 ? `0${parseInt(hour)}` : hour;
        var minutes = timeParts[2];
        return `${normalizedHour}:${minutes}`;
    };

    for (var i = 0; i < allInputs.length; i++) {
        var regexStr = "field\\[(\\d+)\\]";
        var results = new RegExp(regexStr).exec(allInputs[i].name);
        if (results != undefined) {
            allInputs[i].dataset.name = allInputs[i].name.match(/\[time\]$/)
                ? `${window.cfields[results[1]]}_time`
                : window.cfields[results[1]];
        } else {
            allInputs[i].dataset.name = allInputs[i].name;
        }
        var fieldVal = getUrlParam(allInputs[i].dataset.name);

        if (fieldVal) {
            if (allInputs[i].dataset.autofill === "false") {
                continue;
            }
            if (allInputs[i].type == "radio" || allInputs[i].type == "checkbox") {
                if (allInputs[i].value == fieldVal) {
                    allInputs[i].checked = true;
                }
            } else if (allInputs[i].type == "date") {
                allInputs[i].value = getNormalizedDate(fieldVal, acctDateFormat);
            } else if (allInputs[i].type == "time") {
                allInputs[i].value = getNormalizedTime(fieldVal);
            } else {
                allInputs[i].value = fieldVal;
            }
        }
    }

    var remove_tooltips = function() {
        for (var i = 0; i < tooltips.length; i++) {
            tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
        }
        tooltips = [];
    };
    var remove_tooltip = function(elem) {
        for (var i = 0; i < tooltips.length; i++) {
            if (tooltips[i].elem === elem) {
                tooltips[i].tip.parentNode.removeChild(tooltips[i].tip);
                tooltips.splice(i, 1);
                return;
            }
        }
    };
    var create_tooltip = function(elem, text) {
        var tooltip = document.createElement('div'),
            arrow = document.createElement('div'),
            inner = document.createElement('div'), new_tooltip = {};
        if (elem.type != 'radio' && (elem.type != 'checkbox' || elem.name === 'sms_consent')) {
            tooltip.className = '_error';
            arrow.className = '_error-arrow';
            inner.className = '_error-inner';
            inner.innerHTML = text;
            tooltip.appendChild(arrow);
            tooltip.appendChild(inner);
            elem.parentNode.appendChild(tooltip);
        } else {
            tooltip.className = '_error-inner _no_arrow';
            tooltip.innerHTML = text;
            elem.parentNode.insertBefore(tooltip, elem);
            new_tooltip.no_arrow = true;
        }
        new_tooltip.tip = tooltip;
        new_tooltip.elem = elem;
        tooltips.push(new_tooltip);
        return new_tooltip;
    };
    var resize_tooltip = function(tooltip) {
        var rect = tooltip.elem.getBoundingClientRect();
            tooltip.tip.className = tooltip.tip.className + ' _above';
        };
    var resize_tooltips = function() {
        if (_removed) return;
        for (var i = 0; i < tooltips.length; i++) {
            if (!tooltips[i].no_arrow) resize_tooltip(tooltips[i]);
        }
    };
    var validate_field = function(elem, remove) {
        var tooltip = null, value = elem.value, no_error = true;
        remove ? remove_tooltip(elem) : false;
        if (elem.type != 'checkbox') elem.className = elem.className.replace(/ ?_has_error ?/g, '');
        if (elem.getAttribute('required') !== null) {
            if (elem.type == 'radio' || (elem.type == 'checkbox' && /any/.test(elem.className))) {
                var elems = form_to_submit.elements[elem.name];
                if (!(elems instanceof NodeList || elems instanceof HTMLCollection) || elems.length <= 1) {
                    no_error = elem.checked;
                }
                else {
                    no_error = false;
                    for (var i = 0; i < elems.length; i++) {
                        if (elems[i].checked) no_error = true;
                    }
                }
                if (!no_error) {
                    tooltip = create_tooltip(elem, "Please select an option.");
                }
            } else if (elem.type =='checkbox') {
                var elems = form_to_submit.elements[elem.name], found = false, err = [];
                no_error = true;
                for (var i = 0; i < elems.length; i++) {
                    if (elems[i].getAttribute('required') === null) continue;
                    if (!found && elems[i] !== elem) return true;
                    found = true;
                    elems[i].className = elems[i].className.replace(/ ?_has_error ?/g, '');
                    if (!elems[i].checked) {
                        no_error = false;
                        elems[i].className = elems[i].className + ' _has_error';
                        err.push("Checking %s is required".replace("%s", elems[i].value));
                    }
                }
                if (!no_error) {
                    tooltip = create_tooltip(elem, err.join('<br/>'));
                }
            } else if (elem.tagName == 'SELECT') {
                var selected = true;
                if (elem.multiple) {
                    selected = false;
                    for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected) {
                            selected = true;
                            break;
                        }
                    }
                } else {
                    for (var i = 0; i < elem.options.length; i++) {
                        if (elem.options[i].selected
                            && (!elem.options[i].value
                            || (elem.options[i].value.match(/\n/g)))
                        ) {
                            selected = false;
                        }
                    }
                }
                if (!selected) {
                    elem.className = elem.className + ' _has_error';
                    no_error = false;
                    tooltip = create_tooltip(elem, "Please select an option.");
                }
            } else if (value === undefined || value === null || value === '') {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "This field is required.");
            }
        }
        if (no_error && (elem.id == 'field[]' || elem.id == 'ca[11][v]')) {
            if (elem.className.includes('phone-input-error')) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
            }
        }
        if (no_error && elem.name == 'email') {
            if (!value.match(/^[\+_a-z0-9-'&=]+(\.[\+_a-z0-9-']+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i)) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "Enter a valid email address.");
            }
        }
        if (no_error && /date_field/.test(elem.className)) {
            if (!value.match(/^\d\d\d\d-\d\d-\d\d$/)) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "Enter a valid date.");
            }
        }

        if (no_error && elem.name === 'sms_consent') {
            const elemShouldBeChecked = (!!elem.attributes.required && !elem.checked);
            if (elemShouldBeChecked) {
                elem.className = elem.className + ' _has_error';
                no_error = false;
                tooltip = create_tooltip(elem, "Translation error: \'forms:omnichannel:request-confirmation-error\' not found.");
            }
        }
        tooltip ? resize_tooltip(tooltip) : false;
        return no_error;
    };
    var needs_validate = function(el) {
        if(el.getAttribute('required') !== null){
            return true
        }
        if(el.name === 'email' && el.value !== ""){
            return true
        }

        if((el.id == 'field[]' || el.id == 'ca[11][v]') && el.className.includes('phone-input-error')){
            return true
        }

        return false
    };
    var validate_form = function(e) {
        var err = form_to_submit.querySelector('._form_error'), no_error = true;
        if (!submitted) {
            submitted = true;
            for (var i = 0, len = allInputs.length; i < len; i++) {
                var input = allInputs[i];
                if (needs_validate(input)) {
                    if (input.type == 'tel') {
                        addEvent(input, 'blur', function() {
                            this.value = this.value.trim();
                            validate_field(this, true);
                        });
                    }
                    if (input.type == 'text' || input.type == 'number' || input.type == 'time') {
                        addEvent(input, 'blur', function() {
                            this.value = this.value.trim();
                            validate_field(this, true);
                        });
                        addEvent(input, 'input', function() {
                            validate_field(this, true);
                        });
                    } else if (input.type == 'radio' || input.type == 'checkbox') {
                        (function(el) {
                            var radios = form_to_submit.elements[el.name];
                            for (var i = 0; i < radios.length; i++) {
                                addEvent(radios[i], 'click', function() {
                                    validate_field(el, true);
                                });
                            }
                        })(input);
                    } else if (input.tagName == 'SELECT') {
                        addEvent(input, 'change', function() {
                            validate_field(this, true);
                        });
                    } else if (input.type == 'textarea'){
                        addEvent(input, 'input', function() {
                            validate_field(this, true);
                        });
                    }
                }
            }
        }
        remove_tooltips();
        for (var i = 0, len = allInputs.length; i < len; i++) {
            var elem = allInputs[i];
            if (needs_validate(elem)) {
                if (elem.tagName.toLowerCase() !== "select") {
                    elem.value = elem.value.trim();
                }
                validate_field(elem) ? true : no_error = false;
            }
        }
        if (!no_error && e) {
            e.preventDefault();
        }
        resize_tooltips();
        return no_error;
    };
    addEvent(window, 'resize', resize_tooltips);
    addEvent(window, 'scroll', resize_tooltips);

    var hidePhoneInputError = function(inputId) {
        var errorMessage =  document.getElementById("error-msg-" + inputId);
        var input = document.getElementById(inputId);
        errorMessage.classList.remove("phone-error");
        errorMessage.classList.add("phone-error-hidden");
        input.classList.remove("phone-input-error");
    };

    var initializePhoneInput = function(input, defaultCountry) {
        return window.intlTelInput(input, {
            utilsScript: "https://unpkg.com/intl-tel-input@17.0.18/build/js/utils.js",
            autoHideDialCode: false,
            separateDialCode: true,
            initialCountry: defaultCountry,
            preferredCountries: []
        });
    }

    var setPhoneInputEventListeners = function(inputId, input, iti) {
        input.addEventListener('blur', function() {
            var errorMessage = document.getElementById("error-msg-" + inputId);
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    iti.setNumber(iti.getNumber());
                    if (errorMessage.classList.contains("phone-error")){
                        hidePhoneInputError(inputId);
                    }
                } else {
                    showPhoneInputError(inputId)
                }
            } else {
                if (errorMessage.classList.contains("phone-error")){
                    hidePhoneInputError(inputId);
                }
            }
        });

        input.addEventListener("countrychange", function() {
            iti.setNumber('');
        });

        input.addEventListener("keydown", function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 8) {
                e.preventDefault();
            }
        });
    };

    var showPhoneInputError = function(inputId) {
        var errorMessage =  document.getElementById("error-msg-" + inputId);
        var input = document.getElementById(inputId);
        errorMessage.classList.add("phone-error");
        errorMessage.classList.remove("phone-error-hidden");
        input.classList.add("phone-input-error");
    };

    var _form_serialize = function(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=0;i<form.elements.length;i++){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"tel":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].previousSibling.querySelector('div.iti__selected-dial-code').innerText)+encodeURIComponent(" ")+encodeURIComponent(form.elements[i].value));break;case"text":case"number":case"date":case"time":case"hidden":case"password":case"button":case"reset":case"submit":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=0;j<form.elements[i].options.length;j++){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};

    const formSupportsPost = false;
          var form_submit = function(e) {

        e.preventDefault();
        if (validate_form()) {
            // use this trick to get the submit button & disable it using plain javascript
            var submitButton = e.target.querySelector('#_form_2573_submit');
            submitButton.disabled = true;
            submitButton.classList.add('processing');
                        setCookie("_form_2573_", new Date());
                        var serialized = _form_serialize(
                document.getElementById('_form_6780866037886_')
            ).replace(/%0A/g, '\\n');
            var err = form_to_submit.querySelector('._form_error');
            err ? err.parentNode.removeChild(err) : false;
            async function submitForm() {
              var formData = new FormData();
              const searchParams = new URLSearchParams(serialized);
              searchParams.forEach((value, key) => {
                if (key !== 'hideButton') {
                    formData.append(key, value);
                }
                //formData.append(key, value);
              });
                            let request = {
                                headers: {
                                    "Accept": "application/json"
                                },
                                body: formData,
                                method: "POST"
                            };

                            let pageUrlParams = new URLSearchParams(window.location.search);
                            if (pageUrlParams.has('t')) {
                                request.headers.Authorization = 'Bearer ' + pageUrlParams.get('t');
                            }
              const response = await fetch('https://ac.activehosted.com/proc.php?jsonp=true', request);
              return response.json();
            }
                if (formSupportsPost) {
                  submitForm().then((data) => {
                    eval(data.js);
                  });
                } else {
                  _load_script('https://ac.activehosted.com/proc.php?' + serialized + '&jsonp=true', null, true);
                }
        }
        return false;
    };
    addEvent(form_to_submit, 'submit', form_submit);
})();
