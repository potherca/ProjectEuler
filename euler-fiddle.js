/*
    This script is meant as an aid for those who want to solve problems from 
    Project Euler on JsFiddle. It will insert the problem text into the page, a
    container to write a solution to and a "Check my solution" button.
    
    To use this script, simply include it as an External Resource, add the 
    number of the problem you would like to solve in the HTML pane in JsFiddle
    and add your solution to the provided container.

   To insert a solution to the container, three methods are available:
    
    1. Set a global variable called "solution" with either your solution or a 
       function that returns your solution:
            
            window.solution = function(){return iSolution};

    2. The container that is appended has an ID called "solution-container", 
       you can wait for that to be loaded to the DOM and write directly to that.

    @FIXME: Image tags in the Euler response need to have their SRC attribute 
            ammended to point to http://projecteuler.net
 */
(function(){

    // Add Jquery if it is not already loaded
    if(typeof jQuery === 'undefined'){
        var oScriptNode, oPage;

        oScriptNode = document.createElement('script');
        oScriptNode.type = 'text/javascript';
        oScriptNode.async = true;
        oScriptNode.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';

        oPage = document.getElementsByTagName('head')[0]
            || document.getElementsByTagName('body')[0]
        ;

        oPage.appendChild(oScriptNode);
    }
    
    function jQuerLoader(p_oCallback) {
        if (window.jQuery) {
            p_oCallback(jQuery);
        } else {
            window.setTimeout(
                  function() {jQuerLoader(p_oCallback);}
                , 100
            );
        }
    };

    function addStyles(){
        var sStylesheet = 
              '.success {'
            + '    background-color: lime;'
            + '}'
            + '.failure {'
            + '   background-color: red;'
            + '}'
            + '.success, .failure {'
            + '   color:white;'
            + '}'
            + '#solution-container {'
            + '   border-radius: 0.3em;'
            + '   font-size:2em;'
            + '   padding:0.3em;'
            + '   margin:0.3em;'
            + '   text-align:center;'
            + '}'
        ;
        $('head').append('<style>'+sStylesheet+'</style>');
        $('head').append('<link rel="stylesheet" type="text/css" href="http://pother.ca/CssBase/css/base.css">');
    }
    
    jQuerLoader(function($) {
        var   $Body = $('body')
            , iProblemId
            , $Solution
        ;
        
        addStyles();
                
        // Find which problem is to be solved
        iProblemId = parseInt($Body.text(),10);

        $Body.html($(
              '<h1><a href="http://projecteuler.net/problem=' + iProblemId 
            + '">Problem ' + iProblemId+ '</a></h1>'
            + '<div id="problem"></div>'
            + '<h2>My solution</h2>'
            + '<div id="solution-container"></div>'
            + '<button id="check-button">Check My Solution</button>'
        ));

        $Solution = $('#solution-container');
        $('#check-button').click(checkButtonClickHandler);
        
        $(function(){
            var sType = typeof window.solution;
            if( sType === 'function'){
                $Solution.text(window.solution());
            }else if( sType === 'number'){
                $Solution.text(window.solution);
            } else {
                // ?
            }
        });


// @TODO: Copy and Paste below needs to be refactored into a single function!
        
        // grab text/html nodes from euler page
        // @NOTE: projecteuler.net does not allow other origins, so we use YQL
        $.ajax({
              "url": 'http://query.yahooapis.com/v1/public/yql'
            , "async" : false
            , "data": {
                "q": 'select * from html where ' 
                    + 'url="http://projecteuler.net/problem=' + iProblemId + '"'
                    + 'and (xpath="//h2" OR xpath="//div[@class=\'problem_content\']")'
                , "format": 'xml'
            }
            , "dataType" : 'jsonp'
            , jsonpCallback : 'handleProblemResponse'
            , complete : function(p_oRequest){
                if(p_oRequest.statusText !== 'success'){
                    alert(p_oRequest.statusText + ' : Could not retrieve Problem from Project Euler');
                } else {
                    // The response callback will trigger our handler function
                }
            }
        });

        function checkButtonClickHandler(){
            $Button = $(this);
            $Solution.removeClass('success failure');

            $Button.attr('disabled', 'disabled');
            
            $.ajax({
                  "url": 'http://query.yahooapis.com/v1/public/yql'
                , "async" : false
                , "data": {
                    "q": 'select * from html where ' 
                        + 'url="https://code.google.com/p/projecteuler-solutions/wiki/ProjectEulerSolutions"'
                        + 'and xpath="//pre"'
                    , "format": 'json'
                }
                , "dataType" : 'jsonp'
                , jsonpCallback : 'handleSolutionResponse'
                , complete : function(p_oRequest, p_sStatus){
                    if(p_oRequest.statusText !== 'success'){
                        alert(p_oRequest.statusText + ' : Could not retrieve Problem from Project Euler');
                    } else {
                        // The response callback will trigger our handler function
                    }
                    $Button.removeAttr('disabled');
                }
            });
        }
        
        function handleProblemResponse (p_oResponse){
            var $Problem = $('#problem');
            
            if (p_oResponse.query.count 
                && parseInt(p_oResponse.query.count, 10) > 0
            ) {
                $.each(p_oResponse.results, function(p_i, p_s){
                    $Problem.append(p_s);
                });
            } else {
                console.log('ERROR: Problem with YQL Response');
            }
        }

        function handleSolutionResponse(p_oResponse){
            var iSolution, iPageSolution;

            // get solution from page
            iPageSolution = parseInt($Solution.text(),10);
            
            if (p_oResponse.query.count 
                && parseInt(p_oResponse.query.count, 10) > 0
            ) {
                sSolutions = p_oResponse.query.results.pre.content;
                aSolutions = sSolutions.split("\n");
                
                $.each(aSolutions, function(p_i, p_s){
                    if(parseInt(p_s, 10) === iProblemId){
                        iSolution = parseInt(p_s.split('.')[1], 10);
                        
                        if(iSolution === iPageSolution) {
                            sClass = 'success';
                        } else {
                            sClass = 'failure';
                        }

                        $Solution.addClass(sClass);

                        // break out of the loop
                        return false;
                    }
                });
            } else {
                console.log('ERROR: Problem with YQL Response');
            }
            // mark solution box correct/incorrect (bordercolor + UTF8 symbol)
        }

        window.handleProblemResponse = handleProblemResponse;
        window.handleSolutionResponse = handleSolutionResponse;
        window.$Solution = $Solution;
    });
    
}());

//EOF
