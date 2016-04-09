/* Copyright (c) 2006-2007 Mathias Bank (http://www.mathias-bank.de)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * 
 * Version 2.1
 * 
 * Thanks to 
 * Hinnerk Ruemenapf - http://hinnerk.ruemenapf.de/ for bug reporting and fixing.
 * Tom Leonard for some improvements
 * 
 */
jQuery.fn.extend({
    /**
    * Returns get parameters.
    *
    * If the desired param does not exist, null will be returned
    *
    * To get the document params:
    * @example value = $(document).getUrlParam("paramName");
    *
    * To get the params of a html-attribut (uses src attribute)
    * @example value = $('#imgLink').getUrlParam("paramName");
    */
    getUrlParam: function(strParamName)
    {
        strParamName = encodeURI(decodeURI(strParamName));

        var returnVal      = [];
        var qString        = null;
        var strHref        = null;
        var strQueryString = '';

        if (jQuery(this).attr("nodeName")=="#document")
        {
            if (window.location.search.search(strParamName) > -1 )
            {
                qString = window.location.search.substr(1,window.location.search.length).split("&");
            }

        }
        else if (jQuery(this).attr("src")!="undefined")
        {
            strHref = jQuery(this).attr("src");
            if ( strHref.indexOf("?") > -1 )
            {
                strQueryString = strHref.substr(strHref.indexOf("?")+1);
                qString = strQueryString.split("&");
            }
        }
        else if (jQuery(this).attr("href")!="undefined")
        {
            strHref = jQuery(this).attr("href");
            if ( strHref.indexOf("?") > -1 )
            {
                strQueryString = strHref.substr(strHref.indexOf("?")+1);
                qString = strQueryString.split("&");
            }
        }
        else
        {
            return null;
        }

        if (qString==null)
        {
            return null;
        }

        for (var i = 0; i < qString.length; i++)
        {
            if (encodeURI(decodeURI(qString[i].split("=")[0])) == strParamName){
                returnVal.push(qString[i].split("=")[1]);
            }
        }

        if (returnVal.length==0)
        {
            return null;
        }
        else if (returnVal.length==1)
        {
            return returnVal[0];
        }
        else
        {
            return returnVal;
        }
    }
});